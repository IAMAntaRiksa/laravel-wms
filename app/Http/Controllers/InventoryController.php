<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function index()
    {
        $datas = Inventory::with('warehouse', 'item')->when(request()->q, function ($inventories) {
            $inventories =  $inventories->whereHas('warehouse', function ($warehouses) {
                return $warehouses->where('code', 'like', '%' . request()->q . '%');
            });
        })->when(request()->item, function ($inventories) {
            $inventories =  $inventories->whereHas('item', function ($items) {
                return $items->where('item_number', 'like', '%' . request()->item . '%');
            });
        })->latest()->paginate(5);
        return view('page.inventory.index', compact('datas'));
    }

    public function create()
    {
        $items = Item::all();
        $warehouses = Warehouse::all();

        return view('page.inventory.create', compact('items', 'warehouses'));
    }

    public function store(Request $request)
    {
        $messages = [
            'warehouse_id.required' => Lang::get('web.warehouse_id-required'),
            'warehouse_id.exists' => Lang::get('web.warehouse_id-exists'),
            'item_id.required' => Lang::get('web.item_id-required'),
            'item_id.exists' => Lang::get('web.item_id-exists'),
            'qty.required' => Lang::get('web.qty-required'),
            'qty.integer' => Lang::get('web.qty-integer'),
            'pending.required' => Lang::get('web.pending-required'),
            'pending.integer' => Lang::get('web.pending-integer'),
        ];

        $validator = Validator::make($request->all(), [
            'warehouse_id' => 'required|exists:warehouses,id',
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer',
            'pending' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            Inventory::create([
                'warehouse_id' => $request->warehouse_id,
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'pending' => $request->pending,
            ]);
        } catch (\Exception $erorrs) {
            if ($erorrs->getMessage()) {
                return redirect()->back()
                    ->withInput()->withErrors(['message' => Lang::get('web.create-failed-duplicate-entry')]);
            }
            return redirect()->back()->withInput->withErrors('message', Lang::get('web.create-failed'));
        }

        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('inventory.index');
    }

    public function edit(Inventory $inventory)
    {
        $items = Item::all();
        $warehouses = Warehouse::all();

        return view('page.inventory.edit', compact('items', 'warehouses', 'inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {

        $messages = [
            'warehouse_id.required' => Lang::get('web.warehouse_id-required'),
            'warehouse_id.exists' => Lang::get('web.warehouse_id-exists'),
            'item_id.required' => Lang::get('web.item_id-required'),
            'item_id.exists' => Lang::get('web.item_id-exists'),
            'qty.required' => Lang::get('web.qty-required'),
            'qty.integer' => Lang::get('web.qty-integer'),
            'pending.required' => Lang::get('web.pending-required'),
            'pending.integer' => Lang::get('web.pending-integer'),
        ];

        $validator = Validator::make($request->all(), [
            'warehouse_id' => 'required|exists:warehouses,id',
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer',
            'pending' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $inventory->update([
                'warehouse_id' => $request->warehouse_id,
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'pending' => $request->pending,
            ]);
        } catch (\Exception $erorrs) {
            return redirect()->back()->withInput->withErrors('message', Lang::get('web.update-failed'));
        }

        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('inventory.index');
    }

    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();
        } catch (\Exception $errors) {
            return redirect()->route('inventory.index')->withErrors(['message' => Lang::get('web.delete-failed')]);
        }

        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('inventory.index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Imports\ItemsImport;
use App\Models\Item;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public function index()
    {
        $datas = Item::when(request()->q, function ($items) {
            $items = $items->where('item', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        return view('page.item.index', compact('datas'));
    }


    public function create()
    {
        return view('page.item.create');
    }

    public function store(Request $request)
    {
        $message = [
            'item_number.required' => Lang::get('web.item_number-required')
        ];

        $validator = Validator::make($request->all(), [
            'item_number' => 'required'
        ], $message);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            Item::create([
                'item' => $request->item,
                'external_code' => $request->external_code,
                'item_number' => $request->item_number,
                'product_name' => $request->product_name,
            ]);;
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('item.index');
    }

    public function edit(Item $item)
    {
        return view('page.item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $message = [
            'item_number.required' => Lang::get('web.item_number-required')
        ];

        $validator = Validator::make($request->all(), [
            'item_number' => 'required'
        ], $message);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $item->update([
                'item' => $request->item,
                'external_code' => $request->external_code,
                'item_number' => $request->item_number,
                'product_name' => $request->product_name,
            ]);
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('item.index');
    }


    public function destroy(Item $item)
    {
        SerialNumber::with('items')->where('item_id', $item->id)->delete();
        try {
            $item->delete();
        } catch (\Exception $errors) {
            return redirect()->route('item.index')->withErrors(['message' => Lang::get('web.delete-failed')]);
        }
        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('item.index');
    }

    public function import()
    {
        return view('page.item.import');
    }

    public function importProcess(Request $request)
    {
        $messages = [
            'item.required' => Lang::get('web.item-required'),
            'item.file' => Lang::get('web.item-file'),
            'item.mimes' => Lang::get('web.item-mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'item' => 'required|file|mimes:xlsx',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.upload-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $collection = Excel::toCollection(new ItemsImport, $request->file('item'));

        foreach ($collection as $rows) {
            foreach ($rows as $row) {
                if ($row[0] && $row[0] != 'Item Number') {
                    Item::firstOrCreate([
                        'item_number' => $row[0],
                        'external_code' => $row[1],
                        'product_name' => $row[2],
                    ]);
                }
            }
        }

        Session::flash('message', Lang::get('web.import-success'));
        return redirect()->route('item.index');
    }
}
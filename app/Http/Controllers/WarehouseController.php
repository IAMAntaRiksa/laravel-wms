<?php

namespace App\Http\Controllers;

use App\Imports\WarehouseImport;
use App\Models\Inventory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseController extends Controller
{
    public function index()
    {
        $datas = Warehouse::when(request()->q, function ($warehouses) {
            $warehouses = $warehouses->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        return view('page.warehouse.index', compact('datas'));
    }


    public function create()
    {
        return view('page.warehouse.create');
    }

    public function store(Request $request)
    {
        $message = [
            'code.required' => Lang::get('web.code-required'),
            'code.unique' => 'Code harus unik',
            'type.required' => Lang::get('web.type-required'),
            'type.in' => Lang::get('web.type-in'),
        ];

        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:warehouses',
            'type' => 'required',
        ], $message);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $warehouse = Warehouse::create([
            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
            'type' => $request->type
        ]);

        try {
            $warehouse->save();
        } catch (\Exception $errors) {
            return redirect()->withInput()->withErrors(['message' => Lang::get('web.create-failed')]);
        }

        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('warehouse.index');
    }
    public function edit(Warehouse $warehouse)
    {
        return view('page.warehouse.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $message = [
            'code.required' => Lang::get('web.code-required'),
            'code.unique' => 'Code harus unik',
            'type.required' => Lang::get('web.type-required'),
            'type.in' => Lang::get('web.type-in'),
        ];

        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:warehouses,code,' . $warehouse->id,
            'type' => 'required',
        ], $message);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $warehouse->update([
                'name' => $request->name,
                'code' => $request->code,
                'address' => $request->address,
                'type' => $request->type
            ]);
        } catch (\Exception $errors) {
            return redirect()->withInput()->withErrors(['message' => Lang::get('web.update-failed')]);
        }

        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('warehouse.index');
    }

    public function destroy(Warehouse $warehouse)
    {
        try {
            $warehouse->delete();
        } catch (\Exception $errors) {
            return redirect()->back()->withInput()->withErrors('message', Lang::get('web.delete-failed'));
        }

        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('warehouse.index');
    }

    public function import()
    {
        return view('page.warehouse.import');
    }

    public function importProcess(Request $request)
    {
        $messages = [
            'warehouse.required' => Lang::get('web.warehouse-required'),
            'warehouse.file' => Lang::get('web.warehouse-file'),
            'warehouse.mimes' => Lang::get('web.warehouse-mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'warehouse' => 'required|file|mimes:xlsx',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.upload-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $collection = Excel::toCollection(new WarehouseImport, $request->file('warehouse'));

        foreach ($collection as $rows) {
            foreach ($rows as $row) {
                if ($row[0] && $row[0] != 'Name') {
                    Warehouse::firstOrCreate([
                        'name' => $row[0],
                        'code' => $row[1],
                        'address' => $row[2],
                    ]);
                }
            }
        }

        Session::flash('message', Lang::get('web.import-success'));
        return redirect()->route('warehouse.index');
    }
}
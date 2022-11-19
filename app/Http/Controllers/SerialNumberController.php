<?php

namespace App\Http\Controllers;

use App\Imports\SerialNumberImport;
use App\Models\Item;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SerialNumberController extends Controller
{
    public function index()
    {
        $datas = SerialNumber::with('item')->when(request()->q, function ($serialNumbers) {
            $serialNumbers = $serialNumbers->where('serial_number', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        return view('page.serial-number.index', compact('datas'));
    }


    public function import()
    {
        return view('page.serial-number.import');
    }

    public function importProcess(Request $request)
    {

        $messages = [
            'serial_number.required' => Lang::get('web.cr-required'),
            'serial_number.file' => Lang::get('web.cr-file'),
            'serial_number.mimes' => Lang::get('web.cr-mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|file|mimes:xlsx',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.upload-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        Excel::import(new SerialNumberImport, $request->file('serial_number'));

        Session::flash('message', Lang::get('web.import-success'));
        return redirect()->route('serial-number.index');
    }
    public function edit(SerialNumber $serialNumber)
    {
        return view('page.serial-number.edit', compact('serialNumber'));
    }

    public function update(Request $request, SerialNumber $serialNumber)
    {
        $messages = [
            'serial_number.required' => Lang::get('web.serial_number-required'),
            'serial_number.unique' => "Serial Number harus unik",
        ];

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|unique:serial_numbers,serial_number,' . $serialNumber->id,
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $serialNumber->update([
                'serial_number' => $request->serial_number,
                'in_date' => $request->in_date,
                'out_date' => $request->out_date,
                'mr_no' => $request->mr_no,
            ]);
        } catch (\Exception $errors) {
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('web.update-failed')]);
        }

        $serialNumber->update($request->all());
        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('serial-number.index');
    }

    public function destroy(SerialNumber $serialNumber)
    {
        try {
            $serialNumber->delete();
        } catch (\Exception $errors) {
            return redirect()->route('serial-number.index')->withErrors(['message' => Lang::get('web.delete-failed')]);
        }

        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('serial-number.index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $datas = PurchaseOrder::with('items.detail', 'warehouse')->when(request()->q, function ($purchases) {
            $purchases = $purchases->whare('order_reference_no', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        return view('page.transfer-stok.purchase-order.index', compact('datas'));
    }

    public function create()
    {
        $items = Item::all();
        $warehouses = Warehouse::all();


        return view('page.transfer-stok.purchase-order.create', compact('items', 'warehouses'));
    }

    public function store(Request $request)
    {
        $messages = [
            'order_reference_no.required' => Lang::get('web.order_reference_no-required'),
            'order_reference_no.unique' => Lang::get('web.order_reference_no-unique'),
            'is_open.required' => Lang::get('web.is_open-required'),
            'is_open.in' => Lang::get('web.is_open-in'),
            'file.required' => Lang::get('web.file-required'),
            'file.file' => Lang::get('web.file-file'),
            'file.mimes' => Lang::get('web.file-mimes'),
            'warehouse_id.required' => Lang::get('web.warehouse_id-required'),
            'warehouse_id.exists' => Lang::get('web.warehouse_id-exists'),
        ];

        $validator = Validator::make($request->all(), [
            'order_reference_no' => 'required|unique:purchase_orders,order_reference_no',
            'is_open' => 'required|in:1,0',
            'file' => 'required|file|mimes:pdf',
            'warehouse_id' => 'required|exists:warehouses,id',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $pdf = $request->file('file');
        $pdf->storeAs('public/pdf/purchase-order/', $pdf->hashName());

        PurchaseOrder::create([
            'order_reference_no' => $request->order_reference_no,
            'file_path' => $pdf->hashName(),
            'is_open' => $request->is_open,
            'month' => Carbon::now()->format('Y-m'),
            'warehouse_id' => $request->warehouse_id,
            'type' => 'main'
        ]);

        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('purchase-order.index');
    }
}
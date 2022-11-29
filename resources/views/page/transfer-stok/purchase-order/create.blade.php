@extends('layouts.app')

@section('title', 'Purchase Order')

@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css"
    integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<form action="{{ route('purchase-order.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <h4 class="card-title">@lang('web.create')</h4>
    </div>
    <div class="row row-cards">
        @if($errors->first('message'))
        <div class="col-12">
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('message') }}
                </div>
            </div>
        </div>
        @endif
        <div class="col-3">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Order Reference No</label>
                    <div>
                        <input type="text" name="order_reference_no" value="{{ old('order_reference_no') }}"
                            class="form-control" placeholder="Order Reference No">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('order_reference_no') }}</small>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Warehouse</div>
                    <select name="warehouse_id" id="select-warehouse">
                        <option></option>
                        @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}"
                            {{ old('warehouse_id') == $warehouse->id ? 'selected':'' }}>{{ $warehouse->code }} -
                            {{ $warehouse->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('warehouse_id') }}</small>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Open</label>
                    <select name="is_open" class="form-select">
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('is_open') }}</small>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">File</label>
                    <input type="file" name="file" class="form-control-file">
                    <br />
                    <small class="form-text text-danger">{{ $errors->first('file') }}</small>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('purchase-order.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"
    integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$("#select-item1").selectize({
    create: true,
    sortField: "text",
    placeholder: "Select Item",
    create: false,
});

$("#select-warehouse").selectize({
    create: true,
    sortField: "text",
    placeholder: "Select Warehouse",
    create: false,
});
</script>
@endsection
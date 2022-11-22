@extends('layouts.app', ['title' => 'Inventory'])


@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css"
    integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<form action="{{ route('inventory.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <input type="hidden" name="warehouse_id" value="{{ $inventory->warehouse_id }}">
    <input type="hidden" name="item_id" value="{{ $inventory->item_id }}">

    <div class="card-header">
        <h4 class="card-title">@lang('web.edit')</h4>
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
        <div class="col-6">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Warehouse</div>
                    <select id="select-warehouse" disabled>
                        <option></option>
                        @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}"
                            {{ $inventory->warehouse_id == $warehouse->id ? 'selected':'' }}>{{ $warehouse->code }} -
                            {{ $warehouse->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('warehouse_id') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Qty</label>
                    <div>
                        <input type="number" name="qty" value="{{ old('qty', $inventory->qty) }}" class="form-control"
                            placeholder="Qty">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('qty') }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Item</div>
                    <select id="select-item" disabled>
                        <option></option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ $inventory->item_id == $item->id ? 'selected':'' }}>
                            {{ $item->item_number }} - {{ $item->external_code }} - {{ $item->product_name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('item_id') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Pending</label>
                    <div>
                        <input type="number" name="pending" value="{{ old('pending', $inventory->pending) }}"
                            class="form-control" placeholder="Pending">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('pending') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('inventory.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
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
$("#select-item").selectize({
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
@extends('layouts.app')

@section('title', 'Item')

@section('content')
<form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
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
        <div class="col-6">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Item</label>
                    <div>
                        <input type="text" name="item" value="{{ old('item', $item->item) }}" class="form-control"
                            placeholder="Item">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('item') }}</small>
                </div>


                <div class="form-group mb-3">
                    <label class="form-label">Product Name</label>
                    <div>
                        <input type="text" name="product_name" value="{{ old('product_name', $item->product_name) }}"
                            class="form-control" placeholder="Product Name">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('product_name') }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">External Code</label>
                    <div>
                        <input type="text" name="external_code" value="{{ old('external_code', $item->external_code) }}"
                            class="form-control" placeholder="External Code">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('external_code') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Item Number*</label>
                    <div>
                        <input type="text" name="item_number" value="{{ old('item_number', $item->item_number) }}"
                            class="form-control" placeholder="Item Number">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('item_number') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('item.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection
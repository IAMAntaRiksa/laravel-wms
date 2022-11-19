@extends('layouts.app', ['title' => 'Warehouse'])

@section('title', 'Warehouse')

@section('content')
<form action="{{ route('warehouse.update', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label">Name</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name', $warehouse->name) }}" class="form-control"
                            placeholder="Name">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>


                <div class="form-group mb-3">
                    <label class="form-label">Code</label>
                    <div>
                        <input type="text" name="code" value="{{ old('code', $warehouse->code) }}" class="form-control"
                            placeholder="Code Name">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('code') }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Adderess</label>
                    <div>
                        <input type="text" name="address" value="{{ old('address',  $warehouse->address) }}"
                            class="form-control" placeholder="Adderess ">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                </div>
                <div class="mb-3">
                    <div class="form-label">Type*</div>
                    <select name="type" class="form-select">
                        <option value="main" {{ $warehouse->type == 'main' ? 'selected':'' }}>Main</option>
                        <option value="area" {{ $warehouse->type == 'area' ? 'selected':'' }}>Area</option>
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('warehouse.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection
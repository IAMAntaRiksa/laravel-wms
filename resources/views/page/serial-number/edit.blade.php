@extends('layouts.app')

@section('title', 'Serial Number')

@section('content')
<form action="{{ route('serial-number.update', $serialNumber->id ) }}" method="post" class="card">
    @csrf
    @method('PUT')
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
                {{-- <div class="form-group mb-3">
          <label class="form-label">Item ID</label>
          <div>
            <input type="text" name="item_id" value="{{ $serialNumber->item_id }}" class="form-control"
                placeholder="Item">
            </div>
            <small class="form-text text-danger">{{ $errors->first('item_id') }}</small>
        </div> --}}
        <input type="hidden" name="item_id" value="{{ $serialNumber->item_id }}">
        <div class="form-group mb-3">
            <label class="form-label">Serial Number*</label>
            <div>
                <input type="text" name="serial_number" value="{{ $serialNumber->serial_number }}" class="form-control"
                    placeholder="Serial Number" required>
            </div>
            <small class="form-text text-danger">{{ $errors->first('serial_number') }}</small>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">In Date</label>
            <div>
                <input type="date" name="in_date" value="{{ $serialNumber->in_date }}" class="form-control"
                    placeholder="In Date">
            </div>
            <small class="form-text text-danger">{{ $errors->first('in_date') }}</small>
        </div>
    </div>
    </div>
    <div class="col-6">
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label">Out Date</label>
                <div>
                    <input type="date" name="out_date" value="{{ $serialNumber->out_date }}" class="form-control"
                        placeholder="Out Date">
                </div>
                <small class="form-text text-danger">{{ $errors->first('out_date') }}</small>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">MR NO</label>
                <div>
                    <input type="text" name="mr_no" value="{{ $serialNumber->mr_no }}" class="form-control"
                        placeholder="MR NO">
                </div>
                <small class="form-text text-danger">{{ $errors->first('mr_no') }}</small>
            </div>
        </div>
    </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('serial-number.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection

@section('js')
@endsection
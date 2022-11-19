@extends('layouts.app')

@section('title', 'Import Serial-Number')

@section('content')
<form action="{{ route('serial-number.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        Upload file sesuai template: (<a href="{{ url('serial-number-template.xlsx') }}">Template File</a>)
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
        <div class="col-12">
            <div class="card-body">
                <div class="form-group mb-3">
                    <input type="file" name="serial_number" class="form-control-file">
                    <br />
                    <small class="form-text text-danger">{{ $errors->first('serial_number') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('serial-number.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.upload')</button>
        </div>
    </div>
</form>
@endsection
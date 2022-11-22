@extends('layouts.app')

@section('title', 'ASP')

@section('content')
<form action="{{ route('logistic.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="col-6">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Name</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Name">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('logistic.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection
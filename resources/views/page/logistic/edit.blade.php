@extends('layouts.app', ['title' => 'ASP'])


@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css"
    integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<form method="post" action="{{ route('logistic.update',$logistic->id) }}" enctype="multipart/form-data" class="card">
    @csrf
    @method("PATCH")
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
                    <label class="form-label">@lang('web.name')*</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name', $logistic->name) }}" class="form-control"
                            placeholder="@lang('web.enter-name')">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="{{ route('logistic.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
                <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"
    integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$("#select-logistic").selectize({
    create: true,
    sortField: "text",
    placeholder: "Select ASP",
    create: false,
});
</script>
@endsection
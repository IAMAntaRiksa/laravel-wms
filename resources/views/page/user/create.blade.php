@extends('layouts.app', ['title' => 'User'])


@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css"
    integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" class="card">
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
                    <label class="form-label">@lang('web.username')*</label>
                    <div>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                            placeholder="@lang('web.enter-username')">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                </div>
                <div class="mb-3">
                    <div class="form-label">@lang('web.logistic')</div>
                    <select name="logistic_id" id="select-logistic">
                        <option></option>
                        @foreach($logistics as $logistic)
                        <option value="{{ $logistic->id }}" {{ old('logistic_id') == $logistic->id ? 'selected':'' }}>
                            {{ ucwords($logistic->name) }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('logistic_id') }}</small>
                </div>
                <div class="mb-3">
                    <div class="form-label">@lang('web.select-role')*</div>
                    <select name="role_id" class="form-select">
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected':'' }}>
                            {{ ucwords($role->name) }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-danger">{{ $errors->first('role_id') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Signature</label>
                    <input type="file" name="file" class="form-control-file">
                    <br />
                    <small class="form-text text-danger">{{ $errors->first('file') }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">@lang('web.name')</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="@lang('web.enter-name')">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">@lang('web.password')*</label>
                    <div>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                            placeholder="@lang('web.enter-password')" autocomplete="new-password">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">@lang('web.confirm-password')*</label>
                    <div>
                        <input type="password" name="confirmPassword" value="{{ old('confirmPassword') }}"
                            class="form-control" placeholder="@lang('web.enter-confirm-password')">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('confirmPassword') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('user.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
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
$("#select-logistic").selectize({
    create: true,
    sortField: "text",
    placeholder: "Select ASP",
    create: false,
});
</script>
@endsection
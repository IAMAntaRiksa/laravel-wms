@extends('layouts.app', ['title' => 'Role'])

@section('content')
<form action="{{ route('role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
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
                <div class="form-group mb-3">
                    <label class="form-label">Name</label>
                    <div>
                        <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control"
                            placeholder="Name">
                    </div>
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card-body">
                <div class="form-group mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permission as $key=>$data )
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            name="permission[]" value="{{ $data->id }}"
                                            @checked($role->permissions()->find($data->id))>
                                    </div>
                                </td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <small class="form-text text-danger">{{ $errors->first('permission') }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="{{ route('role.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
            <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
        </div>
    </div>
</form>
@endsection
@extends('layouts.app')

@section('title', 'Warehouse')

@section('content')
@if($errors->first('message'))
<div class="col-12">
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('message') }}
    </div>
</div>
@endif
@if(Session::has('message'))
<div class="col-12">
    <div class="alert alert-info" role="alert">
        {{ Session::get('message') }}
    </div>
</div>
@endif
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        <a href="{{route('warehouse.create')}}"
                            class="btn btn-primary btn-sm btn-loader">@lang('web.create')</a>
                        <a href="{{route('warehouse.import')}}"
                            class="btn btn-primary btn-sm btn-loader">@lang('web.import')</a>
                    </div>
                    <div class="ms-auto text-muted">
                        <form>
                            <div class="ms-2 d-inline-block">
                                <input type="text" name="q" value="{{ Request::get('q') }}"
                                    class="form-control form-control-sm" aria-label="Search">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm btn-loader">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Adress</th>
                            <th class="text-center">Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $key=>$data)
                        <tr>
                            <td>
                                <span class="text-muted">
                                    {{ ++$key +($datas->currentPage()-1) * $datas->perPage() }}</span>
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->code }}</td>
                            <td>{{ $data->address }}</td>
                            <td class="text-center">
                                @php
                                switch($data->type)
                                {
                                case 'main':
                                $check = 'success';
                                break;
                                default:
                                $check = 'info';
                                }
                                @endphp
                                <span class="badge btn-{{ $check }}">{{ $data->type }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{route('warehouse.edit', $data->id)}}"
                                    class="btn btn-info btn-sm btn-loader">@lang('web.edit')</a>
                                <a href="#" data-href="{{route('warehouse.destroy', $data->id)}}"
                                    class="btn btn-danger btn-sm btn-delete">@lang('web.delete')</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <div class="pagination m-0 ms-auto">
                    {{ $datas->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
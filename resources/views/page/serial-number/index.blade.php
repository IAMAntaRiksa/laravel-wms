@extends('layouts.app', ['title' => 'Serial-Number'])

@section('title', 'Serial Number')

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
                        <a href="{{ route('serial-number.import') }}"
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
                            <th>ITEM ID</th>
                            <th>SERIAL NUMBER</th>
                            <th>IN DATE</th>
                            <th>OUT DATE</th>
                            <th>MR NO</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $key => $data)
                        <tr>
                            <td><span class="text-muted">
                                    {{ ++$key +($datas->currentPage()-1) * $datas->perPage() }}</span></td>
                            <td>{{ $data->item_id }}</td>
                            <td>{{ $data->serial_number }}</td>
                            <td>{{ $data->in_date }}</td>
                            <td>{{ $data->out_date }}</td>
                            <td>{{ $data->mr_no }}</td>
                            <td class="text-end">
                                <a href="{{ route('serial-number.edit', $data->id)}}"
                                    class="btn btn-info btn-sm btn-loader">@lang('web.edit')</a>
                                <a href="#" data-href="{{ route('serial-number.destroy', $data->id)}}"
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
</div>
@endsection

@section('js')
@endsection
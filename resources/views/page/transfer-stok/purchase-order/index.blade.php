@extends('layouts.app')

@section('title', 'Purchase Order')

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
                        <a href="{{route('purchase-order.create')}}"
                            class="btn btn-primary btn-sm btn-loader">@lang('web.create')</a>
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
                            <th>Order Reference No</th>
                            <th class="text-center">Warehouse</th>
                            <th class="text-center">Open</th>
                            <th class="text-center">File</th>
                            {{-- <th>Item</th>--}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $key=>$data)
                        <tr>
                            <td><span class="text-muted">
                                    {{ ++$key +($datas->currentPage()-1) * $datas->perPage() }}</span></td>
                            <td>{{ $data->order_reference_no }}</td>
                            <td>{{ $data->warehouse->code }} - {{ $data->warehouse->name }}</td>
                            <td class="text-center">
                                @php
                                switch($data->is_open)
                                {
                                case 1:
                                $check = 'success';
                                break;
                                default:
                                $check = 'danger';
                                }
                                @endphp
                                <span class="badge btn-{{ $check }}">{{ $data->is_open == 1 ? 'Yes' : 'No' }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ $data->file_path }}" type="button" class="btn btn-info btn-sm"
                                    target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-text" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <line x1="9" y1="9" x2="10" y2="9"></line>
                                        <line x1="9" y1="13" x2="15" y2="13"></line>
                                        <line x1="9" y1="17" x2="15" y2="17"></line>
                                    </svg> Download
                                </a>
                            </td>
                            <td>
                                <ul>
                                    @foreach($data->items as $item)
                                    @php
                                    $qty = $item->qty_incoming + $item->qty_arrived
                                    @endphp
                                    <li>
                                        {{ $qty }} qty - {{$item->detail->item_number}} -
                                        {{ $item->detail->product_name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-info btn-sm btn-loader">@lang('web.edit')</a>
                                <a href="#" data-href="#"
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
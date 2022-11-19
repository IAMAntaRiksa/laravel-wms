@extends('layouts.app', ['title' => 'Dasboard'])

@section('css')
<style>
.card-body.p-2 {
    padding-top: 20px !important;
}

.col-sm-2 {
    margin-bottom: 20px;
}

.table-responsive {
    margin-bottom: 0px !important;
}
</style>
@endsection

@section('content')
<div class="row row-card">
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>100</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        Purchase Order
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>200</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        Material Request
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>300</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        Item
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>600</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        Warehouse
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>400</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        Serial Number
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body p-2 text-center">
                <div class="m-0">
                    <h1>500</h1>
                </div>
                <div class="text-muted mb-3">
                    <a href="#">
                        ASP
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.backend')


@section('css')
<link rel="stylesheet" href="{{ asset('backend/css/dataTable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable/select.dataTables.min.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">
@endsection

@section('specCss')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/ltc/order.css') }}">
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('backend/js/dataTable/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.checkboxes.js') }}"></script>
<script src="{{ asset('/backend/js/order_func.js') }}"></script>
<script>
    $(document).ready(function() {
        // Load dữ liệu table
        LoadDataTable();
    });
</script>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <small>Đặt hàng</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-chart-line"></i> Home</a></li>
            <li class="active"><i class="fas fa-tags"></i> Đặt hàng</li>
        </ol>
    </section>
    <div class="content">
        <div class="row _table">
            <div class="col-xs-12">
                <div class="box">
                    <!-- Table title -->
                    <div class="box-header">
                        <h3 class="box-title">Danh sách các đơn hàng</h3>
                    </div>
                    <!-- //Table title -->
                    <div class="box-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="_th_checkbox"></th>
                                    <th class="_th_name">Mã đơn hàng</th>
                                    <th class="_th_price">Tên khách hàng</th>
                                    <th class="_th_qty">Email Khách hàng</th>
                                    <th class="_th_category_id">Sđt khách</th>
                                    <th class="_th_description">Địa chỉ</th>
                                    <th class="_th_keyword">Trạng thái</th>
                                    <th class="_th_action">action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email Khách hàng</th>
                                    <th>Sđt khách</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
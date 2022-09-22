@extends('layouts.backend')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/css/dataTable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable/select.dataTables.min.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">
<!-- Select 2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<!-- ./ Select2 -->
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('backend/js/dataTable/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.checkboxes.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/js/order_func.js') }}"></script>
<script>
    // Khởi tạo dropdown
    $('.status').select2();

    // Load datatable
    LoadOrderStatusesDataTable();
</script>
<!-- ./Selecte2 -->
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <small>Cập nhật trạng thái</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-chart-line"></i> Home</a></li>
            <li><a href="/admin/order/"><i class="fas fa-tags"></i> Đặt hàng</a></li>
            <li class="active"> {{ $order->order_code }}</li>
        </ol>
    </section>
    <div class="content">
        <!-- Nếu có lỗi đẩy ra -->
        @error('errorMsg')
        <div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
            <div class="modal-dialog" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="x" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Có lỗi rồi nè</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ $message }}</p>
                    </div>
                    <div class="modal-footer">
                        <a id="closeModal" href="#!" class="btn btn-default pull-left">Đóng</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @enderror
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật trạng thái đơn hàng</h3>
                    </div>
                    <form action="{{ route('doUpdateOrder') }}" method="post" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <div class="box-body">

                            <div id="data-form" class="form-group"><label for="msg" class="col-lg-2 col-sm-3 control-label">Chi tiết tình trạng</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input class="form-control" type="text" name="msg" {{ $order->status == -1 || $order->status == 5 || $order->status == 4 ? 'disabled' : null }}>
                                    @error('msg')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-lg-2 col-sm-3 control-label">Trạng thái</label>
                                <div class="col-lg-10 col-sm-9">
                                    <select class="form-control status" style="width: 100%;" name="status" {{ $order->status == -1 || $order->status == 5 || $order->status == 4 ? 'disabled' : null }}>
                                        <option {{ $order->status == -1 ? 'selected' : null }} value="-1">Huỷ</option>
                                        <option {{ $order->status == 0 ? 'selected' : null }} value="0">Đang chờ</option>
                                        <option {{ $order->status == 1 ? 'selected' : null }} value="1">Đã tiếp nhận</option>
                                        <option {{ $order->status == 2 ? 'selected' : null }} value="2">Đang giao</option>
                                        <option {{ $order->status == 3 ? 'selected' : null }} value="3">Đã giao</option>
                                        <option {{ $order->status == 4 ? 'selected' : null }} value="4">Hoàn trả</option>
                                    </select>
                                </div>
                            </div>

                            <div class="box-footer" style="text-align:center">
                                <a href="/admin/order" class="btn btn-default" style="margin:0px 15px">Trở lại</a>
                                <button type="submit" class="btn btn-info" {{ $order->status == -1 || $order->status == 5 || $order->status == 4 ? 'disabled' : null }}>Câp nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row _table">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-headr">
                        <h3 class="box-title">Danh sách thông tin trạng thái đơn hàng</h3>
                    </div>
                    <div class="box-body">
                        <table id="data_table" class="table table-bordered table-striped" data-id="{{ $order->id }}">
                            <thead>
                                <tr>
                                    <th class="_th_checkbox"></th>
                                    <th class="_th_name">Ngày cập nhật</th>
                                    <th class="_th_price">Chi tiết</th>
                                    <th class="_th_action">action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Ngày cập nhật</th>
                                    <th>Chi tiết</th>
                                    <th>action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row _table">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-headr">
                        <h3 class="box-title">Danh sách sản phẩm đã đặt:</h3>
                    </div>
                    <div class="box-body">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="">Tên sản phẩm</th>
                                    <th class="">Số lượng</th>
                                    <th class="">Đơn giá</th>
                                    <th class="">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderProduct as $item)
                                <tr>
                                    <td class="">{{$item->productName}}</td>
                                    <td class="">{{$item->productQty}}</td>
                                    <td class="">{{$item->productPrice}}</td>
                                    <td class="">{{$item->ProductAmount}}</td>
                                </tr>
                                @endforeach                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
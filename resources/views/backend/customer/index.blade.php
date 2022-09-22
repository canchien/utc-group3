@extends('layouts.backend')
@section('content')

    <style>

    </style>

    <div class="content-wrapper">

    <section class="content-header">
    <h1>
        Quán Lý Nhân Viên
    </h1>
    <ol class="breadcrumb">
    <li><a href="/admin"><i class="fas fa-chart-line    "></i> Home</a></li>
    <li><a href="{{ route('list.customer') }}"><i class="fas fa-user"></i> Quản lý nhân viên</a></li>
    
    </section>

        <div class="content">

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 ltc">
                    <a href="{{ route('create.customer') }}" class="_create"><i class="fa fa-plus"></i> Thêm</a>
                </div>
            </div>

            <div class="row _table">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- Table title -->
                        <div class="box-header">
                            <h3 class="box-title">Danh sách  nhân viên</h3>
                        </div>
                        <!-- //Table title -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead >
                                <tr style="background: #3c8dbc!important; color: white">
                                    <th >#</th>
                                    <th >Họ và tên</th>
                                    <th >Địa chỉ</th>
                                    <th >Số điện thoại</th>
                                    <th >Giới tính</th>
                                    <th >Email</th>
                                    <th >Mô tả</th>
                                    <th >Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($users))
                                    @foreach($users as $index =>$user)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->sex ==1 ? 'Nam' :'Nữ'}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->description}}</td>
                                            
                                            <td>
                                                <a href="{{route('edit.customer',$user->id)}}" class="btn btn-social-icon btn-bitbucket btn-edit"><i class="fa fa-edit"></i> </a>
                                                @if (auth()->user()->id!=$user->id)<a data-id={{ $user->id }} href="javascript:void(0);" id="action-delete" style="background: #e66969;" class="btn btn-social-icon btn-bitbucket btn-delete"><i class="fa fa-trash"></i> </a>@endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/css/dataTable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable/select.dataTables.min.css') }}">
    <link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">
@endsection

@section('js')
    <script src="{{ asset('backend/js/customer/index.js') }}"></script>
    {{--    // Form validation--}}
    {{--    $(document).ready(function() {--}}
    {{--        $.validate({--}}
    {{--            form: '#_create-form'--}}
    {{--        });--}}
    {{--        $('#productDescription').restrictLength($('#des-max-length'));--}}
    {{--        $('#productKeyword').restrictLength($('#keyword-max-length'));--}}

    {{--        // Gọi hàm load dữ liệu ra bảng--}}
    {{--        //--}}
    {{--        LoadDataTable();--}}
    {{--    });--}}
    {{--</script>--}}
@endsection

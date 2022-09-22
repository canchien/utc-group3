@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý nhân viên
                <small>Thêm nhân viên</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/admin/category"><i class="fa fa-list-alt"></i> Customer</a></li>
                <li class="active">New</li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm mới nhân viên</h3>
                        </div>
                        @include('backend.customer.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

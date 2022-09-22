@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <small>Ảnh</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-chart-line"></i> Home</a></li>
            <li><a href="/admin/product"><i class="fas fa-tshirt"></i> Sản phẩm</a></li>
            <li><a href="/admin/product"><i class="fas fa-tshirt"></i> {{ $product->id }}</a></li>
            <li class="active"><i class="fas fa-images"></i> Ảnh</li>
        </ol>
    </section>

    <div class="content" style="min-height: 1px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid bg-light-blue-gradient">
                    <!-- Box header -->
                    <div class="box-header">
                        <i class="fas fa-plus-circle    "></i>
                        <h3 class="box-title" style="user-select: none;">Thêm ảnh</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus" style="color: #fff;"></i>
                            </button>
                        </div>
                    </div>
                    <!-- ./ box header -->
                    <!-- box body -->
                    <div class="box-body no-padding">
                        <form id="data-form" action="{{ route('doUpdateImage') }}" method="post"
                            enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label class="col-lg-1 col-sm-2 control-label" for="image"
                                    style="user-select: none;">Ảnh</label>
                                <div class="col-lg-11 col-sm-10" style="padding-right: 30px;">
                                    <input id="image" name="image[]" type="file" class="file" multiple
                                        data-show-upload="false" data-show-caption="true" data-show-preview="false"
                                        data-msg-placeholder="Chọn ảnh..." style="border:none;"
                                        data-msg-filestoomany="Quá nhiều ảnh">
                                    @error('image')
                                    <span class="invalid-feedback text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-1 col-sm-2 control-label" for="alt"
                                    style="user-select: none;">Alt</label>
                                <div class="col-lg-11 col-sm-10" style="padding-right: 30px;">
                                    <input type="text" class="form-control" name="alt" id="alt"
                                        aria-describedby="helpId" placeholder="Nhập mô tả ảnh" style="border:none;"
                                        value="{{ old('alt') }}">
                                    @error('alt')
                                    <span class="invalid-feedback text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-info _create"
                            onclick="event.preventDefault();$('#data-form').submit();">Thêm</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-success with-border">
                        <div class="box-header">
                            <i class="fas fa-percent    "></i>
                            <h3 class="box-title" style="user-select: none;">Chức năng</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus" style="color: #000;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <button data-id={{ $product->id }} type="button" class="btn btn-github _set-active"><i class="fas fa-flag"></i> Set Active</button>
                            <button type="button" class="btn btn-danger _delete-multi-img"><i class="fas fa-trash    "></i> Xoá</button>
                            <button type="button" class="btn btn-google-plus _unactive" style="display: none;">Un Active</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success with-border">
                        <div class="box-header">
                            <h3 class="box-title" style="user-select: none;">Danh sách các ảnh</h3>
                        </div>
                        <div class="box-body" style="padding-bottom: 30px;">
                            <div class="content-area">
                                <div class="rows">

                                    @include('backend.products.imagesIndexAjaxContent')

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal01" class="modal" onclick="this.style.display='none'">
                        <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <div class="modal-content">
                            <img id="img01" style="max-width:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('css')
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-fileinput/css/fileinput.css') }}">
@endsection
@section('js')
<script src="{{ asset('backend/js/product_func.js') }}"></script>
<script src="{{ asset('backend/css/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('backend/css/bootstrap-fileinput/themes/fa/theme.js') }}"></script>
<script>
$('#image').fileinput({
    themes: 'fa',
    maxFileCount: 10,
    maxFileSize: 2000,
    validateInitialCount: true,
    overwriteInitial: false,
    allowedFileExtensions: ["jfif", "jpeg", "jpg", "png", "gif"],
});
</script>
@endsection

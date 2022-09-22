@extends('layouts.backend')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-fileinput/css/fileinput.css') }}">
@endsection

@section('js')
<!-- CK Editor -->
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/css/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('backend/css/bootstrap-fileinput/themes/fa/theme.js') }}"></script>
<script>
$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('description')
});
$('#image').fileinput({
    themes: 'fa',
    overwriteInitial: false,
    maxFileNum: 5,
});
</script>
@endsection


@section('content')


<div class="content-wrapper">
    @include('layouts.partions.backend.main-fixed.content.content_header_master')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">chỉnh sửa thông tin sản phẩm</h3>
                    </div>

                    <form id="data-form" action="{{ route('product.update',['product'=> $product_data, 'id'=> $product_data->id]) }}" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-lg-2 col-sm-3 control-label">Tên sản phẩm</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nhập tên sản phẩm" value="{{ old('name',$product_data->name) }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-lg-2 col-sm-3 control-label">Tên giá sản phẩm</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Nhập giá sản phẩm" value="{{ old('price',$product_data->price) }}">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qty" class="col-lg-2 col-sm-3 control-label">Số lượng</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input type="number" name="qty" id="qty" class="form-control" placeholder="Số lượng"
                                        value="{{ old('qty',$product_data->qty) }}">

                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-lg-2 col-sm-3 control-label">Ảnh</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input id="image" name="image[]" type="file" class="file" multiple
                                        data-show-upload="false" data-show-caption="true" data-show-preview="false"
                                        data-msg-placeholder="Chọn ảnh...">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="col-lg-2 col-sm-3 control-label">Mã loại danh mục</label>
                                <div class="col-lg-10 col-sm-9">
                                    <select name="category_id" id="category_id">
                                        <option value="-1">Chọn một danh mục</option>
                                        @foreach($categories as $category)
                                        @if($product_data->category_id == $category->id)
                                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="keyword" class="col-lg-2 col-sm-3 control-label">Key Word</label>
                                <div class="col-lg-10 col-sm-9">
                                    <textarea name="keyword" id="keyword" rows="3"
                                        class="form-control">{{ old('keyword',$product_data->keyword) }}</textarea>
                                    @error('keyword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="keyword" class="col-lg-2 col-sm-3 control-label">Mô tả</label>
                                <!-- /.box-header -->
                                <div class="col-lg-10 col-sm-9">
                                    <textarea id="description" name="description" rows="10" cols="80">{{ old('description', $product_data->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="box-footer" style="text-align:center">
                            <a href="/admin/product" class="btn btn-default" style="margin:0px 15px">Trở lại</a>
                            <button type="submit" class="btn btn-info"
                                onclick="event.preventDefault();document.getElementById('data-form').submit();">
                                Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('form')
<div class="col-md-6 col-md-offset-3">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm mới danh mục</h3>
        </div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <form action="{{ route('category.store') }}" method="post" class="form-horizontal">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="categoryName" class="col-sm-4 control-label">Tên Category</label>
                    <div class="col-sm-6">
                        <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Nhập tên Category">
                    </div>
                </div>
                <div class="form-group">
                    <label for="des" class="col-sm-4 control-label">Description</label>
                    <div class="col-sm-6">
                        <textarea name="des" id="des" rows="3" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keyword" class="col-sm-4 control-label">Key Word</label>
                    <div class="col-sm-6">
                        <textarea name="keyword" id="keyword" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="text-align:center">
                <a href="/admin/category" class="btn btn-default" style="margin:0px 15px">Trở lại</a>
                <button type="submit" class="btn btn-info">Thêm</button>
            </div>
        </form>
    </div>
</div>
@endsection
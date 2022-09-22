<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 ltc">
            <a href="javascript:void(0)" class="_create"><i class="fa fa-plus"></i> Thêm</a>
            <a href="javascript:void(0)" class="_delete"><i class="fa fa-remove"></i> Xoá</a>

        </div>
    </div>
    <div class="row _them-form" style="display: none">
        <div class="col-md-12">
            <div class="box box-info">
                

                <!-- Box header title , with bx tool -->
                <div class="box-header with-border">
                    <h3 class="box-title _form_title">Thêm mới danh mục</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- // -->
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <div class="box-body">
                    <form id="_create-form" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group col-md-3">
                            <div class="row">
                                <label for="categoryName" class="col-md-5 control-label">Tên danh mục</label>
                                <div class="col-md-7">
                                    <input data-validation="required length"
                                    data-validation-length="2-50"
                                    data-validation-error-msg="Nhập tên hợp lệ (độ dài từ 2-50 kí tự)"
                                     type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Nhập tên Category">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="category-description" class="col-md-2 control-label">Mô tả</label>
                            <div class="col-md-10">
                                <textarea name="category-description" id="category-description" rows="1" class="form-control">Không có mô tả</textarea>
                                <span class="help-block" style="">Còn lại <span id="des-max-length">255</span> ký tự</span>
                            </div>
                            
                        </div>

                        <div class="form-group col-md-4">
                            <label for="category_keyword" class="col-md-3 control-label">Từ khoá</label>
                            <div class="col-md-9">
                                <textarea 
                                data-validation="required"
                                data-validation-error-msg="Nhập một vài từ khoá đi nào"
                                name="category_keyword" id="category_keyword" rows="1" class="form-control"></textarea>
                                <span class="help-block" style="">Còn lại <span id="keyword-max-length">255</span> ký tự</span>
                            </div>
                        </div>
                        <input type="hidden" name="button_action" id="button_action" value="insert">
                        <input type="hidden" name="edit_category_id" id="edit_category_id" value="">
                    </form>
                </div>
                <div class="box-footer" style="text-align:center">
                    <a href="#" class="btn btn-default" style="margin:0px 15px">Đóng</a>
                    <button type="submit" class="btn btn-info _btn_execute" onclick="_execute();">Thêm</button>
                </div>

            </div>
        </div>
    </div>
    <div class="row _table">
        <div class="col-xs-12">
            <div class="box">
                <!-- Table title -->
                <div class="box-header">
                    <h3 class="box-title">Danh sách các danh mục</h3>
                </div>
                <div id="paginationListUsers" style="margin-bottom: 10px; display: flex;">
                    <input class="form-control" type="text" placeholder="Page" id="inputPaginationListUsers" style="width: 60px; margin-right: 5px;">
                    <button class="btn btn-primary" id="buttonPaginationListUsers">
                        Go
                    </button>
                </div>
                <!-- //Table title -->
                <div class="box-body">
                    <table id="category_data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th id="id">#</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Từ khoá</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th id="id">#</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Từ khoá</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
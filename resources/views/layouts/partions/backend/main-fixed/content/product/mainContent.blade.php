<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 ltc">
            <a href="{{ route('product.create') }}" class="_create"><i class="fa fa-plus"></i> Thêm</a>
            <a href="javascript:void(0)" class="_delete"><i class="fas fa-trash-alt"></i> Xoá</a>
        </div>
    </div>

    <div class="row _table">
        <div class="col-xs-12">
            <div class="box">
                <!-- Table title -->
                <div class="box-header">
                    <h3 class="box-title">Danh sách các sản phẩm</h3>
                </div>
                <div id="paginationListUsers" style="margin-bottom: 10px; display: flex; margin-left: 15px;">
                    <input class="form-control" type="text" placeholder="Page" id="inputPaginationListUsers" style="width: 60px; margin-right: 5px;">
                    <button class="btn btn-primary" id="buttonPaginationListUsers">
                        Go
                    </button>
                </div>
                <!-- //Table title -->
                <div class="box-body">
                    <table id="data_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="_th_checkbox"></th>
                                <th class="_th_id" id="id">#</th>
                                <th class="_th_name">Tên sản phẩm</th>
                                <th class="_th_price">Giá</th>
                                <th class="_th_qty">Số lượng</th>
                                <th class="_th_category_id">Loại danh mục</th>
                                <th class="_th_description">Mô tả</th>
                                <th class="_th_keyword">từ khoá</th>
                                <th class="_th_action">action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th id="id">#</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Loại danh mục</th>
                                <th>Mô tả</th>
                                <th>từ khoá</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

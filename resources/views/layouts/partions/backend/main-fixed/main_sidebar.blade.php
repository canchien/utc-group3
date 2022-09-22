<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('backend/images/icon.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Illuminate\Support\Facades\Auth::check() ?? \Illuminate\Support\Facades\Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Menu</li>
            <li class="">

                <a href="/admin">
                    <i class="fas fa-chart-line    "></i> <span>Bảng thông tin</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/category">
                    <i class="fa fa-list-alt"></i> <span>Quản lý danh mục</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/product">
                    <i class="fas fa-tshirt"></i> <span>Quản lý sản phẩm</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/order">
                    <i class="fas fa-tags"></i> <span>Quản lý đặt hàng</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/customer">
                    <i class="fas fa-tags"></i> <span>Quản lý nhân viên</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

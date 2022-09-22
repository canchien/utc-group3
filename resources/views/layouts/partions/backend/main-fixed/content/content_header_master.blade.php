<section class="content-header">
  @if($type=="product")
  <h1>
    Quản lý sản phẩm
    @if($data=="create" || $data=="edit")
    <small>Thêm mới sản phẩm</small>
  </h1>
  <ol class="breadcrumb">
    <li class="@yield('activeOrNot_1')"><a href="/admin"><i class="fas fa-chart-line    "></i> Home</a></li>
    <li><a href="/admin/product"><i class="fas fa-tshirt"></i> Sản phẩm</a></li>
    <li class="active"><i class="fas fa-plus-circle    "></i> {{ $data=="create"?"Thêm mới":"Sửa" }}</li>
    @elseif($data=="index")
    <small>Danh sách sản phẩm</small>
    </h1>
    <ol class="breadcrumb">
      <li class="@yield('activeOrNot_1')"><a href="/"><i class="fa fa-chart-line"></i> Home</a></li>
      <li class="active"><i class="fas fa-tshirt"></i> Sản phẩm</li>
    </ol>
    @endif
    @elseif($type=="category")
    <h1>
      Quản lý danh mục
      @if($data=="create" || $data=="edit")
      <small>Thêm mới danh mục</small>
    </h1>
    <ol class="breadcrumb">
      <li class="@yield('activeOrNot_1')"><a href="/"><i class="fas fa-chart-line"></i> Home</a></li>
      <li><a href="/admin/category"><i class="fa fa-list-alt"></i> Danh mục</a></li>
      <li class="active"><i class="fas fa-plus-circle" aria-hidden="true"></i> {{ $data=="create"?"Thêm mới":"Sửa" }}</li>
      @elseif($data=="index")
      <small>Danh sách danh mục</small>
      </h1>
      <ol class="breadcrumb">
        <li class="@yield('activeOrNot_1')"><a href="/"><i class="fa fa-chart-line"></i> Home</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> Danh mục</li>
      </ol>
      @endif
      @endif
</section>
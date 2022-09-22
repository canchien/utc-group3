@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    @include('layouts.partions.backend.main-fixed.content.content_header_master')
    @include('layouts.partions.backend.main-fixed.content.product.mainContent')
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('backend/css/dataTable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable/select.dataTables.min.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('backend/js/dataTable/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.checkboxes.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/product_func.js') }}"></script>
<script>
    // Form validation
    $(document).ready(function() {
        $.validate({
            form: '#_create-form'
        });
        $('#productDescription').restrictLength($('#des-max-length'));
        $('#productKeyword').restrictLength($('#keyword-max-length'));

        // Gọi hàm load dữ liệu ra bảng
        //
        LoadDataTable();
    });
</script>
@endsection
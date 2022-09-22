@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    @include('layouts.partions.backend.main-fixed.content.category.content_header')
    @include('layouts.partions.backend.main-fixed.content.category.mainContent')
</div>
@endsection

@section('css')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/se-1.2.2/datatables.min.css"> -->
<link rel="stylesheet" href="{{ asset('backend/css/dataTable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable/select.dataTables.min.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type='text/css' href="{{ asset('backend/css/dataTable/awesome-bootstrap-checkbox.css') }}">

@endsection

@section('js')
<!-- <script src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/se-1.2.2/datatables.min.js"></script> -->
<script src="{{ asset('backend/js/dataTable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/js/dataTable/dataTables.bootstrap4.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dataTable/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ asset('backend/js/func_admin.js') }}"></script>
<script>
</script>
@endsection
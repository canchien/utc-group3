<!DOCTYPE html>
<html style="height:auto">

<head>
    @include('layouts.partions.backend.main-fixed.head_html')

    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

</head>

<body class="hold-transition login-page">
    @error('errorMsg')
    <div class="modal modal-danger fade in" id="modal-danger" style="display: block; padding-right: 17px;">
        <div class="modal-dialog" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Cảnh báo</h4>
                </div>
                <div class="modal-body">
                    <p>{{ $message }}</p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-outline pull-left" id="closeModal">Close</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @enderror
    <div class="login-box">
        <div class="login-logo">
            <a href="admin/"><b>Dasboard</b>&nbsp;Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Hãy đăng nhập tài khoản quản trị viên của bạn</p>

            <form action="{{ route('admin.doLogin') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                    <span>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                    <span>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
                <div class="row" <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
        </div>
        </form>
    </div>
    <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- ./wrapper -->
    @include('layouts.partions.backend.main-fixed.js_file')
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
        $(document).ready(function() {
            //
            // Slide down modal khi có lỗi trả về
            $('.modal-dialog').slideToggle();
            // Đóng bảng lỗi
            $(document).on('click', '#closeModal, #x', function() {
                $('#modal-danger').slideToggle();
            });
        });
    </script>
</body>

</html>
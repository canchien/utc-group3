// Reload Table 
function ReloadTable(selector) {
    // Load lại bảng
    var dbTable = $(selector).DataTable();
    dbTable.ajax.reload(null, false); // null, false giữ lại trang hiện tại
}

// Thông báo lỗi 
function ErrorNotifications(errorTitle, errorContent) {
    Swal.fire({
        type: 'error',
        title: errorTitle,
        text: errorContent,
    });
}

// thông báo góc phải màn hình
function Notifications(notiString) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    Toast.fire({
        type: 'success',
        title: notiString
    })
}

$(document).ready(function () {
    // 
    // Hiển thị loading ****
    $(document).ajaxStart(function () {
        console.log('start');
        $('.ltc-loading').css({
            "display": "flex",
        });
    });
    //
    $(document).ajaxStop(function () {
        console.log('stop');
        $('.ltc-loading').css({
            "display": "none",
        });
    });
    // hết ******************
});

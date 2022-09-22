$(document).ready(function() {
    "use strict";
    $(document).on('click', '#action-delete', function(e) {
        e.preventDefault();
        let cId = $(this).attr('data-id');
        Swal.fire({
            title: 'Warning',
            text: "Bạn có muốn xoá nhân viên này ?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok !'
        }).then((result) => {
            if (result.value) {
                $(this).parent().parent().remove();
                $.ajax({
                    type: "delete",
                    url: route('staff.destroy', { staff: cId }),
                    dataType: 'json'
                }).done(function(res) {
                    if (res.status == 200) {
                        Notifications("Đã xoá thành công 1 bản ghi");
                    } else {
                        ErrorNotifications("Lỗi!!!", res.message);
                    }
                }).fail(function(res) {
                    console.log(res.message);
                });
            }
        });
    });
});
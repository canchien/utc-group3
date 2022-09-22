//
// Khoiu tao bien table
//
var table = $('#data_table');
// Ready Jquery
$(document).ready(function() {
    //
    // goto page
    $('#buttonPaginationListUsers').click(function() {
        console.log('hi');
        var inputPage = parseInt($('#inputPaginationListUsers').val());
        var dtb = table.DataTable();
        var totalPages = dtb.page.info().pages;
        //console.log(totalPages);

        if (!inputPage) {
            Swal.fire({
                type: 'error',
                title: 'Ẹcc...',
                text: 'Hãy nhập vào 1 số!',
            });
            dtb.off();
        } else if (inputPage > totalPages) {
            Swal.fire({
                type: 'error',
                title: 'Ẹcc...',
                text: 'Số trang không hợp lệ!',
            });
        } else {
            dtb.page(inputPage - 1).draw(false);
        }
    });
    // **********************
    //
    // edit button
    //
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).parent().parent().children('td.sorting_1').text();
        window.location = `product/${id}/edit`;
    });
    // **********************
    // Delete btn a recorrds
    //
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).attr('product-id');
        console.log(id);
        Swal.fire({
            title: 'Warning',
            text: "Bạn có muốn xoá bản ghi này hơm ?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok !'
        }).then((result) => {
            if (result.value) {
                // $(this).parent().parent().remove();
                $.ajax({
                    type: "POST",
                    url: route('product.destroyA'),
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        console.log(data.status);
                        ReloadTable('#data_table');
                        Notifications("Đã xoá thành công 1 bản ghi");
                    },
                    error: function(data) {
                        var er = data.responseJSON;
                        ErrorNotifications('Ẹccc...', 'Phát sinh lỗi ! F12 để biết thêm chi tiết ! (Xem lại Route)');
                        console.log(er);
                    }
                });
            }
        });
    });

    // MultiDelete Record
    $(document).on('click', '._delete', function() {
        var myTable = table.DataTable();
        var row_selected = myTable.rows({
            selected: true
        }).data().toArray();
        var Ids = [];
        row_selected.forEach(function(item) {
            Ids.push(item.id);
        });
        //console.log(Ids);
        if (Ids.length > 0) {
            Swal.fire({
                title: 'Nhắc nhẹ !',
                text: "Bạn có muốn xoá " + Ids.length + " bản ghi này không ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok, Cho nó bay màu đi!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: route('product.multiDestroy'),
                        data: {
                            id: Ids
                        },
                        success: function(response) {
                            // Load lại bảng
                            ReloadTable('#data_table');
                            Notifications("Đã xoá thành công " + Ids.length + " bản ghi");
                            console.log(response);
                        }
                    });
                }
            })

        } else {
            Swal.fire({
                title: 'Hãy chọn ít nhất một lựa chọn !',
                animation: false,
                customClass: {
                    popup: 'animated swing'
                }
            });
        }
    });

    // Tétt
    //
    $(document).on('click', '._test', function() {
        $.ajax({
            type: "get",
            url: route('product.getDataA'),
            data: {},
            dataType: "json",
            success: function(data) {
                console.log(data);
            }
        });
    });

    // Update image product
    // $(document).on('click', '.image-box-container', function () {
    //     // Lấy checkbox
    //     var chkbox = $(this).children().children().children('input');
    //     // Check và uncheck khi click vào cả container ảnh
    //     if (chkbox.is(":checked")) {
    //         chkbox.prop('checked', false);
    //         if (!$(this).hasClass('active')) {
    //             $(this).css({
    //                 'background': 'transparent'
    //             });
    //         }
    //     } else {
    //         chkbox.prop('checked', true);
    //         if (!$(this).hasClass('active')) {
    //             $(this).css({
    //                 'background': '#00a65a'
    //             });
    //         }
    //     }

    //     // Lấy số box image đã được check : ;
    //     var numChecked = $('#checkbox3:checked').length;

    //     // Nếu số tích lớn hơn 3 thì các ảnh còn lại sẽ ko tích được
    //     if (numChecked > 2) {
    //         console.log($('#checkbox3:not(:checked)').length);
    //     }

    // });

    // Click vào nút view
    $(document).on('click', '._view-image', function() {
        // Lấy đường dẫn ảnh
        var src = $(this).attr('data-src');
        // set đường dẫn ảnh cho img tag
        $('#img01').attr('src', src);
        // Hiển thị modal view ảnh
        $('#modal01').css('display', 'block');
    });

    // Click vào btn xoá ảnh
    $(document).on('click', '._delete-image', function() {
        var id = $(this).attr('data-id');
        // Lấy ra khối bao bọc toàn bộ ảnh và các button
        var thisImageBlock = $(this).parent().parent().parent();
        Swal.fire({
            title: 'Warning',
            text: "Bạn có muốn xoá ảnh này hơm ?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: route('deleteImage'),
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        // Xoá khối ảnh đi
                        console.log(thisImageBlock.remove());
                        Notifications("Đã xoá thành công ảnh");
                    },
                    error: function(data) {
                        var er = data.responseJSON;
                        ErrorNotifications('Ẹccc...', 'Phát sinh lỗi ! F12 để biết thêm chi tiết!');
                        console.log(er);
                    }
                });
            }
        });
    });

    // Click vào button set active ảnh
    $(document).on('click', '._set-active', function() {
        // Lấy id sp hiện tại
        var id = $(this).attr('data-id');
        // Lấy số box image đã được check : ;
        var numChecked = $('#checkbox3:checked').length;
        var ids = [];
        // duyệt lần lượt từng checkbox
        $.each($("#checkbox3:checked"), function() {
            // Nếu checkbox nào mà đã chưa có class active biểu thị là đã được kích hoạt thì thêm id vào mảng ids
            if (!$(this).parent().parent().parent().hasClass('active')) {
                ids.push($(this).attr('data-id'));
            }
        });
        // Nếu số checked trong khoảng từ 0 - 3 và không nằm trong những checkbox đã được kích hoạt
        if (numChecked <= 3 && numChecked > 0 && ids.length > 0) {
            $.ajax({
                type: "post",
                url: route('setActive'),
                data: {
                    "id": id,
                    "ids": ids,
                },
                dataType: "json",
                success: function(data) {
                    console.log(data.status);
                    // Nếu json trả về đã có 3 count trong db thì show thông báo
                    if (data.status == 'has3count') {
                        Swal.fire({
                            title: 'Kích hoạt được 3 cái thôi má',
                            animation: false,
                            customClass: {
                                popup: 'animated tada'
                            }
                        });
                        // ngược lại
                    } else {
                        // duyệt lần lượt từng checkbox
                        $.each($("#checkbox3:checked"), function() {
                            // thêm class biêtu thị đã được active
                            $(this).parent().parent().parent().addClass('active');
                            // Hiển thị button unactive
                            $('._unactive').css({
                                'display': 'inline-block',
                            });
                        });
                        Notifications('Đặt active thành công!');
                    }

                }
            });
        } else if (numChecked > 3) {
            Swal.fire({
                title: 'Kích hoạt được 3 cái thôi má',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                }
            });
        }
    });

    // Lắng nghe sự thay đổi của checkbox
    $(document).on('change', '#checkbox3', function() {
        // Lấy số box image đã được check : ;
        var numChecked = $('#checkbox3:checked').length;
        // Lấy khối ảnh
        var imageContainer = $(this).parent().parent().parent();
        if ($(this).is(':checked')) {
            if (!imageContainer.hasClass('active')) {
                imageContainer.css({
                    'background': '#00a65a',
                });
            } else {
                $('._unactive').css({
                    'display': 'inline-block',
                });
            }
        } else {
            if (!imageContainer.hasClass('active')) {
                imageContainer.css({
                    'background': 'transparent',
                });
            }
        }
        if (numChecked == 0) {
            $('._unactive').css({
                'display': 'none',
            });
        }

    });

    // Click vào btn unactive
    $(document).on('click', '._unactive', function() {

        var ids = [];
        // duyệt lần lượt từng checkbox
        $.each($("#checkbox3:checked"), function() {
            // Nếu checkbox nào mà đã chưa có class active biểu thị là đã được kích hoạt thì thêm id vào mảng ids
            if ($(this).parent().parent().parent().hasClass('active')) {
                ids.push($(this).attr('data-id'));
            }
        });
        console.log(ids);
        if (ids.length > 0) {
            // ajax
            $.ajax({
                type: "post",
                url: route('setUnactive'),
                data: {
                    "ids": ids,
                },
                dataType: "json",
                success: function(data) {
                    $.each($("#checkbox3:checked"), function() {
                        // Nếu checkbox nào mà đã chưa có class active biểu thị là đã được kích hoạt thì thêm id vào mảng ids
                        if ($(this).parent().parent().parent().hasClass('active')) {
                            $(this).parent().parent().parent().removeClass('active');
                            $(this).parent().parent().parent().css({
                                'background': 'transparent',
                            });
                            $(this).prop('checked', false);
                            $('._unactive').css({
                                'display': 'none',
                            });
                        }
                    });
                    Notifications('huỷ kích hoạt thành công!');
                }
            });
        }
    });
});

//
// Func **************************
//
function LoadDataTable() {
    return table.dataTable({
        "processing": true,
        "serverSide": true,
        "processing": true,
        "pagingType": "full_numbers",
        language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Xem _MENU_ mục",
            "sZeroRecords": "Không tìm thấy bản ghi nào phù hợp",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            }
        },
        "ajax": {
            url: route('product.getData'),
        },
        "columns": [{
                data: null
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'qty',
                name: 'qty'
            },
            {
                data: 'category_id',
                name: 'category_id'
            },
            {
                data: 'description',
                'render': function(data, type, full, meta) {
                    if (data != null) {
                        return type == 'display' && data.length > 90 ? `<p title="${data}">${data.substr( 0, 89 )}...</p>` : data;
                    } else return data;
                },
            },
            {
                data: 'keyword',
                name: 'keyword',
                'render': function(data, type, full, meta) {
                    if (data != null) {
                        return type == 'display' && data.length > 50 ? `<p title="${data}">${data.substr( 0, 49 )}...</p>` : data;
                    } else return data;
                },
            },
            {
                data: 'id',
                name: 'id',
                "render": function(data) {
                    return `<a href="javascript:void(0)" class="btn btn-social-icon btn-bitbucket btn-edit" title="Sửa"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" product-id="${data}" class="btn btn-social-icon btn-bitbucket btn-delete" style="background: #e66969;" title="Xoá"><i class="fas fa-trash-alt"></i></a>
                    <a href="update-image/${data}" class="btn btn-social-icon image-update" title="Cập nhật hình ảnh"> <i class="fas fa-images" style="color: #fff;"></i></a>
                    `;
                }


            }
        ],
        'columnDefs': [{
            'targets': 0,
            'render': function(data, type, row, meta) {
                if (type === 'display') {
                    data = '<div class="checkbox checkbox-success"><input type="checkbox" class="dt-checkboxes styled "><label></label></div>';
                }

                return data;
            },
            'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class="checkbox checkbox-success"><input type="checkbox" class="dt-checkboxes styled"><label></label></div>',
            }
        }],
        'select': {
            'style': 'os',
            'selector': 'td:first-child,td:nth-child(4),td:nth-child(2),td:nth-child(3),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8)',
        },
        'order': [1, 'desc'],
        // asc
        initComplete: function() {
            table.css({
                'width': '100%'
            });
            this.api().columns().every(function() {
                var column = this;
                var input = document.createElement("input");
                $(input).attr('class', 'filter');
                $(input).attr('style', 'width: 100%');
                $(input).appendTo($(column.footer()).empty())
                    .on('keyup change', function() {
                        column
                            .search($(this).val(), false, false, true)
                            .draw();
                    });
            });
            $('#data_table > tfoot > tr > th:nth-child(1) > input').hide();
        },
    });

}
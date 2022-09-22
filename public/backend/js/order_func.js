var table = $('#data_table');
$(document).ready(function() {
    //
    // Chấp nhận
    //
    $(document).on('click', '.btn-accept', function() {
        // lấy id order
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: route('acceptOrder'),
            data: {
                "id": id,
            },
            dataType: "json",
            success: function(data) {
                var rs = data.status;
                if (rs == 'notFound') {
                    Swal.fire({
                        "title": 'Không tìm thấy sản phẩm này trong hệ thống',
                        "animation": false,
                        "type": 'info',
                        "customClass": {
                            "popup": 'animated tada',
                        }
                    });
                } else if (rs == 'qty') {
                    Swal.fire({
                        "title": 'Không đủ số lượng sản phẩm cho đơn hàng, nên đã huỷ đơn hàng!',
                        "animation": false,
                        "type": 'info',
                        "customClass": {
                            "popup": 'animated tada',
                        }
                    });
                } else {
                    Notifications('Tiếp nhận đơn hàng thành công!');
                }
                // Reload lại bảng
                ReloadTable(table);
            }
        });
    });
    //
    // Từ chối
    //
    $(document).on('click', '.btn-denied', function() {
        // lấy id order
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Nhắc nhẹ ?',
            text: "Bạn có muốn từ chối đơn hàng này?!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok!',
            cancelButtonText: 'Không, mình ăn nhầm',
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: 'Hãy nhập vào lý do từ chối',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Chấp nhận',
                    showLoaderOnConfirm: true,
                    preConfirm: (msg) => {
                        $.ajax({
                            type: "post",
                            url: route('deniedOrder'),
                            data: {
                                "id": id,
                                "msg": msg,
                            },
                            dataType: "json",
                            success: function(data) {
                                try {
                                    if (data.errors) {
                                        throw new Error(data.errors.msg);
                                    } else if (data.status == 'notFound') {
                                        Swal.fire({
                                            "title": `Không tìm thấy đơn hàng này`,
                                            "type": 'error',
                                            "animation": false,
                                            "customClass": {
                                                popup: 'animated tada',
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            title: `Đã từ chối đơn hàng!`,
                                            type: 'success',
                                        });
                                        ReloadTable(table);
                                    }
                                } catch (error) {
                                    Swal.fire({
                                        "title": error.message,
                                        "type": 'error',
                                        "animation": false,
                                        "customClass": {
                                            popup: 'animated tada',
                                        }
                                    });
                                }
                            }
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                });
            }
        })
    });
    //
    // Slide down modal khi có lỗi trả về
    $('.modal-dialog').slideToggle();
    // Đóng bảng lỗi
    $(document).on('click', '#closeModal, #x', function() {
        $('#modal-default').slideToggle();
    });

    // Edit status
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "get",
            url: route('ajaxDeleteAOrderStatus'),
            data: {
                'id': id,
            },
            dataType: "json",
            success: function(data) {
                if (data.status == 'notFound' || data.status == 'failed') {
                    Swal.fire({
                        title: data.status == 'notFound' ? `Opps, bạn chỉnh sửa linh tinh phải hong?` : 'Opps, có lỗi gì ý, thử lại sau nhe',
                        type: 'error',
                        animation: false,
                        customClass: {
                            popup: `animated tada`,
                        }
                    });
                } else {
                    ReloadTable(table);
                    Notifications('Thành công rùi!');
                }
            }
        });
    });
});
// Load dataTable
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
            url: route('order.getData'),
        },
        "columns": [{
                data: null
            },
            {
                data: 'order_code',
                name: 'order_code'
            },
            {
                data: 'customerName',
                name: 'customerName'
            },
            {
                data: 'customerEmail',
                name: 'customerEmail'
            },
            {
                data: 'customerPhone',
                name: 'customerPhone'
            },
            {
                data: 'customerAddress',
                name: 'customerAddress',
            },
            {
                "data": 'status',
                "name": 'status',
            },
            {
                "data": 'status',
                "name": 'status',
                "render": function(data, type, full, meta) {
                    if (data != null) {
                        if (parseInt(data) == 0) {
                            return `<a data-id="${full.id}" href="javascript:void(0)" class="btn btn-social-icon btn-bitbucket btn-accept" title="Chấp nhận" style="background: #059407;"><i class="fas fa-check"></i></a>
                                    <a data-id="${full.id}" href="javascript:void(0)" class="btn btn-social-icon btn-bitbucket btn-denied" style="background: #c44444;" title="Từ chối"><i class="fas fa-times"></i></a>
                                    `;
                        } else if (parseInt(data) == -1 || parseInt(data) == 4 || parseInt(data) == 5) {
                            return null;
                        } else {
                            return `<a href="/admin/update-order/${full.id}" class="btn btn-social-icon btn-bitbucket btn-status" title="Cập nhật tình trạng đơn hàng" style="background: #e78d40;"><i class="fas fa-comment-dots"></i></a>`;
                        }
                    }
                    return null;
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
            },
            {
                'targets': 6,
                'render': function(data, type, full, meta) {
                    if (data != null) {
                        if (type == 'display') {
                            return parseInt(data) == 0 ? data = `<p title="${data}" class="text-primary text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #3c8dbc;"></i> &nbsp;Đang chờ</p>` :
                                parseInt(data) == 1 ? data = `<p title="${data}" class="text-success text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #3c763d;"></i> &nbsp; Đã tiếp nhận</p>` :
                                parseInt(data) == 2 ? data = `<p title="${data}" class="text-success text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #3c763d;"></i> &nbsp; Đang giao</p>` :
                                parseInt(data) == 3 ? data = `<p title="${data}" class="text-success text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #3c763d;"></i> &nbsp; Đã giao</p>` :
                                parseInt(data) == 4 ? data = `<p title="${data}" class="text-warning text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #8a6d3b;"></i> &nbsp; Hoàn trả</p>` :
                                parseInt(data) == 5 ? data = `<p title="${data}" class="text-danger text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #a94442;"></i> &nbsp; Từ chối tiếp nhận</p>` :
                                data = `<p title="${data}" class="text-danger text-bold"><i class="fas fa-circle" style="box-shadow: 0px 0px 5px 0px #a94442;"></i> &nbsp; Đã huỷ</p>`;
                        }

                    }
                    return data;
                },
            }
        ],
        'select': {
            'style': 'os',
            'selector': 'td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7)',
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
// thông tin trạng thái đơn hàng
function LoadOrderStatusesDataTable() {
    var id = table.attr('data-id');
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
            type: 'get',
            url: route('getOrderStatuses'),
            data: {
                'id': id,
            }
        },
        "columns": [{
                data: null
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                "data": 'id',
                "name": 'id',
                "render": function(data, type, full, meta) {
                    return `<a href="javascript:void(0);" data-id="${data}" class="btn btn-social-icon btn-bitbucket btn-delete" style="background: #e66969;" title="Xoá"><i class="fas fa-trash-alt"></i></a>
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
        }, ],
        'select': {
            'style': 'os',
            'selector': 'td:first-child,td:nth-child(2),td:nth-child(3)',
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
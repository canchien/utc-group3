$(document).ready(function() {
    // Load list category
    //loadList();
    DataTableLoad();
    // hiển thị loading
    $('#category_data').on('processing.dt', function(e, settings, processing) {
        if (processing) {
            $(this).next().html(`<div class='loading'><div class='lds-ripple'><div></div><div></div></div><p>Đang xử lý ...</p></div>`);
        } else {
            $(this).next().html('');
        }
    });

    $('#buttonPaginationListUsers').click(function() {
        console.log('hi');
        var inputPage = parseInt($('#inputPaginationListUsers').val());
        var category_data = $('#category_data').DataTable();
        var totalPages = category_data.page.info().pages;
        //console.log(totalPages);

        if (!inputPage) {
            Swal.fire({
                type: 'error',
                title: 'Ẹcc...',
                text: 'Hãy nhập vào 1 số!',
            });
            category_data.off();
        } else if (inputPage > totalPages) {
            Swal.fire({
                type: 'error',
                title: 'Ẹcc...',
                text: 'Số trang không hợp lệ!',
            });
        } else {
            category_data.page(inputPage - 1).draw(false);
        }
    });
    //loadList();

    // todo : event click add
    $(document).on('click', '._create', function() {
        //alert("Ok");
        $('._them-form').css({
            'display': 'block',
        });
    });

});

$(document).ready(function() {
    // Listening onchange value input
    // var mutationObserver = new MutationObserver(function (mutations) {
    //     mutations.forEach(function (mutation) {
    //         console.log(mutation);
    //         if ($('#categoryName').hasClass('error') || $('#category_keyword').hasClass('error')) {
    //             $('._btn_insert').addClass('disabled').attr('onclick', '');
    //             mutationObserver.disconnect();
    //         } else {
    //             //$('._btn_insert').removeClass('disabled').attr('onclick', '_create();');
    //             //mutationObserver.observe();
    //         }
    //     });
    // });

    // mutationObserver.observe(document.documentElement, {
    //     subtree: true,
    //     attributeOldValue: true,
    //     characterDataOldValue: true
    // });
});
// Load tb
function DataTableLoad() {
    return $('#category_data').DataTable({
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
            url: route('category.getData'),
        },
        "columns": [{
                data: null
            },
            {
                data: 'id',
                name: 'categories.id'
            },
            {
                data: 'name',
                name: 'categories.name'
            },
            {
                data: 'description',
                name: 'categories.description'
            },
            {
                data: 'keyword',
                name: 'categories.keyword'
            },
            {
                data: 'id',
                name: 'categories.id',
                "render": function(data) {
                    return `<a href="javascript:void(0)" class="btn btn-social-icon btn-bitbucket btn-edit"><i class="fa fa-edit"></i></a> <a href="javascript:void(0)" category-id="${data}" class="btn btn-social-icon btn-bitbucket btn-delete" style="background: #e66969;"><i class="fas fa-trash-alt"></i></a>`
                }
            }
        ],
        'columnDefs': [{
            'targets': 0,
            'render': function(data, type, row, meta) {
                if (type === 'display') {
                    data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
            },
            'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>',
            }
        }],
        'select': {
            'style': 'os',
            'selector': 'td:first-child,td:nth-child(4),td:nth-child(2),td:nth-child(3),td:nth-child(5)',
        },
        'order': [1, 'desc'],
        // asc
        initComplete: function() {
            $('#category_data').css({
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
            $('#category_data > tfoot > tr > th:nth-child(1) > input').hide();
        },
    });
}

function loadList() {
    return $.ajax({
        type: 'GET',
        url: "/admin/category/list/ajax",
        data: {},
        success: function(response) {
            var Cats = response.CategoryPaginate;
            var htmlString = ``;
            console.log(Cats.length);
            for (var i = 0; i < Cats.length; i++) {
                htmlString += `
                    <tr>
                    <td><input type="checkbox" name="checkbox_${ Cats[i].id }" data-id="${ Cats[i].id }" title="${ Cats[i].id }"></td>
                        <td>${ Cats[i].id }</td>
                        <td>${ Cats[i].name }</td>
                        <td>${ Cats[i].description }</td>
                        <td>${ Cats[i].keyword }</td>
                        <td>
                            <a href="/admin/product/${Cats[i].id}/edit" product-id="${ Cats[i].id }" class="_edit-product">Edit</a>
                            <a href="#" product-id="${ Cats[i].id }" class="_delete-product">Xoá</a>
                        </td>
                    </tr>
                `;
            }
            $('tbody').html(htmlString);
        },
    });
}

function them() {
    return $.ajax({
        type: "post",
        url: "url",
        data: "data",
        dataType: "dataType",
        success: function(response) {

        }
    });
}


// Insert
function _execute() {
    var categoryName = $('#categoryName');
    var category_description = $('#category-description');
    var category_keyword = $('#category_keyword');
    var data = $('#_create-form').serialize();
    // console.log('categoryName : ' + categoryName.val());
    // console.log('category_description : ' + category_description.val());
    // console.log('category_keyword : ' + category_keyword.val());
    $.ajax({
        type: "post",
        url: route('category.store'),
        data: data,
        dataType: "json",
        success: function(data) {
            categoryName.val('');
            category_description.val('Không có mô tả');
            category_keyword.val('');
            $('#categoryName').removeClass('valid').css({ 'border-color': '#d2d6de' });
            $('#category_keyword').removeClass('valid').css({ 'border-color': '#d2d6de' });
            ReloadTable('#category_data');
            $('._form_title').text('Thêm mới danh mục');
            $('._btn_execute').text('Thêm');
            $('#button_action').val('insert');
            $('#edit_category_id').val('');
            Notifications(data.status);
        },
        error: function(data) {
            // var errorString = ``;
            // var er = data.responseJSON.errors;
            // console.log(er);
            // if(typeof(er.categoryName) != 'undefined'){
            //     for(var item = 0; item < er.categoryName.length; item++){
            //         errorString += er.categoryName[item];
            //     }
            // }
            // if(typeof(er.category_keyword) != 'undefined'){
            //     for(var item = 0; item < er.category_keyword.length; item++){
            //         errorString += er.category_keyword[item];
            //     }
            // }

            ErrorNotifications('Ẹccc...', 'Có lỗi ! Vui lòng kiểm tra lại !');
        }
    });
    //console.log(categoryName);
}
// Edit
$(document).on('click', '.btn-edit', function() {
    // var category_keyword = $(this).parent().prev().text();
    // var category_description = $(this).parent().prev().prev().text();
    // var category_name = $(this).parent().prev().prev().prev().text();
    var category_id = $(this).parent().prev().prev().prev().prev().text();
    // console.log(category_keyword);
    // console.log(category_description);
    // console.log(category_name);
    console.log(category_id);
    $.ajax({
        type: "GET",
        url: route('category.fetchData'),
        data: { "id": category_id },
        dataType: "json",
        success: function(data) {
            $('#edit_category_id').val(data.id);
            $('#categoryName').val(data.name);
            $('#category-description').val(data.description);
            $('#category_keyword').val(data.keyword);
            $('._them-form').css({
                'display': 'block',
            });
            $('._form_title').text('Cập nhật danh mục');
            $('._btn_execute').text('Cập nhật');
            $('#button_action').val('update');
        },
        error: function(data) {
            var er = data.responseJSON;
            ErrorNotifications('Ẹccc...', 'Phát sinh lỗi ! F12 để biết thêm chi tiết ! (Xem lại Route)');
            console.log(er);
        }
    });

});
// Delete a record
$(document).on('click', '.btn-delete', function() {
    var CategoryId = $(this).attr('category-id');
    var myTable = $('#category_data').DataTable();

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
            $(this).parent().parent().remove();
            $.ajax({
                type: "POST",
                url: route('category.destroyA'),
                data: {
                    "id": CategoryId
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    ReloadTable('#category_data');
                    Notifications("Đã xoá thành công 1 bản ghi");
                },
            });
        }
    });
});
// MultiDelete Record
$(document).on('click', '._delete', function() {
    var myTable = $('#category_data').DataTable();
    var row_selected = myTable.rows({
        selected: true
    }).data().toArray();
    var Ids = [];

    // for (var i = 0; i < row_selected.length; i++) {
    //     row_selected[i] = row_selected[i].slice(1, row_selected[i].length);
    //     Ids.push(row_selected[i].slice(0, row_selected[i].length - 1));
    // }
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
                    url: route('category.multiDestroy'),
                    data: {
                        id: Ids
                    },
                    success: function(response) {
                        // Load lại bảng
                        ReloadTable('#category_data');
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
        })
    }


    //alert('a');
    // var myTable = $('#category_data').DataTable();
    // var rowsel =  myTable.$(".dt-checkboxes:checked", {"page": "all"});
    // var Ids = [];
    // rowcollection.each(function(index,elem){
    //     var checkbox_value = $(elem).val();
    //     //Do something with 'checkbox_value'
    // });
    // Ids.push(rowsel.parent().next().text());
    // //var rowsel = myTable.column(0).checkboxes.checked;
    // console.log(Ids);
    //console.log(rowsel.parent().next().text());
});


// Form validation
$(document).ready(function() {
    $.validate({
        form: '#_create-form'
    });

    $('#category-description').restrictLength($('#des-max-length'));

    $('#category_keyword').restrictLength($('#keyword-max-length'));
});
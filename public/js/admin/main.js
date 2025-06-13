// Admin
// function store
function store($routeStore, $routeIndex) {
    $("#btn-store").click(function (e) {
        e.preventDefault();
        let form = $(this).parents("form");
        let form_data = new FormData(form[0]);

        $.ajax({
            url: $routeStore,
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
            success: function () {
                window.location.href = $routeIndex;
                toast("Thêm thành công", "success");
            },
            error: function (data) {
                $(".text-danger").text("");
                if (data.responseJSON && data.responseJSON.errors) {
                    let errors = data.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $(`.error-${field}`).text(errors[field][0]);
                        }
                    }
                }
            },
        });
    });
}

function update($routeUpdate, $routeIndex) {
    $("#btn-update").click(function (e) {
        e.preventDefault();
        let form = $(this).parents("form");
        let form_data = new FormData(form[0]);

        $.ajax({
            url: $routeUpdate,
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
            success: function () {
                window.location.href = $routeIndex;
                toast("Cập nhật thành công", "success");
            },
            error: function (data) {
                $(".text-danger").text("");
                if (data.responseJSON && data.responseJSON.errors) {
                    let errors = data.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $(`.error-${field}`).text(errors[field][0]);
                        }
                    }
                }
            },
        });
    });
}
function destroy($routeDelete, $table) {
    $(document).on("click", ".destroy", function (e) {
        e.preventDefault();
        let form = $(this).parents("form");

        $.ajax({
            url: $routeDelete,
            type: "DELETE",
            dataType: "json",
            data: form.serialize(),
            success: function () {
                toast("Xóa thành công.");
                $table.draw();
            },
            error: function (data) {
                // let datas = data.responseJSON;
                // datas.messages ?
                //     toast(datas.messages, 'error') :
                //     toast(datas.errors.id, 'error');
            },
        });
    });
}
function deleteAlertValidation($inputs) {
    $inputs.on("focus", function () {
        $(".text-danger").text("");
    });
}
// format
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}

// config datatable yajra
// public/js/datatable-config.js

window.customerDatatable = function (ajaxUrl, columns) {
    return {
        processing: true,
        serverSide: true,
        ajax: {
            url: ajaxUrl,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            error: function (data) {
                console.log(data);
            },
        },
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>",
            },
            processing: "Đang xử lý...",
            search: "Tìm Kiếm:",
            searchPlaceholder: "Từ khoá...",
            info: "Hiển thị từ _START_ đến _END_ trên _TOTAL_",
            lengthMenu:
                'Hiện <select class=\'form-select form-select-sm ms-1 me-1\'><option value="50">50</option><option value="100">100</option><option value="200">200</option><option value="-1">Tất cả</option></select>',
        },
        pageLength: 20,
        columns: columns,
        drawCallback: () => {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
            $("#products-datatable_length label").addClass("form-label");
            document
                .querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function (e) {
                    e.classList.add("col-sm-6");
                    e.classList.remove("col-sm-12", "col-md-6");
                });
        },
        rowCallback: function (row, data, index) {
            $("td:eq(0)", row).html(index + 1 + this.api().page.info().start);
        },
    };
};

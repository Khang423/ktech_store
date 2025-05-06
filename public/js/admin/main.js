// Admin
// function store
function store($routeStore,$routeIndex){
    $('#btn-store').click(function (e) {
        e.preventDefault();
        let form = $(this).parents('form');
        let form_data = new FormData(form[0]);

        $.ajax({
            url: $routeStore,
            type: 'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: form_data,
            success: function () {
                window.location.href = $routeIndex;
                toast('Thêm thành công','success');
            },
            error: function (data) {
                $('.text-danger').text('');
                if (data.responseJSON && data.responseJSON.errors) {
                    let errors = data.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $(`.error-${field}`).text(errors[field][0]);
                        }
                    }
                }
            }
        });
    });
}

function update($routeUpdate,$routeIndex){
    $('#btn-update').click(function (e) {
        e.preventDefault();
        let form = $(this).parents('form');
        let form_data = new FormData(form[0]);

        $.ajax({
            url: $routeUpdate,
            type: 'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: form_data,
            success: function () {
                window.location.href = $routeIndex;
                toast('Cập nhật thành công','success');
            },
            error: function (data) {
                $('.text-danger').text('');
                if (data.responseJSON && data.responseJSON.errors) {
                    let errors = data.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $(`.error-${field}`).text(errors[field][0]);
                        }
                    }
                }
            }
        });
    });
}
function destroy ($routeDelete,$table){
    $(document).on('click', '.destroy', function (e) {
        e.preventDefault();
        let form = $(this).parents('form');

        $.ajax({
            url: $routeDelete,
            type: 'DELETE',
            dataType: 'json',
            data: form.serialize(),
            success: function () {
                toast('Xóa thành công.');
                $table.draw();
            },
            error: function (data) {
                let datas = data.responseJSON;
                datas.messages ?
                    toast(datas.messages, 'error') :
                    toast(datas.errors.id, 'error');
            }
        });
    });
}
function deleteAlertValidation($inputs){
    $inputs.on('focus', function () {
        $('.text-danger').text('');
    });
}
// format
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

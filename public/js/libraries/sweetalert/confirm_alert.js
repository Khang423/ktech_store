function alert(
    callback,
    parentTitle,
    parentMessage,
    confirmText,
    cancelText,
    title,
    message
) {
    Swal.fire({
        title: parentTitle || "Bạn có chắc chắn?",
        text: parentMessage || "Bạn sẽ không thể giữ lại nó!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmText || "Có, khôi phục nó!",
        cancelButtonText: cancelText || "Hủy bỏ"
    }).then((result) => {
        if (result.isConfirmed) {
            if (typeof callback === 'function') {
                callback(function(success) {
                    if (success) {
                        Swal.fire({
                            title: title || "Đã khôi phục!",
                            text: message || "Khôi phục thành công.",
                            icon: "success"
                        });
                    }
                });
            }
        }
    });
}

// setup function sweetalert2

/*
|--------------------------------------------------------------------------START
B1: import libraries
<script src="{{ asset('js/libraries/sweetalert/sweetalert2.js') }}"></script>
<script src="{{ asset('js/libraries/sweetalert/confirm_alert.js') }}"></script>

|--------------------------------------------------------------------------

B2: install
|--------------------------------------------------------------------------
    sweetalert2(
        () => {
            console.log('setup success');
        }
    );
|--------------------------------------------------------------------------END
*/

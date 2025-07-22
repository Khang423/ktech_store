// ==== Xoá ảnh cũ ====
// $(".destroy-image").on("click", function () {
//     const button = $(this).parent();
//     const errorImage = $(this).data("id");

//     const image = $(this).siblings('input[name^="image_old["]').val();
//     const productId = $(this).siblings('input[name^="product_id["]').val();
//     const imageId = $(this).siblings('input[name^="product_image_id["]').val();

//     $.ajax({
//         url: routedestroy,
//         type: "POST",
//         dataType: "json",
//         data: {
//             id: imageId,
//             product_id: productId,
//             image: image,
//             _token: $('meta[name="csrf-token"]').attr("content"),
//         },
//         success: function () {
//             button.remove();
//         },
//         error: function (data) {
//             $.each(data.responseJSON.errors, (key, value) => {
//                 $(`#error-img${errorImage}`).text(value);
//             });
//         },
//     });
// });
// ==== Trigger input khi click ảnh ====
$(".thumbnail").on("click", () => $("#img_thumbnail").click());
$(".dz-message-image").on("click", () => $("#imgInput").click());

// ==== Khi chọn ảnh thumbnail ====
$("#img_thumbnail").on("change", () =>
    handleImagePreview("#img_thumbnail", "#preview-thumbnail")
);

// ==== Khi chọn ảnh thường ====
$("#imgInput").on("change", () =>
    handleImagePreview("#imgInput", "#preview-image", "me-3")
);

$("#category_product_id").change((e) => {
    let categoryid = $(e.target).val();

    $.ajax({
        url: routeGetDataCategoryDetail,
        type: "POST",
        dataType: "json",
        data: {
            category_product_id: categoryid,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            const data = response.data;
            const category_product_detail = $("#category_product_detail_id");
            category_product_detail.empty();
            data.forEach((item) => {
                category_product_detail.append(
                    `<option value="${item.id}">${item.name}</option>`
                );
            });
            category_product_detail.trigger("change");
        },
        error: function (data) {
            console.log(data);
        },
    });
});

const getNumber = (selector) =>
    parseFloat($(selector).val().replace(/\D/g, "") || 0);
const formatVND = (number) => number.toLocaleString("vi-VN") + " đ";

$("#profit_rate").on("input", (e) => {
    const $input = $(e.target);
    const rawValue = $input.val();
    let profitRate = parseFloat(rawValue);

    const $error = $(".error-profit_rate");
    const importPrice = getNumber("#import_price");
    if (!importPrice) return;

    let message = "";

    // Nếu không phải số thì hiển thị lỗi đơn giản
    if (isNaN(profitRate)) {
        message = "Vui lòng nhập lợi nhận";
    }
    // Kiểm tra ngoài khoảng cho phép
    else if (profitRate < -99) {
        profitRate = -99;
        message = "Lợi nhuận âm tối thiểu là -99%";
    } else if (profitRate > 100) {
        profitRate = 100;
        message = "Lợi nhuận tối đa là 100%";
    }
    // Nếu trong khoảng và âm => hiển thị tiền lỗ
    else if (profitRate < 0) {
        const lossAmount = (importPrice * Math.abs(profitRate)) / 100;
        message = `Bạn đang lỗ ${formatVND(lossAmount)}`;
    }

    // Hiển thị hoặc ẩn cảnh báo
    if (message) {
        $error.text(message).show();
    } else {
        $error.text("").hide();
    }

    // Nếu giá trị hợp lệ, tính final price
    if (!isNaN(profitRate) && profitRate >= -99 && profitRate <= 100) {
        const finalPrice = importPrice * (1 + profitRate / 100);
        $("#final_price").val(formatVND(finalPrice));
    } else {
        // Nếu vượt giới hạn, không cập nhật final_price
        $("#final_price").val("");
    }
});


// ==== Tính lợi nhuận từ giá bán ====
$("#final_price").on("input", () => {
    const finalPrice = getNumber("#final_price");
    const importPrice = getNumber("#import_price");
    if (!importPrice) return;

    const profitRate = ((finalPrice - importPrice) / importPrice) * 100;
    $("#profit_rate").val(Math.round(profitRate));
});

const handleImagePreview = (inputSelector, previewSelector, imgClass = "") => {
    const preview = $(previewSelector);
    preview.empty();

    Array.from($(inputSelector)[0].files).forEach((file) => {
        const src = URL.createObjectURL(file);
        const img = $(
            `<img class='img-fluid img-thumbnail ${imgClass}' width='170' height='auto'>`
        ).attr("src", src);
        img.on("load", () => URL.revokeObjectURL(src));

        const sizeText = $(
            `<div class='text-center text-dark'>${formatBytes(file.size)}</div>`
        );
        const wrapper = $(
            "<div class='d-inline-block text-center'></div>"
        ).append(img, sizeText);

        preview.append(wrapper);
    });
};

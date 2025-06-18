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

// ==== Xoá ảnh cũ ====
$(".destroy-image").on("click", function () {
    const button = $(this).parent();
    const errorImage = $(this).data("id");

    const image = $(this).siblings('input[name^="image_old["]').val();
    const productId = $(this).siblings('input[name^="product_id["]').val();
    const imageId = $(this).siblings('input[name^="product_image_id["]').val();

    $.ajax({
        url: routedestroy,
        type: "POST",
        dataType: "json",
        data: {
            id: imageId,
            product_id: productId,
            image: image,
            _token: "{{ csrf_token() }}",
        },
        success: function () {
            button.remove();
        },
        error: function (data) {
            $.each(data.responseJSON.errors, (key, value) => {
                $(`#error-img${errorImage}`).text(value);
            });
        },
    });
});

// ==== Tiện ích xử lý số ====
const getNumber = (selector) =>
    parseFloat($(selector).val().replace(/\D/g, "") || 0);
const formatVND = (number) => number.toLocaleString("vi-VN") + " đ";

// ==== Tính giá bán từ lợi nhuận ====
$("#profit_rate").on("input", (e) => {
    let profitRate = parseFloat($(e.target).val().replace(/\D/g, "") || 0);
    if (profitRate < 0) profitRate = 0;

    const importPrice = getNumber("#import_price");
    if (!importPrice) return;

    const finalPrice = importPrice * (1 + profitRate / 100);
    $("#final_price").val(formatVND(finalPrice));
});

// ==== Tính lợi nhuận từ giá bán ====
$("#final_price").on("input", () => {
    const finalPrice = getNumber("#final_price");
    const importPrice = getNumber("#import_price");
    if (!importPrice) return;

    const profitRate = ((finalPrice - importPrice) / importPrice) * 100;
    $("#profit_rate").val(Math.round(profitRate));
});

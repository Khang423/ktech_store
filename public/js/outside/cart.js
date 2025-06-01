// css resize view-price
function updatePriceWidth() {
    const parentWidth = $(".list-item-cart").outerWidth(); // hoặc .width() nếu không tính padding
    $(".view-price").css("width", parentWidth + "px");
}
updatePriceWidth();
$(window).on("resize", updatePriceWidth);

// Định dạng giá tiền sang VND
function formatPriceToVND(price) {
    return price.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
}

// Cập nhật tổng tiền tạm tính
function updateTemporaryPrice() {
    let total = 0;
    let q = 0;
    $(".product-check:checked").each(function () {
        const price = parseInt($(this).data("price")) || 0;
        const quantity =
            parseInt(
                $(this).closest(".item").find(".quantity").text().trim()
            ) || 1;
        total += price * quantity;
        q = quantity;
    });

    $(".temporary-price").text("Tạm tính: " + formatPriceToVND(total));
}

// Cập nhật số lượng sản phẩm đã chọn
function updateSelectCheckBox() {
    let count = $(".product-check:checked").length;
    $(".btn-buy").text(`Mua Ngay (${count})`);
}

// Cập nhật toàn bộ UI liên quan đến checkbox
function updateUI() {
    updateTemporaryPrice();
    updateSelectCheckBox();
}

// Khi tích vào checkbox từng sản phẩm
$(".product-check").on("change", updateUI);

// Khi tích vào "chọn tất cả"
$("#check-all-product").on("change", function () {
    const isChecked = $(this).is(":checked");
    $(".product-check").prop("checked", isChecked);
    updateUI();
});
// tăng số lượng sản phẩm
$(".quantity-increase").click(function () {
    const productId = $(this).data("productId");
    let action = "increase";
    $.ajax({
        url: RouteCartItemUpdate,
        type: "POST",
        dataType: "json",
        data: {
            productId,
            action,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            location.reload();
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            console.log(errors);
        },
    });
});
//giảm số lượng sản phẩm
$(".quantity-reduce").click(function () {
    const productId = $(this).data("productId");
    let action = "reduce";
    $.ajax({
        url: RouteCartItemUpdate,
        type: "POST",
        dataType: "json",
        data: {
            productId,
            action,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            location.reload();
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            console.log(errors);
        },
    });
});
$(".btn-delete").click(function () {
    const productId = $(this).data("productId");
    $.ajax({
        url: RouteCartItemDelete,
        type: "POST",
        dataType: "json",
        data: {
            productId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            toast("Đã xoá sản phẩm khỏi giỏ hàng", "success");
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            console.log(errors);
        },
    });
});

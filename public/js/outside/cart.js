$(document).ready(function () {
    // 1. Init UI on page load
    updatePriceWidth();
    updateUI();

    // 2. Resize event to update view-price width
    $(window).on("resize", updatePriceWidth);

    // 3. Handle individual product checkbox change
    $(".product-check").on("change", updateUI);

    // 4. Handle "select all" checkbox
    $("#check-all-product").on("change", function () {
        const isChecked = $(this).is(":checked");
        $(".product-check").prop("checked", isChecked);
        updateUI();
    });

    // 5. Handle quantity increase
    $(".quantity-increase").click(function () {
        handleQuantityChange($(this).data("productId"), "increase");
    });

    // 6. Handle quantity decrease
    $(".quantity-reduce").click(function () {
        handleQuantityChange($(this).data("productId"), "reduce");
    });

    // 7. Handle product delete from cart
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
                location.reload();
            },
            error: function (data) {
                console.log(data.responseJSON.errors);
            },
        });
    });

    // 8. Mua hàng -> chuyển trang
    $("#btn-buy").click(function () {
        let selectedProducts = [];
        $(".product-check:checked").each(function () {
            const price = parseInt($(this).data("price")) || 0;
            const quantity = parseInt($(this).data("quantity")) || 0;
            const thumbnail = $(this).data("thumbnail") || " ";
            const name = $(this).data("name") || "";
            const product_id = parseInt($(this).data("product-id"));
            const product_version_id = parseInt(
                $(this).data("product-version-id")
            );

            const product_info = {
                price: price,
                quantity: quantity,
                thumbnail: thumbnail,
                name: name,
                product_id: product_id,
                product_version_id: product_version_id,
            };
            selectedProducts.push(product_info);
        });
        sessionStorage.setItem(
            "selectedProducts",
            JSON.stringify(selectedProducts)
        );
        window.location.href = RouteOrder;
    });
});

// Update all UI when product checkboxes change
function updateUI() {
    updateTemporaryPrice();
    updateSelectCheckBox();
    updateBuyButtonState();
}

// Dynamically adjust width of price view container
function updatePriceWidth() {
    const parentWidth = $(".list-item-cart").outerWidth();
    $(".view-price").css("width", parentWidth + "px");
}

// Calculate and display total temporary price
function updateTemporaryPrice() {
    let total = 0;

    $(".product-check:checked").each(function () {
        const price = parseInt($(this).data("price")) || 0;
        const quantity =
            parseInt(
                $(this).closest(".item").find(".quantity").text().trim()
            ) || 1;

        total += price * quantity;
    });

    $(".temporary-price").text("Tạm tính: " + formatPriceToVND(total));
}

// Update count on "Buy Now" button
function updateSelectCheckBox() {
    const count = $(".product-check:checked").length;
    $("#count-buy").text(`Mua Ngay (${count})`);
}

// Enable/disable the "Buy Now" button
function updateBuyButtonState() {
    const btn = $("#btn-buy");

    if ($(".product-check:checked").length > 0) {
        btn.css({
            "pointer-events": "auto",
            opacity: "1",
            cursor: "pointer",
        });
    } else {
        btn.css({
            "pointer-events": "none",
            opacity: "0.5",
            cursor: "not-allowed",
        });
    }
}

// Handle increasing or decreasing product quantity
function handleQuantityChange(productId, action) {
    $.ajax({
        url: RouteCartItemUpdate,
        type: "POST",
        dataType: "json",
        data: {
            productId,
            action,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response.data.message);

            if (response.data.message === "out_of_stock") {
                toast("Số lượng vượt quá số lượng hiện có trong kho ", "error");
            } else if (response.data.message === "product_deleted") {
                let productId = response.data.product_id;
                toast("Sản phẩm đã bị xoá khỏi giỏ hàng ", "error");
                $('.item .quantity[data-product-id="' + productId + '"]')
                    .closest(".item")
                    .remove();
            } else if (response.data.message === "increase") {
                let productId = response.data.data.product_id;
                console.log(response);

                $('.quantity[data-product-id="' + productId + '"]').text(
                    response.data.data.quantity
                );
            } else if (response.data.message === "reduce") {
                let productId = response.data.data.product_id;
                $('.quantity[data-product-id="' + productId + '"]').text(
                    response.data.data.quantity
                );
            }
        },
        error: function (data) {
            console.log(data.responseJSON.errors);
        },
    });
}

// Format number to VND currency
function formatPriceToVND(price) {
    return price.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
}

$(document).ready(function () {
    const storedProducts =
        JSON.parse(sessionStorage.getItem("selectedProducts")) || [];

    renderSelectedProducts(storedProducts);
    updateBottomBarWidth();

    // Update bottom bar width when window resizes
    $(window).on("resize", updateBottomBarWidth);

    // Initialize Select2 plugin
    $(".select2").select2();

    // Load districts when city changes
    $(".city").change(function () {
        const cityId = $(this).val();
        if (cityId) loadDistrictsByCity(cityId);
    });

    // Load wards when district changes
    $(".district").change(function () {
        const districtId = $(this).val();
        if (districtId) loadWardsByDistrict(districtId);
    });

    // Handle order submission
    $("#btn-order-now").click(function () {
        const form = $("#form-store")[0];
        const formData = new FormData(form);

        const storedProducts =
            JSON.parse(sessionStorage.getItem("selectedProducts")) || [];
        formData.append("productSelected", JSON.stringify(storedProducts));
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        submitOrder(formData);
    });
    $('.footer-page').addClass('d-none');
});

// Render selected products from sessionStorage to the DOM
function renderSelectedProducts(products) {
    let html = "";
    let totalPrice = 0;

    products.forEach(({ product_id, name, price, quantity, thumbnail }) => {
        const thumbnailPath = `/asset/admin/products/${product_id}/${thumbnail}`;
        totalPrice += price * quantity;

        html += `
            <div class="item">
                <div class="thumbnail">
                    <img src="${thumbnailPath}" alt="${name}">
                </div>
                <div class="product-info">
                    <div class="name fw-bold">${name}</div>
                    <div class="price fw-bold">${formatPriceToVND(price)}</div>
                </div>
                <div class="product-quantity">Số lượng: ${quantity}</div>
            </div>
        `;
    });

    $(".product-list").html(html);
    $(".total-price")
        .text(formatPriceToVND(totalPrice))
        .css("color", "#25449a");
}

// Format number to Vietnamese currency
function formatPriceToVND(price) {
    return price.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
}

// Dynamically load districts by selected city
function loadDistrictsByCity(cityId) {
    const $district = $(".district").empty();
    const $ward = $(".ward").empty();

    addDefaultOption($ward, "--- Xã/Phường ---");
    addDefaultOption($district, "--- Quận/Huyện ---");

    $.ajax({
        url: RouteGetDistrict,
        type: "POST",
        dataType: "json",
        data: {
            city_id: cityId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            data.forEach((item) => {
                $district.append(new Option(item.name, item.id));
            });
        },
        error: function (xhr, status, error) {
            console.error("Lỗi khi load quận/huyện:", error);
        },
    });
}

// Dynamically load wards by selected district
function loadWardsByDistrict(districtId) {
    const $ward = $(".ward").empty();
    addDefaultOption($ward, "--- Xã/Phường ---");

    $.ajax({
        url: RouteGetWard,
        type: "POST",
        dataType: "json",
        data: {
            district_id: districtId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            data.forEach((item) => {
                $ward.append(new Option(item.name, item.id));
            });
        },
        error: function (xhr, status, error) {
            console.error("Lỗi khi load xã/phường:", error);
        },
    });
}

// Add default option to a select box
function addDefaultOption($select, text) {
    $select.append(
        $("<option>", {
            text: text,
            disabled: true,
            selected: true,
        })
    );
}

// Adjust the width of bottom bar to match its parent
function updateBottomBarWidth() {
    const parentWidth = $(".main").outerWidth();
    $(".bottom-bar").css("width", `${parentWidth}px`);
}

function submitOrder(formData) {
    $.ajax({
        url: RouteOrderStore,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function () {
            toast("Đặt hàng thành công", "success");
            window.location.href = "/cart";
        },
        error: function (data) {
            $(".text-danger").text(""); // Clear all old error texts

            const errors = data.responseJSON?.errors || {};
            Object.entries(errors).forEach(([field, messages]) => {
                $(`.error-${field}`).text(messages[0]);
            });
        },
    });
}

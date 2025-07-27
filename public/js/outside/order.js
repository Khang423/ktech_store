$(document).ready(function () {
    // Lấy dữ liệu sản phẩm từ cart
    const storedProducts =
        JSON.parse(sessionStorage.getItem("selectedProducts")) || [];

    // Hiển thị sản phẩm đã chọn ra giao diện
    renderSelectedProducts(storedProducts);

    // Cập nhật chiều rộng của thanh bottom-bar
    updateBottomBarWidth();

    // Khi thay đổi kích thước cửa sổ, cập nhật lại kích thước thanh bottom-bar và modal phương thức thanh toán
    $(window).on("resize", () => {
        updateBottomBarWidth();
        updateModalOptionMethodPaymentWidth();
    });

    // Khởi tạo toggle cho modal chọn phương thức thanh toán
    toggleModalMethod();

    // Khởi tạo plugin Select2 cho các select-box
    $(".select2").select2();

    // Khi thay đổi tỉnh/thành phố, load danh sách quận/huyện
    $(".city").change(function () {
        const cityId = $(this).val();
        if (cityId) loadDistrictsByCity(cityId);
    });

    // Khi thay đổi quận/huyện, load danh sách phường/xã
    $(".district").change(function () {
        const districtId = $(this).val();
        if (districtId) loadWardsByDistrict(districtId);
    });

    // Sự kiện click nút "Đặt hàng ngay"
    $("#btn-order-now").click(function () {
        const form = $("#form-store")[0];
        const formData = new FormData(form);

        const storedProducts =
            JSON.parse(sessionStorage.getItem("selectedProducts")) || [];

        formData.append("productSelected", JSON.stringify(storedProducts));
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        submitOrder(formData);
    });

    // Ẩn footer trong giao diện mobile nếu cần
    $(".footer-page").addClass("d-none");

    // Khởi tạo xử lý chọn phương thức thanh toán
    selectMethodPayment();
});

// Mở hoặc đóng modal chọn phương thức thanh toán
const toggleModalMethod = () => {
    $("#btn-select-method").on("click", () => {
        $(".modal-method").removeClass("d-none");
    });

    $(".btn-method-close").on("click", () => {
        $(".modal-method").addClass("d-none");
    });
};

// Hiển thị danh sách sản phẩm đã chọn từ sessionStorage ra HTML
function renderSelectedProducts(products) {
    let html = "";
    let totalPrice = 0;

    products.forEach(
        ({
            product_id,
            product_version_id,
            name,
            price,
            quantity,
            thumbnail,
        }) => {
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
        }
    );

    $(".product-list").html(html);
    $(".total-price")
        .text(formatPriceToVND(totalPrice))
        .css("color", "#25449a");
}

// Format số tiền thành đơn vị VNĐ
function formatPriceToVND(price) {
    return price.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
}

// Load danh sách quận/huyện theo tỉnh/thành
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

// Load danh sách xã/phường theo quận/huyện
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

// Thêm tuỳ chọn mặc định cho select-box
function addDefaultOption($select, text) {
    $select.append(
        $("<option>", {
            text: text,
            disabled: true,
            selected: true,
        })
    );
}

// Cập nhật chiều rộng thanh bottom-bar để phù hợp giao diện responsive
function updateBottomBarWidth() {
    const parentWidth = $(".main").outerWidth();
    $(".bottom-bar").css("width", `${parentWidth}px`);
}

// Cập nhật chiều rộng modal chọn phương thức thanh toán
const updateModalOptionMethodPaymentWidth = () => {
    const parentWidth = $(".main").outerWidth();
    $(".modal-method").css("width", `${parentWidth}px`);
};

// Gửi đơn hàng về server thông qua Ajax
function submitOrder(formData) {
    $.ajax({
        url: RouteOrderStore,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function () {
            const formObj = {};
            formData.forEach((value, key) => {
                formObj[key] = value;
            });
            // Lưu vào localStorage
            localStorage.setItem("orderData", JSON.stringify(formObj));
            // Chuyển trang
            window.location.href = "/thanks";
        },
        error: function (data) {
            $(".text-danger").text("");

            const errors = data.responseJSON?.errors || {};
            Object.entries(errors).forEach(([field, messages]) => {
                $(`.error-${field}`).text(messages[0]);
            });
        },
    });
}

// Xử lý khi người dùng chọn phương thức thanh toán (COD, chuyển khoản, momo)
const selectMethodPayment = () => {
    $(".method-payment").on("click", (e) => {
        const element = $(e.currentTarget);

        if (
            element.hasClass("cod") ||
            element.hasClass("bank_transfer") ||
            element.hasClass("momo")
        ) {
            const method_icon = element.find(".method-icon img").attr("src");
            const method_name = element.find(".method-name").text().trim();

            const selected = $(".method-payment.selected");
            selected.empty();

            if (selected.length) {
                const html = `
                    <div class="method-icon">
                        <img src="${method_icon}" alt="">
                    </div>
                    <div class="method-name">
                        ${method_name}
                    </div>
                    <div class="other-option">
                        <span>thay đổi</span><i class="uil uil-angle-right fs-2"></i>
                    </div>
                `;
                selected.html(html);
                $(".modal-method").addClass("d-none");
            }
            toggleModalMethod();
        }
    });
};

// Hàm tạm thời chưa sử dụng – có thể dành cho logic cập nhật sau này
const updateSelectedMethod = () => {};

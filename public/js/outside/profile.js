$(document).ready(function () {
    // load district data
    $("#city").change(function () {
        const cityId = $(this).val();
        if (cityId) loadDistrictsByCity(cityId);
    });
    // load ward data
    $(".district").change(function () {
        const districtId = $(this).val();
        if (districtId) loadWardsByDistrict(districtId);
    });

    $(".sidebar .item").click(function () {
        $(".header-profile").removeClass("d-none");
        $(".sidebar .item").removeClass("active");
        $(this).addClass("active");

        if ($(this).hasClass("btn-purchase-history")) {
            $(".purchase-history").removeClass("d-none");
            // $(".header-profile").addClass("d-none");
        } else {
            $(".purchase-history").addClass("d-none");
        }

        if ($(this).hasClass("btn-account-info")) {
            $(".account-info").removeClass("d-none");
            // $(".header-profile").addClass("d-none");
        } else {
            $(".account-info").addClass("d-none");
        }
    });
    // add class active for item
    $(".order-status .item").click(function () {
        $(".order-status .item").removeClass("active");
        $(this).addClass("active");

        if ($(this).hasClass("pending")) {
            const status = "pending";
            getDataOrderByStatus(status);
        } else if ($(this).hasClass("processing")) {
            const status = "processing";
            getDataOrderByStatus(status);
        } else if ($(this).hasClass("shiped")) {
            const status = "shiped";
            getDataOrderByStatus(status);
        } else if ($(this).hasClass("delivered")) {
            const status = "delivered";
            getDataOrderByStatus(status);
        } else if ($(this).hasClass("cancel")) {
            const status = "cancel";
            getDataOrderByStatus(status);
        } else if ($(this).hasClass("all")) {
            const status = "all";
            getDataOrderByStatus(status);
        }
    });
    // open modal add address
    $(".btn-add-address").click(function () {
        openModal();
    });
    // close modal add address
    $("#btn-close-modal-add-address").click(function () {
        closeModal();
    });

    $(".btn-info-update").click(function () {
        const form = $("#form-info")[0];
        const formData = new FormData(form);
        InfoUpdate(formData);
    });

    $("#btn-address-update").click(function () {
        const form = $("#form-address")[0];
        const formData = new FormData(form);
        AddressUpdate(formData);
    });

    $(".btn-delete").click(function () {
        const address_id = $(this).data("id");
        deleteAddress(address_id);
    });
    checkUrlProfile();
    $(window).resize(function () {
        checkUrlProfile();
    });

    $(".btn-logout").on("click", () => {
        window.location.href = RouteLogout;
    });

    $(".modal-logout-close").on("click", () => {
        $(".modal-logout").addClass("d-none");
    });
    $(".btn-action-logout").on("click", () => {
        $(".modal-logout").removeClass("d-none");
    });

    //  address
    $(".select2").select2();

    // Khi thay đổi tỉnh/thành phố, load danh sách quận/huyện
    $(".city").change(function () {
        const cityId = $(this).val();
        if (cityId !== null && cityId !== "") {
            loadDistrictsByCity(cityId);
        }
    });

    // Khi thay đổi quận/huyện, load danh sách phường/xã
    $(".district").change(function () {
        const districtId = $(this).val();
        if (districtId !== null && districtId !== "") {
            loadWardsByDistrict(districtId);
        }
    });
});

const checkUrlProfile = () => {
    if (
        window.location.href.includes(RouteProfile) &&
        window.innerWidth <= 768
    ) {
        $(".footer-page").hide();
    } else {
        $(".footer-page").show(); // nên có thêm để hiển thị lại nếu không khớp
    }
};

function deleteAddress(id) {
    $.ajax({
        url: RouteDeleteAddress,
        type: "POST",
        dataType: "json",
        data: {
            id,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            $(`.item[data-id="${address_id}"]`).remove();
            toast("Xoá địa chỉ thành công", "success");
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

function openModal() {
    $(".modal-add-address").removeClass("d-none");
    $(".modal-add-address .modal-content").animate({ right: "0px" }, 200);
}
function closeModal() {
    $(".modal-add-address .modal-content").animate({ right: "-35vw" }, 200);
    $(".modal-add-address").addClass("d-none");
}
function loadDistrictsByCity(cityId) {
    const $district = $(".district").empty();
    const $ward = $(".ward").empty();

    addDefaultOption($ward, "Chọn Xã/Phường");
    addDefaultOption($district, "Chọn Quận/Huyện");

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
    addDefaultOption($ward, "Chọn Xã/Phường");

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

function addDefaultOption($select, text) {
    $select.append(
        $("<option>", {
            text: text,
            disabled: true,
            selected: true,
        })
    );
}

function submitOrder(formData) {
    $.ajax({
        url: RouteAddAddress,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function () {
            toast("Thêm địa chỉ thành công", "success");
            closeModal();
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

const getDataOrderByStatus = (status) => {
    $.ajax({
        url: RouteGetDataOrderByStatus,
        type: "POST",
        dataType: "json",
        data: {
            status: status,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response);

            const preview = $(".purchase-history").find(".view");
            preview.empty();
            const statusBadgeMap = {
                1: '<span class="text-info badge bg-light font-15">Chờ xác nhận</span>',
                2: '<span class="text-success badge bg-light font-15">Đang xử lý</span>',
                3: '<span class="text-primary badge bg-light font-15">Đang giao</span>',
                4: '<span class="text-success badge bg-light font-15">Đã giao</span>',
                5: '<span class="text-danger badge bg-light font-15">Đã huỷ</span>',
            };
            response.data.forEach(function (order) {
                const order_code = order.order_code;
                const order_date = order.created_at;
                const product_id =
                    order.order_item[0].product_versions.product_id;
                const thumbnail =
                    order.order_item[0].product_versions.products.thumbnail;
                const config_name =
                    order.order_item[0].product_versions.config_name;
                const total_price = order.total_price;
                const product_price = order.order_item[0].unit_price;
                const order_status = order.status;
                const image_url = `/asset/admin/products/${product_id}/${thumbnail}`;
                const statusBadge =
                    statusBadgeMap[order_status] ||
                    '<span class="text-secondary badge bg-light font-15">Không xác định</span>';

                const html = `
                            <div class="item mb-2">
                                <div class="item-header">
                                    <div class="left">
                                        <div class="id-order">
                                            Đơn hàng : ${order_code}
                                        </div>
                                        <div class="order-date">
                                            Ngày đặt hàng : ${order_date}
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="order-status cancel">
                                            ${statusBadge}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-content mt-1">
                                    <div class="left">
                                        <div class="thumbnail">
                                            <img src="${image_url}"
                                                alt="">
                                        </div>
                                        <div class="product-info">
                                            <div class="name">
                                                ${config_name}
                                            </div>
                                            <div class="price">
                                                ${formatPriceToVND(
                                                    product_price
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="order-total">
                                            Tổng thanh toán : <span
                                                style="font-size: 16px;font-weight: 600;color: #25449a">${formatPriceToVND(
                                                    total_price
                                                )}</span>
                                        </div>
                                        <div class="order-detail">
                                            Xem chi tiết >
                                        </div>
                                    </div>
                                </div>
                            </div>
                `;

                preview.append(html);
            });
        },
        error: function (data) {
            $(".text-danger").text("");
            const errors = data.responseJSON?.errors || {};
            Object.entries(errors).forEach(([field, messages]) => {
                $(`.error-${field}`).text(messages[0]);
            });
        },
    });
};

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

const AddressUpdate = (formData) => {
    $.ajax({
        url: RouteAddressUpdate,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function () {
            toast("Cập nhật thành công", "success");
            location.reload();
        },
        error: function (data) {
            $(".text-danger").text(""); // Clear all old error texts

            const errors = data.responseJSON?.errors || {};
            Object.entries(errors).forEach(([field, messages]) => {
                $(`.error-${field}`).text(messages[0]);
            });
        },
    });
};
const InfoUpdate = (formData) => {
    $.ajax({
        url: RouteInfoUpdate,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function () {
            toast("Cập nhật thành công", "success");
            location.reload();
        },
        error: function (data) {
            $(".text-danger").text(""); // Clear all old error texts

            const errors = data.responseJSON?.errors || {};
            Object.entries(errors).forEach(([field, messages]) => {
                $(`.error-${field}`).text(messages[0]);
            });
        },
    });
};

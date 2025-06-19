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
            $(".header-profile").addClass("d-none");
        } else {
            $(".purchase-history").addClass("d-none");
        }

        if ($(this).hasClass("btn-account-info")) {
            $(".account-info").removeClass("d-none");
        } else {
            $(".account-info").addClass("d-none");
        }
    });
    // add class active for item
    $(".order-status .item").click(function () {
        $(".order-status .item").removeClass("active");
        $(this).addClass("active");
    });
    // open modal add address
    $(".btn-add-address").click(function () {
        openModal();
    });
    // close modal add address
    $("#btn-close-modal-add-address").click(function () {
        closeModal();
    });

    $("#btn-add-address").click(function () {
        const form = $("#form-store")[0];
        const formData = new FormData(form);
        submitOrder(formData);
    });

    $(".btn-delete").click(function () {
        const address_id = $(this).data("id");
        deleteAddress(address_id);
    });
    checkUrlProfile();
    $(window).resize(function () {
        checkUrlProfile();
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

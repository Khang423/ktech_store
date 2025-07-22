$(document).ready(() => {
    // Mở/đóng các item trong bộ lọc khi click vào tiêu đề
    $(".option .item .title").click((e) => {
        const $title = $(e.currentTarget);
        const $item = $title.closest(".item");
        const $content = $item.find(".content");
        const $iconArrow = $item.find(".icon-arrow");

        $content.toggleClass("active"); // Toggle nội dung hiển thị
        $iconArrow.toggleClass("rotated"); // Xoay icon mũi tên
    });

    // Gán sự kiện checkbox khi trang load
    initFilterChangeListener();
});

// ✅ Lấy dữ liệu các checkbox đang được chọn
const getSelectedItems = () => {
    const selectedItems = {};

    $(
        ".section-search .option .item .content .item input[type=checkbox]:checked"
    ).each(function () {
        const $checkbox = $(this);
        const itemValue = $checkbox.closest(".content .item").data("name"); // giá trị nhỏ (ví dụ: i5, 8GB)
        const itemName = $checkbox.closest(".option > .item").data("name"); // nhóm lớn (ví dụ: CPU, RAM)

        if (!selectedItems[itemName]) {
            selectedItems[itemName] = [];
        }

        selectedItems[itemName].push(itemValue);
    });

    return selectedItems;
};

// ✅ Gán sự kiện "thay đổi" khi chọn/bỏ chọn checkbox
const initFilterChangeListener = () => {
    $(".btn-filter").on("click", () => {
        const data = getSelectedItems();
        const price = $("#price-range").val();

        $.ajax({
            url: "/productFillter",
            type: "POST",
            data: {
                price,
                data,
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token Laravel
            },
            success: function (response) {
                console.log("success", response);
                setDataSearch(response); // render sản phẩm mới
            },
        });
    });
};

// ✅ Render sản phẩm sau khi lọc
const setDataSearch = (response) => {
    const $preview = $("#section-laptop");
    $preview.empty();

    response.data.forEach((item) => {
        const specs = item.laptop_specs || item.phone_specs || {};
        const thumbnail = item.products.thumbnail || "default.jpg";
        const thumbnailPath = `/asset/admin/products/${item.product_id}/${thumbnail}`;

        const formattedPrice = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(item.final_price || 0);

        const html = `
            <div class="card-product" data-id="${item.id}" data-slug="${item.slug}">
                <div class="product-content">
                    <div class="product-thumbnail">
                        <img src="${thumbnailPath}" alt="${item.name}">
                    </div>
                    <div class="product-title">
                        ${item.config_name}
                    </div>
                    <div class="product-price">
                        ${formattedPrice}
                    </div>
                    <div class="product-rate d-flex">
                        <img src="/asset/outside/icon/star.png" alt="star">
                        <div class="icon-heart"></div>
                    </div>
                </div>
            </div>`;

        $preview.append(html);
    });
};

// ✅ Điều hướng sang trang chi tiết sản phẩm khi click
$("#section-laptop").on("click", ".card-product", function () {
    const product_slug = $(this).data("slug");
    window.location.href = "/product/" + product_slug;
});

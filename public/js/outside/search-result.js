$(document).ready(() => {
    $(".option .item .title").click((e) => {
        const $title = $(e.currentTarget);
        const $item = $title.closest(".item");
        const $content = $item.find(".content");
        const $iconArrow = $item.find(".icon-arrow");

        $content.toggleClass("active");
        $iconArrow.toggleClass("rotated");
    });
    checkSelect();
});

// Hàm dùng để lấy dữ liệu hiện tại của các checkbox đã chọn
const getSelectedItems = () => {
    const selectedItems = {};

    $(
        ".section-search .option .item .content .item input[type=checkbox]:checked"
    ).each(function () {
        const checkbox = $(this);
        const itemValue = checkbox.closest(".content .item").data("name");
        const itemName = checkbox.closest(".option > .item").data("name");

        if (!selectedItems[itemName]) {
            selectedItems[itemName] = [];
        }

        selectedItems[itemName].push(itemValue);
    });

    return selectedItems;
};

// Hàm này chỉ dùng để lắng nghe sự kiện (nếu bạn cần)
const checkSelect = () => {
    $(".section-search .option .item .content .item input[type=checkbox]").on(
        "change",
        () => {
            const data = getSelectedItems();

            $.ajax({
                url: "/productFillter",
                type: "POST",
                data: {
                    data,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    console.log("Success!", response);
                },
            });
        }
    );
};

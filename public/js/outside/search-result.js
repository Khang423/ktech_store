$(".option .item .title").click((e) => {
    const $title = $(e.currentTarget);
    const $item = $title.closest(".item");
    const $content = $item.find(".content");
    const $iconArrow = $item.find(".icon-arrow");

    $content.toggleClass("active");
    $iconArrow.toggleClass("rotated");
});

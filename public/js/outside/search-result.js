$(".option .item").click((e) => {
    const $item = $(e.currentTarget);
    const $content = $item.find(".content");
    const $iconArrow = $item.find(".icon-arrow");

    $content.toggleClass("active");
    $iconArrow.toggleClass("rotated");
});

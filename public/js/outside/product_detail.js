init_fancybox();
new Carousel(
    document.getElementById("product-image-carousel"),
    {
        Dots: false,
        Thumbs: {
            type: "classic",
        },
    },
    {
        Thumbs,
    }
);
// xử lý nút thêm sản phẩm vào giỏ hàng
$(".btn-add_to_cart").click(function () {
    const productId = $(this).data("productId");
    $.ajax({
        url: routeAddItemToCart,
        type: "POST",
        dataType: "json",
        data: {
            productId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            toast("Đã thêm vào giỏ hàng", "success");
        },
        error: function (data) {},
    });
});

$("#guest-add-to-cart").click(function () {
    $(".modal-action").removeClass("d-none");
});

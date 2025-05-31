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
            window.location.href = $routeIndex;
            toast("Thêm vào giỏ hàng thành công", "success");
        },
        error: function (data) {
            $(".text-danger").text("");
            if (data.responseJSON && data.responseJSON.errors) {
                let errors = data.responseJSON.errors;
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        $(`.error-${field}`).text(errors[field][0]);
                    }
                }
            }
        },
    });
});

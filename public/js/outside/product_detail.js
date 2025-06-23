$(document).ready(function () {
    // Initialize Fancybox and Product Carousel
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

    // Handle "Add to Cart" for logged-in users
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
            error: function (xhr) {
                console.error("Failed to add to cart", xhr.responseJSON);
            },
        });
    });

    // Handle "Add to Cart" for guest users
    $("#guest-add-to-cart").click(function () {
        $(".modal-action").removeClass("d-none");
    });
    $("#guest-btn-buy").click(function () {
        $(".modal-action").removeClass("d-none");
    });
});

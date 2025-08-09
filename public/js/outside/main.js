$(document)
    .ajaxStart(function () {
        $("#loading-spinner").fadeIn();
    })
    .ajaxStop(function () {
        $("#loading-spinner").fadeOut();
    });
$(document).ready(function () {
    // Initialize Swiper for banners
    new Swiper(".swiper-banner", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        slidesPerView: 1,
    });

    // Initialize Swiper for product items with responsive breakpoints
    new Swiper(".swiper-product-item", {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 15,
        breakpoints: {
            360: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
            1280: { slidesPerView: 4 },
        },
    });

    // Handle product card click - redirect to product detail page
    $(".card-product").on("click", function () {
        const product_id = $(this).data("id");
        const product_slug = $(this).data("slug");
        window.location.href = "/product/" + product_slug;
    });

    // Redirect login and register buttons
    $(".btn-login").click(function () {
        window.location.href = "/login";
    });

    $(".btn-register").click(function () {
        window.location.href = "/register";
    });

    // Search action - using input with class .input-search-bar
    $(".circle-icon").click(function () {
        const keyword = $(".input-search-bar").val();
        $.ajax({
            url: searchRoute,
            type: "POST",
            dataType: "json",
            data: {
                keyword,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                window.location.href = data.redirect;
            },
            error: function (xhr) {
                console.error("Search ajax error:", xhr);
            },
        });
    });

    // Search action - using input with id #input-search-bar
    $("#circle-icon").click(function () {
        const keyword = $("#input-search-bar").val();
        $.ajax({
            url: searchRoute,
            type: "POST",
            dataType: "json",
            data: {
                keyword,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                window.location.href = data.redirect;
            },
            error: function (xhr) {
                console.error("Search ajax error:", xhr);
            },
        });
    });

    // Handle Cart button click with authentication check
    $(".btn-cart").click(function () {
        $.ajax({
            url: authCheckStatus,
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data.auth) {
                    window.location.href = "/cart";
                } else {
                    toast("Bạn chưa đăng nhập", "warning");
                }
            },
            error: function (xhr, status, error) {
                console.error("Ajax error:", error);
            },
        });
    });
});

$(document).ready(function () {
    new Swiper(".swiper-banner", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        slidesPerView: 1,
    });

    new Swiper(".swiper-product-item", {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 15,

        breakpoints: {
            360: {
                slidesPerView: 2,
            },
            // Khi >= 640px
            640: {
                slidesPerView: 2,
            },
            // Khi >= 768px
            768: {
                slidesPerView: 3,
            },
            // Khi >= 1024px
            1024: {
                slidesPerView: 4,
            },
            1280: {
                slidesPerView: 5,
            },
        },
    });

    new Swiper(".swiper-category-product", {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 15,

        breakpoints: {
            400: {
                slidesPerView: 2,
            },
            // Khi >= 640px
            640: {
                slidesPerView: 3,
            },
            // Khi >= 768px
            768: {
                slidesPerView: 4,
            },
            // Khi >= 1024px
            1024: {
                slidesPerView: 5,
            },
        },
    });

    $(".category-product-card").on("click", function () {
        console.log(data_id);
    });

    $(".card-product").on("click", function () {
        let product_id = $(this).data("id");
        let product_slug = $(this).data("slug");
        window.location.href = "/product/" + product_slug;
    });

    $(".btn-login").click(function() {
        window.location.href = '/login';
    });
    $(".btn-register").click(function() {
        window.location.href = '/register';
    });
});

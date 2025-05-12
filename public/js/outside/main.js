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
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
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

    new Swiper(".swiper-category-product", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
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
});

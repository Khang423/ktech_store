$(document).ready(function () {
    // open menu mobile
    $(".btn-menu").on("click", function () {
        $(".menu-mobile").animate({ left: "0px" }, 200);
    });
    // close menu mobile
    $("#btn-close").on("click", function () {
        $(".menu-mobile").animate({ left: "-100vw" }, 200);
    });
    // hide/show modal menu
    $("#button-category-product").on("click", function () {
        $(".modal-nemnu-overlay").removeClass("d-none");
        $(".modal-menu-category").animate({ top: "19.6rem" }, 200);
    });

    $("#button-close-category-product").on("click", function () {
        $(".modal-nemnu-overlay").addClass("d-none");
        $(".modal-menu-category").animate({ top: "28.6rem" });
    });

    $(".btn-info-detail").on("click", function () {
        $(".product-info-detail-overlay").removeClass("d-none");
        $(".product-info-detail").animate({ right: "0px" }, 200);
    });
    $(".btn-product-info-detail-close").on("click", function () {
        $(".product-info-detail-overlay").addClass("d-none");
        $(".product-info-detail").animate({ right: "-100vw" }, 200);
    });
    $(".btn-product-info-detail-close-mobile").on("click", function () {
        $(".product-info-detail-overlay").addClass("d-none");
        $(".product-info-detail").animate({ right: "-100vw" }, 200);
    });

    $("#btn-user").on("click", function () {
        $(".modal-action").removeClass("d-none");
    });
    $(".modal-action-close").on("click", function () {
        $(".modal-action").addClass("d-none");
    });

    let hideTimeout;

    $("#btn-user-logged-in, .user-dropdown").hover(
        function () {
            clearTimeout(hideTimeout);
            $(".user-dropdown").removeClass("d-none");
        },
        function () {
            hideTimeout = setTimeout(function () {
                $(".user-dropdown").addClass("d-none");
            }, 200);
        }
    );

    $(".toggle-dropdown").on("click", function () {
        const dropdown = $(this).next(".item-dropdown");
        dropdown.toggleClass("show");
        $(this).find(".icon-arrow").toggleClass("rotate");
    });

    $(".toggle-desktop-menu").on("click", function () {
        $(".desktop-menu").toggleClass("show");

        if ($(".desktop-menu").hasClass("show")) {
            $(".desktop-menu").removeClass("d-none");
        } else {
            $(".desktop-menu").addClass("d-none");
        }
    });
});

function goToPageProfile() {
    window.location.href = routeProfile;
}

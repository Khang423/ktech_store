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
    $('#button-category-product').on('click', function () {
        $('.modal-nemnu-overlay').removeClass('d-none');
        $(".modal-menu-category").animate({ top: "19.6rem" }, 200);
    });

    $('#button-close-category-product').on('click', function () {
        $('.modal-nemnu-overlay').addClass('d-none');
        $(".modal-menu-category").animate({ top: "28.6rem" });
    });
});

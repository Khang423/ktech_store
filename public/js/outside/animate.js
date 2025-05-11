$(document).ready(function () {
    // open menu mobile
    $(".btn-menu").on("click", function () {
        $(".menu-mobile").animate({ left: "0px" }, 300);
    });
    // close menu mobile
    $("#btn-close").on("click", function () {
        $(".menu-mobile").animate({ left: "-100vw" }, 300);
    });
});

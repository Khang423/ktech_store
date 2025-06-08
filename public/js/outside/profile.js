$(document).ready(function () {
    $(".sidebar .item").click(function () {
        $(".sidebar .item").removeClass("active");
        $(this).addClass("active");

        if ($(this).hasClass("btn-purchase-history")) {
            $(".purchase-history").removeClass("d-none");
        } else {
            $(".purchase-history").addClass("d-none");
        }

        if ($(this).hasClass("btn-account-info")) {
            $(".account-info").removeClass("d-none");
        } else {
            $(".account-info").addClass("d-none");
        }
    });

    $(".order-status .item").click(function () {
        $(".order-status .item").removeClass("active");
        $(this).addClass("active");
    });
});

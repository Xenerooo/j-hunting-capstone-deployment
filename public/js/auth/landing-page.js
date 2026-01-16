function landingPageDropdown() {
    //desktop view
    $("#register-button").on("click", function (e) {
        e.stopPropagation();
        $("#register-dropdown").toggleClass("hidden");
    });
    $(document).on("click", function () {
        $("#register-dropdown").addClass("hidden");
    });

    //mobile view
    $("#mobile-menu-button").on("click", function () {
        $("#mobile-menu").toggleClass("hidden");
    });
    $("#mobile-register-button").on("click", function (e) {
        e.stopPropagation();
        $("#mobile-register-dropdown").toggleClass("hidden");
    });
    $(document).on("click", function () {
        $("#mobile-register-dropdown").addClass("hidden");
    });
}


$(function () {
    landingPageDropdown();
});

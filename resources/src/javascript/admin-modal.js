function jobPostRequest() {
    $("#decline-post-request").on("click", function () {
        $("#message-modal").removeClass("hidden");
    });

    $("#submit-message, #close-message-modal").on("click", function () {
        $("#message-modal").addClass("hidden");
    });
}

function seekerRegRequest() {
    $("#decline-seeker-registration").on("click", function () {
        $("#message-modal").removeClass("hidden");
    });

    $("#submit-message, #close-message-modal").on("click", function () {
        $("#message-modal").addClass("hidden");
    });
}

function employerRegRequest() {
    $("#decline-employer-registration").on("click", function () {
        $("#message-modal").removeClass("hidden");
    });

    $("#submit-message, #close-message-modal").on("click", function () {
        $("#message-modal").addClass("hidden");
    });
}

$(function () {
    jobPostRequest();
    seekerRegRequest();
    employerRegRequest();
});

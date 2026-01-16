function message(color, title, content) {
    //green
    // "bg-green-100 border-green-500 text-green-700",

    //red
    //"bg-red-100 border-red-500 text-red-700",

    //sky (blue)
    //"bg-sky-100 border-sky-500 text-sky-700",

    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, 6000);
}

function forgotPassword() {
    $("#forgot-password-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: linkRoute,
            method: "POST",
            data: {
                email: $('input[name="email"]').val(),
                _token: csrfToken,
            },
            success: function (response) {
                message(
                    "bg-green-100 border-green-500 text-green-700",
                    "Email Sent!",
                    response.message
                );

                console.log(response);
            },
            error: function (error) {
                const notif =
                    error.responseJSON && error.responseJSON.message
                        ? error.responseJSON.message
                        : "Something went wrong.";

                console.log(notif);

                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Email Failed!",
                    notif
                );
            },
        });
    });
}

$(function () {
    forgotPassword();
});

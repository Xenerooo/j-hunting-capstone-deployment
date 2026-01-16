function message(color, title, content) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, 3000);
}

$(function () {
    let rating = 0;
    const $stars = $("#star-template svg");

    $stars.on("click", function () {
        rating = $(this).index() + 1;
        $("#rating-input").val(rating);
        updateStars(rating);
    });

    $stars.on("mouseenter", function () {
        const hoverVal = $(this).index() + 1;
        updateStars(hoverVal);
    });

    $stars.on("mouseleave", function () {
        updateStars(rating);
    });

    function updateStars(value) {
        $stars.each(function (index) {
            if (index < value) {
                $(this)
                    .addClass("text-yellow-400")
                    .removeClass("text-gray-400");
            } else {
                $(this)
                    .addClass("text-gray-400")
                    .removeClass("text-yellow-400");
            }
        });
    }

    $("#feedbackForm").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);
        formData.append("email", $("[name='email']").text());
        formData.append("_token", token);

        if (rating == 0) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Please rate our service by filling a star below."
            );
        }

        $.ajax({
            type: "post",
            url: feedbackRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                message(
                    "bg-green-100 border-green-500 text-green-700",
                    "Success",
                    response.message
                );

                $(form)[0].reset();
                $("#rating-input").val(0);
                updateStars(0);
                $("#feedback-modal").fadeOut();
            },
            error: function (xhr, status, error) {
                console.log("Error details:", {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                });

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorValue = Object.values(errors)[0][0];

                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Validation Error",
                        errorValue
                    );
                } else if (xhr.status === 401) {
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Authentication Error",
                        "Please log in to submit feedback."
                    );
                } else if (xhr.status === 403) {
                    if (xhr.responseJSON && xhr.responseJSON.redirect) {
                        message(
                            "bg-red-100 border-red-500 text-red-700",
                            "Account Not Approved",
                            "Please complete your profile verification first."
                        );
                    } else {
                        message(
                            "bg-red-100 border-red-500 text-red-700",
                            "Access Denied",
                            "Your account is not approved to submit feedback."
                        );
                    }
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Error",
                        xhr.responseJSON.message
                    );
                } else {
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Error",
                        "An unexpected error occurred. Please try again."
                    );
                }
            },
        });
    });
});

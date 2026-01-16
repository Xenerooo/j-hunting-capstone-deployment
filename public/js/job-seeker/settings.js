function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function changePassword() {
    $("#changePasswordForm").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);
        formData.append("_token", token);

        if (
            $("[name='confirm']").val() != "CONFIRM" ||
            $("[name='confirm']").val() === null
        ) {
            message(
                "bg-red-100 border-red-500 text-red-700",
                "Unable to process",
                "Please confirm your request by typing CONFIRM in the input.",
                5000
            );

            return;
        }

        $.ajax({
            type: "post",
            url: changePasswordRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.success === false) {
                    message(
                        "bg-sky-100 border-sky-500 text-sky-700",
                        "Failed",
                        response.message,
                        5000
                    );

                    return;
                }

                message(
                    "bg-green-100 border-green-500 text-green-700",
                    "Success",
                    response.message,
                    5000
                );

                $("[name='current_password']").val("");
                $("[name='new_password']").val("");
                $("[name='confirm']").val("");
            },
            error: function (xhr, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorValue = Object.values(errors)[0][0];
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Failed",
                        errorValue,
                        5000
                    );
                } else {
                    console.log("Other error:", xhr.message);
                }
            },
        });
    });
}

function deleteAccount() {
    $("#deleteAccountForm").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);
        formData.append("_token", token);

        if ($("[name='delete-confirm']").val() !== "CONFIRM") {
            message(
                "bg-red-100 border-red-500 text-red-700",
                "Unable to process",
                "Please confirm your request by typing CONFIRM in the input.",
                5000
            );

            return;
        }

        $.ajax({
            type: "post",
            url: deleteAccountRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.success === false) {
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Failed",
                        response.message,
                        5000
                    );

                    return;
                }

                message(
                    "bg-green-100 border-green-500 text-green-700",
                    "Success",
                    response.message,
                    5000
                );

                $("[name='password']").val("");
                $("[name='password_confirmation']").val("");
                $("[name='delete-confirm']").val("");
                location.reload();
            },
            error: function (xhr, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorValue = Object.values(errors)[0][0];

                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Failed",
                        errorValue,
                        5000
                    );
                } else {
                    // console.log("Other error:", xhr.responseText);
                    location.reload();
                }
            },
        });
    });
}

$(function () {
    changePassword();
    deleteAccount();
});

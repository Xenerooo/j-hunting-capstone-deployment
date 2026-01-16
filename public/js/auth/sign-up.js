function message(color, content) {
    $("#error-wrapper").fadeIn();
    $("#error-wrapper").addClass(color);
    $(`[name="error-message"]`).text("");
    $(`[name="error-message"]`).text(content);
}

function removeBorder(fieldName) {
    const field = $(`input[name="${fieldName}"]`);

    field.on("change", function () {
        field.removeClass("border-red-500");
        field.addClass("border-gray-300");
    });
}

function signUp() {
    $("#signUpForm").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const signUpForm = new FormData();

        $(form)
            .find("input")
            .each(function () {
                const name = $(this).attr("name");
                const value = $(this).val();

                if (name && value != null && value != "") {
                    signUpForm.append(name, value);
                }
            });
        signUpForm.append("_token", token);

        if (!$('input[name="confirmation_radio"]').is(":checked")) {
            return message(
                "bg-red-100 text-red-700",
                "Please confirm your user type by checking the check box."
            );
        }

        if (!$("#agree").is(":checked")) {
            return message(
                "bg-red-100 text-red-700",
                "Please agree to the Terms and Conditions."
            );
        }

        $.ajax({
            type: "post",
            url: pageRoute,
            data: signUpForm,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                $("#mailing-overlay").fadeIn();
            },
            success: function (response, xhr) {
                if (response.status === "success") {
                    $("#mailing-overlay").fadeOut();
                    $(
                        "[name='email'],[name='password'],[name='password_confirmation']"
                    ).val("");
                    return message(
                        "bg-green-100 text-green-700",
                        response.message
                    );
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorKey = Object.keys(errors)[0];
                    const errorValue = Object.values(errors)[0][0];

                    message("bg-red-100 text-red-700", errorValue);

                    $(`input[name="${errorKey}"]`).addClass("border-red-500");
                    $("#mailing-overlay").fadeOut();
                    removeBorder(errorKey);
                } else {
                    console.log("Other error:", error);
                    $("#mailing-overlay").fadeOut();
                }
            },
        });
    });
}

$(function () {
    signUp();
});

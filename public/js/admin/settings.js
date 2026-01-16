function message(color, title, content) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, 6000);
}

function changePassword() {
    $("form").on("submit", function (e) {
        e.preventDefault();

        if ($("[name='confirm']").val() !== "CONFIRM") {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Password Failed!",
                "Please type CONFIRM to confirm the changes."
            );
        }

        const formData = new FormData(this);
        formData.append("_token", token);

        $.ajax({
            url: changePasswordRoute,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.success == false) {
                    return message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Password Change Status!",
                        response.message
                    );
                } else {
                    $("[name='current_password']").val("");
                    $("[name='new_password']").val("");
                    $("[name='confirm']").val("");

                    return message(
                        "bg-green-100 border-green-500 text-green-700",
                        "Password Change Status!",
                        response.message
                    );
                }
            },
            error: function (error) {
                const notif =
                    error.responseJSON && error.responseJSON.message
                        ? error.responseJSON.message
                        : "Something went wrong.";

                return message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Password Failed!",
                    notif
                );
            },
        });
    });
}

$(function () {
    changePassword();
});

const urlParts = window.location.pathname.split("/");
const seekerId = urlParts[urlParts.length - 1];

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

function approval() {
    let is_approve = false;

    //approve account
    $("#approve-button").on("click", function (e) {
        e.preventDefault();
        is_approve = true;
        $("#approve-modal").fadeIn();

        $("#confirm-approve").on("click", function () {
            $("#approve-modal").fadeOut();
            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    seeker_id: seekerId,
                    is_approved: is_approve,
                    email: $("[name='email']").text(),
                    title: "Account notice",
                    content:
                        "Congratulation! Your account has been approved by the admin.",
                },
                dataType: "json",
                beforeSend: function () {
                    $("#mailing-overlay").fadeIn();
                },
                success: function (response) {
                    console.log(response);

                    if (response.success != true) {
                        message(
                            "bg-red-100 text-red-700",
                            "Approval Status",
                            response.message
                        );
                        $("#mailing-overlay").fadeOut();
                    } else {
                        message(
                            "bg-green-100 text-green-700",
                            "Approval Status",
                            response.message
                        );
                        $("#mailing-overlay").fadeOut();
                        window.location.href = pageRoute;
                    }
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                    $("#mailing-overlay").fadeOut();
                },
            });
        });
    });

    //decline account
    $("#decline-button").on("click", function (e) {
        e.preventDefault();
        is_approve = false;
        $("#message-modal").fadeIn();

        $("#message-modal").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    seeker_id: seekerId,
                    is_approved: is_approve,
                    email: $("[name='email']").text(),
                    title: $("[name='title']").val(),
                    content: $("[name='content']").val(),
                },
                dataType: "json",
                beforeSend: function () {
                    $("#mailing-overlay").fadeIn();
                },
                success: function (response) {
                    message(
                        "bg-green-100 text-green-700",
                        "Decline Status",
                        response.message
                    );
                    $("#mailing-overlay").fadeOut();
                    window.location.href = pageRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                    $("#mailing-overlay").fadeOut();
                },
            });
        });
    });
}

function viewProfile() {
    $.ajax({
        type: "GET",
        url: getProfileRoute,
        data: {
            seeker_id: seekerId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const data = response.data;
            const jobTypes = response.job_types ?? [];
            const portfolio = response.portfolio ?? [];
            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            $("[name='full_name']").text(fullName);
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(`Brgy. ${data.barangay}, ${data.city}`);
            $("[name='job_type']").text(jobTypes.join(", "));

            $.each(portfolio, function (key, value) {
                if (value.type === "link") {
                    $('a[name="portfolio_link"]')
                        .text(value.path)
                        .attr("href", value.path)
                        .attr("target", "_blank");
                }

                if (value.type === "file") {
                    let formatFile = value.path.split("_").pop() ?? "No File";
                    if (value.path) {
                        const fileUrl = `/storage/${value.path}`;
                        $("#additionalFileName")
                            .text(formatFile)
                            .attr("href", fileUrl)
                            .attr("target", "_blank");
                    } else {
                        $("#additionalFileName").text("No File");
                    }
                }
                return;
            });
            $.each(data, function (key, value) {
                if (
                    [
                        "employer_id",
                        "account_id",
                        "first_name",
                        "mid_name",
                        "last_name",
                        "suffix",
                        "email",
                        "barangay",
                        "city",
                    ].includes(key)
                )
                    return;
                const $target = $(`[name="${key}"]`);

                try {
                    if (key === "profile_pic") {
                        const imgUrl = value
                            ? `/storage/${value}`
                            : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
                        $('img[name="profile_pic"]').attr("src", imgUrl);
                        return;
                    }
                    if (key === "facebook_link") {
                        const fbLink = value ? value : "";
                        $('a[name="facebook_link"]')
                            .text(fbLink)
                            .attr("href", fbLink)
                            .attr("target", "_blank");
                        return;
                    }

                    if (key === "experience") {
                        const exp = value ? value : "N/A";
                        $('[name="experience"]').text(exp);
                        return;
                    }

                    if (key === "resume") {
                        let formatFile = value.split("_").pop() ?? "No File";

                        if (value) {
                            const resumeUrl = `/storage/${value}`;
                            $("#resumeName")
                                .text(formatFile)
                                .attr("href", resumeUrl)
                                .attr("target", "_blank")
                                .removeClass("hidden");
                        } else {
                            $("#resumeName")
                                .text("No Resume")
                                .removeAttr("href")
                                .attr("target", "")
                                .addClass("hidden");
                        }
                        return;
                    }

                    if (key === "birthday") {
                        const birthday = new Date(value);
                        if (isNaN(birthday)) {
                            console.warn("Invalid date for birthday:", value);
                            return;
                        }

                        const formatted = birthday.toLocaleDateString("en-US", {
                            month: "long",
                            day: "2-digit",
                            year: "numeric",
                        });
                        $target.text(formatted);
                        return;
                    }

                    $target.text(value ?? "");
                } catch (error) {
                    console.log(error);
                }
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function downloadResume() {
    $("#downloadResume").on("click", function (e) {
        e.preventDefault();
        const resumePath = $("#resumeName").attr("href");
        window.location.href = resumePath;
    });

    $("#downloadFile").on("click", function (e) {
        e.preventDefault();
        const additionalPath = $("#additionalFileName").attr("href");
        window.location.href = additionalPath;
    });
}

$(function () {
    viewProfile();

    downloadResume();
    approval();
});

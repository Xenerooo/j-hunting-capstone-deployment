const urlParts = window.location.pathname.split("/");
const seekerId = urlParts[urlParts.length - 1];

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function getSeekerData() {
    $.ajax({
        url: getSeekerDataRoute,
        type: "GET",
        data: {
            _token: token,
            seeker_id: seekerId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const data = response.data ?? [];
            const jobType = response.job_type ?? [];
            const portfolio = response.portfolio ?? [];

            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            $("[name='full_name']").text(fullName);
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(`Brgy. ${data.barangay}, ${data.city}`);
            $('[name="job_type"]').text(jobType);

            $.each(portfolio, function (key, value) {
                if (value.type === "link") {
                    const portfolioLink = value.path ?? "";

                    $('a[name="portfolio_link"]')
                        .text(portfolioLink)
                        .attr("href", portfolioLink)
                        .attr("target", "_blank");
                }

                if (value.type === "file") {
                    let formatFile = value.path.split("_").pop() ?? "";

                    if (value.path) {
                        const fileUrl = `/storage/${value.path}`;
                        $("#fileName")
                            .text(formatFile)
                            .attr("href", fileUrl)
                            .attr("target", "_blank")
                            .removeClass("hidden");
                    } else {
                        $("#fileName").text("No File");
                    }
                    return;
                }
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
                        let formatFile = value.split("_").pop() ?? "";

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
        const additionalPath = $("#fileName").attr("href");
        window.location.href = additionalPath;
    });
}

function followSeeker() {
    $("#follow-button").on("click", function (e) {
        e.preventDefault();

        const $btn = $(this);
        $btn.prop("disabled", true);

        $.ajax({
            type: "post",
            url: followSeekerRoute,
            data: {
                _token: token,
                seeker_id: seekerId,
            },
            dataType: "json",
            success: function (response) {
                checkFollowStatus();
            },
            error: function (xhr) {
                console.error("Failed to follow/unfollow seeker:", xhr);
            },
            complete: function () {
                $btn.prop("disabled", false);
            },
        });
    });
}

function checkFollowStatus() {
    $.ajax({
        type: "post",
        url: checkFollowStatusRoute,
        data: {
            _token: token,
            seeker_id: seekerId,
        },
        dataType: "json",
        success: function (response) {
            if (response.text === "Unfollow") {
                $("#follow-button")
                    .text(response.text)
                    .removeClass("border-sky-600 hover:bg-sky-700")
                    .addClass("border-red-600 hover:bg-red-700");
            } else {
                $("#follow-button")
                    .text("Follow")
                    .removeClass("border-red-600 hover:bg-red-700")
                    .addClass("border-sky-600 hover:bg-sky-700");
            }
        },
        error: function (xhr) {
            console.error("Failed to check follow status:", xhr);
        },
    });
}

function reportSeeker() {
    $("#report-button").on("click", function (e) {
        e.preventDefault();
        $("#report-modal").fadeIn();

        $("#report-form")
            .off("submit")
            .on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: reportSeekerRoute,
                    data: {
                        _token: token,
                        seeker_id: seekerId,
                        title: $("#report-title").val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        if (response.success != true) {
                            message(
                                "bg-red-100 border-red-500 text-red-700",
                                "Failed",
                                response.message,
                                5000
                            );
                        } else {
                            message(
                                "bg-green-100 border-green-500 text-green-700",
                                "Success",
                                response.message,
                                5000
                            );
                        }
                    },
                    error: function (xhr) {
                        console.error("Failed to fetch data : ", xhr);
                    },
                });
                $("#report-modal").fadeOut();
            });
    });
}

$(function () {
    getSeekerData();
    downloadResume();
    followSeeker();
    checkFollowStatus();
    reportSeeker();
});

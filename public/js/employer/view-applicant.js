const path = window.location.pathname;
const seekerIdMatch = path.match(/seeker_id=(\d+)/);
const jobIdMatch = path.match(/job_id=(\d+)/);

const seekerId = seekerIdMatch ? seekerIdMatch[1] : null;
const jobId = jobIdMatch ? jobIdMatch[1] : null;

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
        url: getApplicantDataRoute,
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
            $("[name='work_experience']").text(data.experience);
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

function checkStatus() {
    $.ajax({
        type: "get",
        url: checkApplicantRoute,
        data: {
            seeker_id: seekerId,
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            if (response.status !== "pending") {
                console.log(response.status);
                $("#responded").text(response.status).removeClass("hidden");
            } else {
                $("[name='not-responded']").removeClass("hidden");
            }
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function acceptApplication(action) {
    const interviewDateRaw = $("[name='interview_date']").val();

    if (action === "interview") {
        if (!interviewDateRaw) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Please select an interview date.",
                5000
            );
        }

        const dateObj = new Date(interviewDateRaw);
        if (isNaN(dateObj)) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Invalid interview date format.",
                5000
            );
        }

        const now = new Date();
        now.setSeconds(0, 0);

        if (dateObj <= now) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Interview date must be in the future.",
                5000
            );
        }

        const oneYearLater = new Date(now);
        oneYearLater.setFullYear(oneYearLater.getFullYear() + 1);

        if (dateObj > oneYearLater) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Interview date must not be more than 1 year from today.",
                5000
            );
        }
    }

    $.ajax({
        type: "POST",
        url: acceptApplicantRoute,
        data: {
            _token: token,
            action: action,
            seeker_id: seekerId,
            job_id: jobId,
            interview_date: interviewDateRaw,
            mode: $("[name='mode']").val(),
            detail: $("[name='detail']").val(),
        },
        dataType: "json",
        success: function (response) {
            if (response.success == false) {
                return message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Failed",
                    "Fill out all the fields, please try again.",
                    5000
                );
            }

            message(
                "bg-green-100 border-green-500 text-green-700",
                "Success",
                response.message,
                5000
            );

            $("#interview-modal").fadeOut();
            window.location.reload();
        },
        error: function (xhr) {
            console.log(xhr);
            message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                (xhr.responseJSON && xhr.responseJSON.message) ||
                    "An error occurred.",
                5000
            );
        },
    });
}

function rejectApplicant() {
    $("#confirm-reject").on("click", function (e) {
        e.preventDefault();

        $("#reject-modal").fadeOut();

        $.ajax({
            type: "POST",
            url: rejectApplicantRoute,
            data: {
                _token: token,
                seeker_id: seekerId,
                job_id: jobId,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                if (response.success == false) {
                    return message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Failed",
                        response.message,
                        5000
                    );
                }

                message(
                    "bg-green-100 border-green-500 text-green-700",
                    "Success",
                    response.message,
                    5000
                );

                window.location.reload();
            },
            error: function (response) {
                console.log(response);
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Failed",
                    response.message,
                    5000
                );
            },
        });
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

$(function () {
    checkStatus();
    getSeekerData();
    downloadResume();

    $("#reject-button").on("click", function (e) {
        e.preventDefault();
        $("#reject-modal").fadeIn();
        rejectApplicant();
    });

    $("#for-interview").on("click", function (e) {
        e.preventDefault();
        $("#interview-modal").fadeIn();
    });

    $("#interview-modal").on("click", "#submit-schedule", function (e) {
        e.preventDefault();
        acceptApplication("interview");
    });

    $("#for-job").on("click", function (e) {
        e.preventDefault();
        acceptApplication("accept");
    });
});

const urlParts = window.location.pathname.split("/");
const seekerId = urlParts[urlParts.length - 1];

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").removeClass(color);
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function viewSeeker() {
    $.ajax({
        url: getProfileRoute,
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
            const portfolio = response.portfolio ?? [];
            const jobTypes = response.job_types ?? [];

            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            $("[name='full_name']").text(fullName);
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(`Brgy. ${data.barangay}, ${data.city}`);
            $("[name='job_type']").text(jobTypes);

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
                        $("#fileName")
                            .text("No File")
                            .removeAttr("href")
                            .attr("target", "")
                            .addClass("hidden");
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
                        const experience = value ? value : "N/A";
                        $('[name="experience"]').text(experience);
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

function sendMessage() {
    let is_warning = false;

    //send warning to the user
    $("#send-warning-button").on("click", function (e) {
        e.preventDefault();
        $("#message-modal").fadeIn();
        is_warning = true;

        $("#submit-message")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();

                $.ajax({
                    url: sendMessageRoute,
                    type: "POST",
                    data: {
                        _token: token,
                        seeker_id: seekerId,
                        title: $("select[name='title']").val(),
                        content: $("textarea[name='content']").val(),
                        is_warning: is_warning,
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#message-modal").fadeOut();

                        if (response.success == false) {
                            return message(
                                "bg-red-100 border-red-500 text-red-700",
                                "Failed",
                                response.message,
                                5000
                            );
                        }
                        return message(
                            "bg-green-100 border-green-500 text-green-700",
                            "Success",
                            response.message,
                            5000
                        );
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const errorKey = Object.keys(errors)[0];
                            const errorValue = Object.values(errors)[0][0];

                            return message(
                                "bg-red-100 border-red-500 text-red-700",
                                "Failed",
                                errorValue,
                                5000
                            );
                        }
                    },
                });
            });
    });

    //restrict a user
    $("#restrict-button").on("click", function (e) {
        e.preventDefault();
        $("#restrict-modal").fadeIn();
        let is_warning = false;

        $("#confirm-restrict")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();

                $.ajax({
                    url: sendMessageRoute,
                    type: "POST",
                    data: {
                        _token: token,
                        seeker_id: seekerId,
                        title: "Restricted Account",
                        content:
                            "Your account has been restricted due to violation of our terms and conditions.",
                        is_warning: is_warning,
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $("#mailing-overlay").fadeIn();
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.href = pageRoute;
                    },
                    error: function (xhr) {
                        console.error("Failed to restrict user:", xhr);
                    },
                    complete: function () {
                        $("#mailing-overlay").fadeOut();
                    },
                });

                $("#restrict-modal").fadeOut();
            });
    });
}

function appliedJobs() {
    $.ajax({
        url: appliedJobsRoute,
        type: "GET",
        data: {
            _token: token,
            seeker_id: seekerId,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data ?? [];

            $("#applied-jobs").empty();

            function getStatusBadge(status) {
                let badge = { text: status, color: "bg-gray-400", icon: "" };

                switch (status.toLowerCase()) {
                    case "accepted":
                        badge = {
                            text: "Accepted",
                            color: "bg-green-500/90 text-white",
                            icon: `<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`,
                        };
                        break;
                    case "rejected":
                        badge = {
                            text: "Rejected",
                            color: "bg-red-500/90 text-white",
                            icon: `<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`,
                        };
                        break;
                    case "pending":
                        badge = {
                            text: "Pending",
                            color: "bg-yellow-400/90 text-white",
                            icon: `<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/></svg>`,
                        };
                        break;
                    case "interview":
                        badge = {
                            text: "Interview",
                            color: "bg-blue-500/90 text-white",
                            icon: `<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 3v4M8 3v4"/></svg>`,
                        };
                        break;
                    default:
                        badge = {
                            text:
                                status.charAt(0).toUpperCase() +
                                status.slice(1),
                            color: "bg-gray-400 text-white",
                            icon: "",
                        };
                }
                return `<span class="py-1 px-3 inline-flex items-center justify-center font-semibold text-[12px] rounded-lg ${badge.color} w-full md:w-auto transition-all duration-200 shadow-sm">${badge.icon}${badge.text}</span>`;
            }

            data.forEach(function (job) {
                const profilePic = job.profile_pic
                    ? `/storage/${job.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const viewJob = `/admin/all-jobs/view/${job.job_id}`;
                const viewEmployer = `/admin/all-employers/view/${job.employer_id}`;

                const salary = parseFloat(job.expected_salary);
                const formatSalary = salary.toLocaleString("en-PH", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

                const template = `
                    <div class="group bg-white/95 backdrop-blur rounded-2xl border border-sky-100 shadow hover:shadow-lg transition-all duration-300 p-5 mb-4">
                        <div class="grid grid-cols-8 gap-3 items-start">
                            <div class="col-span-8 md:col-span-3 flex items-center">
                                <img src="${profilePic}" alt=""
                                    class="object-cover w-[56px] h-[56px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-3 shadow">
                                <div>
                                    <a href="${viewEmployer}" class="text-[15px] text-sky-900 hover:text-sky-700 font-semibold transition-colors min-w-[180px]">${
                    job.employer_name
                }</a>
                                    <a href="${viewJob}" class="block text-[18px] text-sky-900 hover:text-sky-700 font-semibold transition-colors min-w-[180px]">${
                    job.job_title
                }</a>
                                </div>
                            </div>

                            <div class="col-span-4 md:col-span-2 flex flex-col justify-center mt-2 md:mt-0">
                                <span class="inline-flex"><span class="bg-yellow-600/10 inline-flex items-center text-yellow-700 text-[11px] px-2.5 py-1 font-semibold rounded-full">Full Time</span></span>
                                <span class="block text-gray-500 text-xs md:text-sm md:mt-1">Applied on: <span class="font-medium text-gray-700">${
                                    job.applied_at
                                }</span></span>
                            </div>

                            <div class="col-span-4 md:col-span-2 flex flex-col justify-center md:items-start mt-2 md:mt-0">
                                <span class="block font-semibold text-sky-800 text-xs md:text-[14px]">₱${formatSalary}/${
                    job.salary_basis
                }</span>
                                <span class="text-gray-500 text-xs md:text-[14px] max-w-[250px]">${
                                    job.location
                                }</span>
                            </div>

                            <div class="col-span-8 md:col-span-1 flex items-center md:justify-end mt-2 md:mt-0">
                                ${getStatusBadge(job.status)}
                            </div>
                        </div>
                    </div>
                `;

                $("#applied-jobs").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch applied jobs:", xhr);
        },
    });
}

$(function () {
    viewSeeker();
    downloadResume();
    sendMessage();
    appliedJobs();
});

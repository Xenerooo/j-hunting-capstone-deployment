const urlParts = window.location.pathname.split("/");
const employerId = urlParts[urlParts.length - 1];

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function map(latitude, longitude, workLocation) {
    var map = L.map("map").setView([latitude, longitude], 19);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    L.marker([latitude, longitude])
        .addTo(map)
        .bindPopup(workLocation)
        .openPopup();
}

function viewEmployer() {
    $.ajax({
        url: getProfileRoute,
        type: "GET",
        data: {
            _token: token,
            employer_id: employerId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const data = response.data;
            const jobTypes = response.job_types ?? [];

            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            const location = `Brgy. ${data.barangay ?? ""}, ${data.city ?? ""}`;

            const compName = data.comp_name ?? "";

            $("[name='full_name']").text(fullName);
            $("[name='comp_name']").text(compName);
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(location);
            $("[name='job_type']").text(jobTypes);

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

                    if (key === "valid_id") {
                        const validIdUrl = `/storage/${value}`;
                        $("#valid-id-preview").attr("src", validIdUrl);
                        $("#valid-id-preview-modal").attr("src", validIdUrl);
                        return;
                    }

                    if (key === "business_permit") {
                        let formatFile = value.split("permit/").pop() ?? "";

                        if (value) {
                            const permitUrl = `/storage/${value}`;
                            $("[name='permit_name']")
                                .text(formatFile)
                                .attr("href", permitUrl)
                                .attr("target", "_blank")
                                .removeClass("hidden");
                        } else {
                            $("[name='permit_name']")
                                .text("No Business Permit")
                                .removeAttr("href")
                                .attr("target", "")
                                .addClass("hidden");
                        }
                        return;
                    }
                    $target.text(value ?? "");
                } catch (error) {
                    console.log(error);
                }
            });
            map(data.latitude, data.longitude, data.work_location);
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function downloadPermit() {
    $("#downloadPermit").on("click", function (e) {
        e.preventDefault();
        const permitPath = $("[name='permit_name']").attr("href");
        window.location.href = permitPath;
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
                        employer_id: employerId,
                        title: $("select[name='title']").val(),
                        content: $("textarea[name='content']").val(),
                        is_warning: is_warning,
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#message-modal").fadeOut();

                        if (response.success != true) {
                            return message(
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
                        employer_id: employerId,
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

function postedJobs() {
    $.ajax({
        type: "GET",
        url: postedJobsRoute,
        data: {
            _token: token,
            employer_id: employerId,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;

            $("#posted-jobs").empty();

            data.forEach((data) => {
                let status = "Pending";
                let statusStyle =
                    "bg-amber-100 text-amber-800 border-amber-200";
                let statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12,6 12,12 16,14" />
                </svg>`;

                switch (data.status) {
                    case "pending":
                        status = "Pending";
                        statusStyle =
                            "bg-amber-100 text-amber-800 border-amber-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12,6 12,12 16,14" />
                        </svg>`;
                        break;

                    case "accepted":
                        status = "Accepted";
                        statusStyle =
                            "bg-emerald-100 text-emerald-800 border-emerald-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22,4 12,14.01 9,11.01" />
                        </svg>`;
                        break;

                    case "rejected":
                        status = "Rejected";
                        statusStyle = "bg-red-100 text-red-800 border-red-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                        </svg>`;
                        break;

                    case "restricted":
                        status = "Restricted";
                        statusStyle = "bg-red-500 text-white border-red-500";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <circle cx="12" cy="16" r="1" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>`;
                        break;
                    case "expired":
                        status = "Expired";
                        statusStyle = "bg-red-500 text-white border-red-500";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12,6 12,12 16,14" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                        </svg>`;
                        break;
                    default:
                        status = "Pending";
                        statusStyle =
                            "bg-amber-100 text-amber-800 border-amber-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12,6 12,12 16,14" />
                        </svg>`;
                        break;
                }

                const viewJob = `/admin/all-jobs/view/${data.job_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const template = `
                <div class="group bg-white/90 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-sm hover:shadow-md transition-all duration-300 p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="${profilePic}" alt=""
                                class="object-cover w-[56px] h-[56px] ring-4 ring-white border border-sky-200 rounded-xl overflow-hidden mr-3">
                            <div>
                                <p class="text-[15px] font-semibold text-sky-800">${data.employer_name}</p>
                                <span class="block text-xs text-gray-500">Posted on: ${data.posted_at}</span>
                            </div>
                        </div>
                        <span class="${statusStyle} inline-flex items-center gap-1 text-[11px] px-2.5 py-1 font-semibold rounded-full">
                        ${statusIcon}
                            ${status}
                        </span>
                    </div>

                    <div class="mt-4">
                        <a href="${viewJob}" class="text-[18px] text-sky-900 hover:text-sky-700 font-semibold transition-colors">${data.job_title}</a>
                    </div>

                    <div class="my-4 w-full h-px bg-sky-100"></div>

                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2 text-gray-700">
                            <div class="w-7 h-7 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /></svg>
                            </div>
                            <span class="text-gray-700">${data.hired_applicants} of ${data.max_applicants} hired</span>
                        </div>
                        <a href="${viewJob}" class="text-sky-700 hover:text-sky-800 text-xs font-semibold">View details →</a>
                    </div>
                </div>`;
                $("#posted-jobs").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch posted jobs:", xhr);
        },
    });
}

$(function () {
    viewEmployer();
    downloadPermit();
    sendMessage();
    postedJobs();
});

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

function getEmployerData() {
    $.ajax({
        url: getEmployerDataRoute,
        type: "GET",
        data: {
            _token: token,
            employer_id: employerId,
        },
        dataType: "json",
        success: function (response) {
            if (response.success == false) {
                return console.log(response.message);
            }
            const data = response.data;
            const jobType = response.job_type;

            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            const location = `Brgy. ${data.barangay ?? ""}, ${data.city ?? ""}`;

            $("[name='full_name']").text(fullName);
            $("[name='comp_name']").text(
                data.comp_name ? data.comp_name : "----"
            );
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(location);
            $("[name='job_type']").text(jobType);

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

function getPostedJobs() {
    $.ajax({
        type: "GET",
        url: getPostedJobsRoute,
        data: {
            employer_id: employerId,
        },
        dataType: "json",
        success: function (response) {
            const jobs = response.data;

            $("#posted-jobs-container").empty();

            if (!jobs) {
                return;
            }

            jobs.forEach((data) => {
                const jobType = data.job_types[0].job_type;

                const fullName = `${data.employer.first_name} ${
                    data.employer.mid_name ?? ""
                } ${data.employer.last_name} ${data.employer.suffix ?? ""}`;

                const profilePic = data.employer.profile_pic
                    ? `/storage/${data.employer.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const viewJob = `/job-seeker/job/view/${data.job_id}`;

                const datePosted = data.created_at.split(" ")[0];
                const posted = new Date(datePosted);
                const formatted = posted.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const salary = parseFloat(data.expected_salary);
                const formatSalary = salary.toLocaleString("en-PH", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
                const salaryBasis = data.salary_basis;

                const template = `
                  <a href="${viewJob}" class="block w-full bg-white border border-gray-300 rounded-xl shadow hover:shadow-md transition-shadow duration-200 mb-2 overflow-hidden group">
                    <div class="flex items-center gap-4 p-4 border-b border-gray-200 bg-gray-50">
                        <img src="${profilePic}" alt="Company Logo"
                            class="w-16 h-16 object-cover rounded-lg shadow bg-white flex-shrink-0">
                        <div class="flex flex-col">
                            <span class="text-sky-800 font-semibold text-base leading-tight">${
                                data.employer.comp_name
                                    ? data.employer.comp_name
                                    : "----"
                            }</span>
                            <span class="text-gray-800 font-medium text-sm">${fullName}</span>
                            <span class="text-xs text-gray-500 mt-1">Posted: ${formatted}</span>
                        </div>

                    </div>
                    <div class="flex items-center justify-between mx-2 mt-2">
                        <span class="p-4 text-sm text-gray-600">${jobType}</span>
                        <span class="px-2 rounded text-[12px] text-gray-800">${
                            data.hired_applicant
                        } out of ${data.max_applicant} Hired</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-sky-800 mb-1 group-hover:underline">${
                            data.title
                        }</h3>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-map-pin mr-1">
                                <path d="M12 21s8-7.58 8-11.5A8 8 0 0 0 4 9.5C4 13.42 12 21 12 21z"/>
                                <circle cx="12" cy="9.5" r="3"/>
                            </svg>
                            <span>${data.location}</span>
                        </div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mt-2">
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 font-semibold rounded-full">${
                                data.employment_type
                            }</span>
                            <span class=" text-sky-700 text-xs px-3 py-1 font-semibold rounded-full">₱${formatSalary} / ${salaryBasis}</span>
                        </div>
                    </div>
                </a>
          `;

                $("#posted-jobs-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function followEmployer() {
    $("#follow-button").on("click", function (e) {
        e.preventDefault();

        const $btn = $(this);
        $btn.prop("disabled", true);

        $.ajax({
            type: "post",
            url: followEmployerRoute,
            data: {
                _token: token,
                employer_id: employerId,
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
        type: "GET",
        url: checkFollowStatusRoute,
        data: {
            employer_id: employerId,
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

function reportEmployer() {
    $("#report-button").on("click", function (e) {
        e.preventDefault();
        $("#report-modal").fadeIn();

        $("#report-form")
            .off("submit")
            .on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: reportEmployerRoute,
                    data: {
                        _token: token,
                        employer_id: employerId,
                        title: $("#report-title").val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success == false) {
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
    getEmployerData();
    getPostedJobs();
    followEmployer();
    checkFollowStatus();
    reportEmployer();
});

const urlParts = window.location.pathname.split("/");
const jobId = urlParts[urlParts.length - 1];
let employerId;

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

function getJobDetails() {
    $.ajax({
        type: "GET",
        url: getJobDataRoute,
        data: {
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;
            employerId = data.employer_id;
            const jobType = response.job_type;
            getRelatedJobs(jobType);

            const profilePic = data.employer.profile_pic
                ? `/storage/${data.employer.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

            const fullName = `${data.employer.first_name} ${
                data.employer.mid_name ?? ""
            } ${data.employer.last_name} ${data.employer.suffix ?? ""}`;

            const tag = `<span>${fullName}</span> | <span
                            class="text-sky-800">${
                                data.employer.comp_name
                                    ? data.employer.comp_name
                                    : "----"
                            }</span>`;

            const datePosted = data.created_at.split(" ")[0];
            const posted = new Date(datePosted);
            const formatted = posted.toLocaleDateString("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            });

            const deadline = data.deadline_at.split(" ")[0];
            const deadlineDate = new Date(deadline);
            const formattedDeadline = deadlineDate.toLocaleDateString("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            });

            const jobPhoto = data.job_photo
                ? `/storage/${data.job_photo}`
                : defaultJobPhoto;

            const salary = parseFloat(data.expected_salary);
            const formatSalary = salary.toLocaleString("en-PH", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            const salaryBasis = data.salary_basis;

            $("[name='profile_pic']").attr("src", profilePic);
            $("[name='tag_name']").append(tag);
            $("[name='created_at']").text(formatted);
            $("[name='deadline_at']").text(formattedDeadline);
            $("[name='job_photo']").attr("src", jobPhoto);
            $("[name='salary']").text(`₱${formatSalary} / ${salaryBasis}`);
            $("[name='location']").text(data.location);
            $("[name='job_type']").text(jobType);

            map(data.latitude, data.longitude, data.location);

            $.each(data, function (key, value) {
                if (
                    [
                        "employer_id",
                        "status",
                        "created_at",
                        "deadline_at",
                    ].includes(key)
                )
                    return;
                const $target = $(`[name='${key}']`);

                if ($target.is("span, p")) {
                    $target.text(value ?? "N/A");
                } else {
                    return;
                }
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function getRelatedJobs(jobType) {
    $.ajax({
        type: "GET",
        url: getRelatedJobsRoute,
        data: {
            job_type: jobType,
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            const jobs = response.data;

            $("#related-jobs-container").empty();

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
                $("#related-jobs-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data: ", xhr);
        },
    });
}

function checkApplicationStatus() {
    $.ajax({
        type: "GET",
        url: checkApplicationStatusRoute,
        data: {
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            const isApplied = response.applied;
            const status = response.status;

            if (!isApplied) {
                $("#applied").addClass("hidden");
                $(".not-applied").removeClass("hidden");
                return;
            }

            const $applied = $("#applied").removeClass(
                "hidden text-yellow-600 text-sky-600 text-red-600 text-green-600"
            );
            let statusText = "Pending";
            let statusClass = "text-yellow-600 border border-yellow-600";

            switch (status) {
                case "accepted":
                    statusText = "Accepted";
                    statusClass = "text-sky-600 border border-sky-600";
                    break;
                case "rejected":
                    statusText = "Rejected";
                    statusClass = "text-red-600 border border-red-600";
                    break;
                case "interview":
                    statusText = "Interview";
                    statusClass = "text-green-600 border border-green-600";
                    break;
                case "pending":
                default:
                    statusText = "Pending";
                    statusClass = "text-yellow-600 border border-yellow-600";
                    break;
            }

            $(".not-applied").addClass("hidden");
            $applied.text(statusText).addClass(statusClass);
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function applyJob() {
    $("#apply-button").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: applyJobRoute,
            data: {
                _token: token,
                job_id: jobId,
                employer_id: employerId,
            },
            dataType: "json",
            success: function (response) {
                checkApplicationStatus();

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
                console.error("Failed to fetch data : ", xhr);
            },
        });
    });
}

function reportJob() {
    $("#report-button").on("click", function (e) {
        e.preventDefault();
        $("#report-modal").fadeIn();

        $("#report-form")
            .off("submit")
            .on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: reportJobRoute,
                    data: {
                        _token: token,
                        job_id: jobId,
                        title: $("#report-title").val(),
                    },
                    dataType: "json",
                    success: function (response) {
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
                        console.error("Failed to fetch data : ", xhr);
                    },
                });
                $("#report-modal").fadeOut();
            });
    });
}

$(function () {
    checkApplicationStatus();
    getJobDetails();
    applyJob();
    reportJob();
});

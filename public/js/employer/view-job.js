const urlParts = window.location.pathname.split("/");
const jobId = urlParts[urlParts.length - 1];

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

function getJobData() {
    $.ajax({
        type: "GET",
        url: getJobDataRoute,
        data: {
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;
            const jobType = response.job_type;

            const editJobRoute = `/employer/posted-job/edit-job/${jobId}`;

            let status = "Pending";
            let statusStyle = "text-yellow-800";

            switch (data.status) {
                case "pending":
                    status = "Pending";
                    statusStyle = "text-yellow-800";
                    break;

                case "accepted":
                    status = "Accepted";
                    statusStyle = "text-sky-800";
                    break;

                case "rejected":
                    status = "Rejected";
                    statusStyle = "text-red-800";
                    break;

                case "restricted":
                    status = "Restricted";
                    statusStyle = "text-red-800";
                    break;

                default:
                    status = "Pending";
                    statusStyle = "text-yellow-800";
                    break;
            }

            const profilePic = data.employer.profile_pic
                ? `/storage/${data.employer.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

            const fullName = `${data.employer.first_name} ${
                data.employer.mid_name ?? ""
            } ${data.employer.last_name} ${data.employer.suffix ?? ""}`;

            const tag = `<span>${fullName}</span> | <span
                            class="text-sky-800">${data.employer.comp_name}</span>`;

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

            $("[name='status']").text(status).addClass(statusStyle);
            $("[name='profile_pic']").attr("src", profilePic);
            $("[name='tag_name']").append(tag);
            $("[name='created_at']").text(formatted);
            $("[name='deadline_at']").text(formattedDeadline);
            $("[name='job_photo']").attr("src", jobPhoto);
            $("[name='job_type']").text(jobType);
            $("[name='salary']").text(`₱${formatSalary} / ${salaryBasis}`);
            $("[name='location']").text(data.location);

            const buttonContainer = `
            <a href="${editJobRoute}"
            class="w-full py-1 px-5 font-semibold tracking-wide border align-middle transition duration-500 ease-in-out text-base text-center rounded-md hover:bg-sky-700 border-sky-600 hover:border-sky-700 text-gray-700 hover:text-white md:ms-2 cursor-pointer">Edit Job
            </a>
            `;

            $("#edit-button-container").append(buttonContainer);

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
            console.error("Failed to fetch data : ", xhr.responseText);
        },
    });
}

function deleteJob() {
    $("#delete-job").on("click", function (e) {
        e.preventDefault();

        $("#delete-modal").fadeIn();

        $("#confirm-delete").on("click", function (e) {
            e.preventDefault();

            $("#delete-modal").fadeOut();
            $.ajax({
                type: "POST",
                url: deleteJobRoute,
                data: {
                    _token: token,
                    job_id: jobId,
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);

                    window.location.href = goBackRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data : ", xhr);
                },
            });
        });
    });
}

$(function () {
    getJobData();
    deleteJob();
});

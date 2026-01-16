const urlParts = window.location.pathname.split("/");
const jobId = urlParts[urlParts.length - 1];

let employerID = "";
let jobTitle = "";

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

    //approve job
    $("#approve-button").on("click", function (e) {
        e.preventDefault();
        is_approve = true;
        $("#approve-modal").fadeIn();

        $("#confirm-approve").on("click", function () {
            $("#approve-modal").fadeOut();
            console.log(is_approve);

            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    job_id: jobId,
                    employer_id: employerID,
                    is_approved: is_approve,
                    job_title: jobTitle,
                    title: "Job notice",
                    content: `Congratulation! Your job "${jobTitle}" has been approved by the admin.`,
                },
                dataType: "json",
                success: function (response) {
                    message(
                        "bg-green-100 text-green-700",
                        "Approval Status",
                        response.message
                    );
                    window.location.href = pageRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                },
            });
        });
    });

    //decline job
    $("#decline-button").on("click", function (e) {
        e.preventDefault();
        is_approve = false;
        $("#message-modal").fadeIn();

        $("#message-modal").on("submit", function (e) {
            e.preventDefault();
            console.log(is_approve);

            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    job_id: jobId,
                    employer_id: employerID,
                    is_approved: is_approve,
                    title: $("[name='title']").val(),
                    content: $("[name='content']").val(),
                },
                dataType: "json",
                success: function (response) {
                    message(
                        "bg-green-100 text-green-700",
                        "Decline Status",
                        response.message
                    );
                    $("#message-modal").fadeOut();
                    window.location.href = pageRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                },
            });
        });
    });
}

function viewJob() {
    $.ajax({
        type: "GET",
        url: getJobRoute,
        data: {
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const jobData = response.data;
            const jobTypes = response.job_types ?? [];
            const employerData = response.data.employer;
            employerID = employerData.employer_id;
            jobTitle = jobData.title;

            const fullName = `${employerData.first_name ?? ""} ${
                employerData.mid_name ?? ""
            } ${employerData.last_name ?? ""} ${employerData.suffix ?? ""}`;

            const datePosted = jobData.created_at.split(" ")[0];
            const posted = new Date(datePosted);
            const formatted = posted.toLocaleDateString("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            });

            const deadline = jobData.deadline_at.split(" ")[0];
            const deadlineDate = new Date(deadline);
            const formattedDeadline = deadlineDate.toLocaleDateString("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            });

            const profilePic = employerData.profile_pic
                ? `/storage/${employerData.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

            const jobPhoto = jobData.job_photo
                ? `/storage/${jobData.job_photo}`
                : defaultJobPhoto;

            const salary = parseFloat(jobData.expected_salary);
            const formatSalary = salary.toLocaleString("en-PH", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            const salaryBasis = jobData.salary_basis;

            $("[name='tag_name']").append(
                `<span class="font-semibold">${fullName}</span> | <span class="text-sky-800 font-semibold">${employerData.comp_name}</span>`
            );
            $("[name='date_posted']").text(formatted);
            $("[name='deadline']").text(formattedDeadline);
            $('[name="profile_pic"]').attr("src", profilePic);
            $('[name="job_photo"]').attr("src", jobPhoto);
            $('[name="salary"]').text(`₱${formatSalary} / ${salaryBasis}`);
            $('[name="job_type"]').text(jobTypes);

            $.each(jobData, function (key, value) {
                if (["job_id", "employer_id", "job_photo"].includes(key))
                    return;
                const $target = $(`[name="${key}"]`);

                try {
                    if (key === "title") {
                        $("[name='job_title']").text(value);
                        return;
                    }

                    if (key === "hired_applicant") {
                        $("[name='hired_applicant']").text(value ?? "0");
                        return;
                    }

                    $target.text(value ? value : "N/A");
                } catch (error) {
                    console.log(error);
                }
            });
            map(jobData.latitude, jobData.longitude, jobData.location);
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

$(function () {
    viewJob();
    approval();
});

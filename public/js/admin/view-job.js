const urlParts = window.location.pathname.split("/");
const jobId = urlParts[urlParts.length - 1];
let employerID = "";

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

function viewJob() {
    $.ajax({
        url: getJobRoute,
        type: "GET",
        data: {
            _token: token,
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const jobData = response.data;
            const jobType = response.job_type;
            const employerData = response.data.employer;
            employerID = employerData.employer_id;

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
            $('[name="job_photo"] img').attr("src", jobPhoto);
            $('[name="salary"]').text(`₱${formatSalary} / ${salaryBasis}`);
            $('[name="job_type"]').text(jobType);

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
                        employer_id: employerID,
                        job_id: jobId,
                        title: $("select[name='title']").val(),
                        content: $("textarea[name='content']").val(),
                        is_warning: is_warning,
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#message-modal").fadeOut();

                        if (response.success !== true) {
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
                $("#message-modal").fadeOut();
            });
    });

    //restrict a user
    $("#restrict-button").on("click", function (e) {
        e.preventDefault();
        $("#restrict-modal").fadeIn();
        let is_warning = false;
        const jobTitle = $("[name='job_title']").text();

        $("#confirm-restrict")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();

                $.ajax({
                    url: sendMessageRoute,
                    type: "POST",
                    data: {
                        _token: token,
                        employer_id: employerID,
                        job_id: jobId,
                        title: "Restricted Job",
                        content: `Your job "${jobTitle}" has been restricted due to violation of our terms and conditions.`,
                        is_warning: is_warning,
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        window.location.href = pageRoute;
                    },
                    error: function (xhr) {
                        console.error("Failed to restrict user:", xhr);
                    },
                });

                $("#restrict-modal").fadeOut();
            });
    });
}

$(function () {
    viewJob();
    downloadPermit();
    sendMessage();
});

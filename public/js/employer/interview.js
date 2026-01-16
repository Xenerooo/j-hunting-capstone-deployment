let selectedInterviewId = null;

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function getInterviewDetails(interviewId) {
    $.ajax({
        type: "GET",
        url: getInterviewDetailsRoute,
        data: {
            interview_id: interviewId,
        },
        dataType: "json",
        success: function (response) {
            console.log(response);

            const data = response.data;

            if (data.status) {
                $("[name='status']").prop("checked", false);
                $("[name='status'][value='" + data.status + "']").prop(
                    "checked",
                    true
                );
            }

            $("[name='interview_date']").val(data.interview_date);
            $("[name='mode']").val(data.mode);
            $("[name='detail']").val(data.detail);
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function viewDetails(interviewId) {
    selectedInterviewId = interviewId;
    getInterviewDetails(selectedInterviewId);
    checkChanges();

    $("#interview-details-modal").fadeIn();

    $("#interview-details-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: updateInterviewDetailsRoute,
            data: {
                _token: token,
                interview_id: selectedInterviewId,
                status: $("[name='status']:checked").val(),
                interview_date: $("[name='interview_date']").val(),
                mode: $("[name='mode']").val(),
                detail: $("[name='detail']").val(),
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                if (response.success == false) {
                    return message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Success",
                        response.message,
                        5000
                    );
                }

                getInterviews("", "", "");
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
        searchInterview();
        $("#interview-details-modal").fadeOut();
    });
}

function checkChanges() {
    const $form = $("#interview-details-form");
    if (!$form.length) return;

    const $statusRadios = $form.find('[name="status"]');
    const $interviewDate = $form.find('[name="interview_date"]');
    const $modeSelect = $form.find('[name="mode"]');
    const $detailInput = $form.find('[name="detail"]');
    const $updateBtn = $form.find("#update-schedule");

    const getFormValues = () => ({
        status: $statusRadios.filter(":checked").val() || "",
        interview_date: $interviewDate.val(),
        mode: $modeSelect.val(),
        detail: $detailInput.val(),
    });

    const initialValues = getFormValues();

    const hasChanged = () => {
        const current = getFormValues();
        return (
            current.status !== initialValues.status ||
            current.interview_date !== initialValues.interview_date ||
            current.mode !== initialValues.mode ||
            current.detail !== initialValues.detail
        );
    };

    const updateButtonState = () => {
        const changed = hasChanged();
        $updateBtn.prop("disabled", !changed);

        $updateBtn.removeClass("bg-sky-800 bg-gray-400 hover:bg-sky-700");
        if (changed) {
            $updateBtn.addClass("bg-sky-800 hover:bg-sky-700");
        } else {
            $updateBtn.addClass("bg-gray-400");
        }
    };

    $form.on(
        "change input",
        'input[name="status"], input[name="interview_date"], select[name="mode"], input[name="detail"]',
        updateButtonState
    );

    $updateBtn.prop("disabled", true);
    $updateBtn
        .removeClass("bg-sky-800 hover:bg-sky-700")
        .addClass("bg-gray-400");
}

function getInterviews(searchQuery = "", sortBy = "all", sortByDate = "") {
    $.ajax({
        type: "GET",
        url: getInterviewRoute,
        data: {
            search: searchQuery,
            sort: sortBy,
            sort_date: sortByDate,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;

            $("#interview-container").empty();

            if (!data.length) {
                $("#interview-container").html(
                    `<div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No interviews scheduled</h3>
                            <p class="text-gray-600">Try adjusting your search criteria or check back later for new interview schedules.</p>
                        </div>
                    </div>`
                );

                return;
            }

            data.forEach((data) => {
                const viewJob = `/employer/job-application/job/view/${data.job_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`;

                const interviewAt = data.interview_date;
                const interviewDate = new Date(interviewAt);
                const formatted = interviewDate.toLocaleString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: true,
                });

                let status = "Pending";
                let statusStyle =
                    "bg-amber-100 text-amber-800 border-amber-200";
                let statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12,6 12,12 16,14" />
                </svg>`;

                let completedStyle = null;
                let completedStyle1 = null;
                let completedDisabled = "";
                if (data.status === "completed") {
                    completedStyle =
                        "text-green-700 hover:text-white hover:bg-green-600 border-green-300 hover:border-green-600";
                    completedStyle1 =
                        "text-red-700 hover:text-white hover:bg-red-600 border-red-300 hover:border-red-600";
                    completedDisabled = "";
                } else if (data.status === "missed") {
                    completedStyle =
                        "hidden text-green-700 hover:text-white hover:bg-green-600 border-green-300 hover:border-green-600";
                    completedStyle1 =
                        "text-red-700 hover:text-white hover:bg-red-600 border-red-300 hover:border-red-600";
                    completedDisabled = "";
                } else {
                    completedStyle =
                        "text-gray-400 bg-gray-100 border-gray-200 cursor-not-allowed";
                    completedStyle1 =
                        "text-gray-400 bg-gray-100 border-gray-200 cursor-not-allowed";
                    completedDisabled = "disabled";
                }

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
                    case "completed":
                        status = "Completed";
                        statusStyle =
                            "bg-emerald-100 text-emerald-800 border-emerald-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22,4 12,14.01 9,11.01" />
                        </svg>`;
                        break;
                    case "missed":
                        status = "Missed";
                        statusStyle = "bg-red-100 text-red-800 border-red-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
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

                const template = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <!-- Header with Applicant Info -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="relative">
                                <img class="w-16 h-16 rounded-xl object-cover border-2 border-gray-100 shadow-sm"
                                    src="${profilePic}" alt="Applicant Photo">
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-sky-500 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-2">${fullName}</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        Brgy. ${data.barangay}, ${data.city}
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg>
                                        ${data.job_type}
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600">Scheduled on <span class="font-semibold">${formatted}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Job Title and Status -->
                    <div class="p-6">
                        <div class="mb-4">
                            <a href="${viewJob}" class="text-lg font-semibold text-sky-800 hover:text-sky-600 transition-colors duration-200 line-clamp-2" title="View job details">
                                ${data.title}
                            </a>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${statusStyle}">
                                    ${statusIcon}
                                    <span class="ml-1">${status}</span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <button class="view-details w-full flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md"
                                data-interview-id="${data.interview_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                View Details
                            </button>
                            <div class="flex space-x-2">
                                <button class="accept-applicant flex-1 flex items-center justify-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200 ${completedStyle}" ${completedDisabled} data-seeker-id="${data.seeker_id}" data-job-id="${data.job_id}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                        <polyline points="22,4 12,14.01 9,11.01" />
                                    </svg>
                                    Accept
                                </button>
                                <button class="reject-applicant flex-1 flex items-center justify-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200 ${completedStyle1}" ${completedDisabled} data-seeker-id="${data.seeker_id}" data-job-id="${data.job_id}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>
                                    Reject
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $("#interview-container").append(template);
            });

            $(".view-details")
                .off("click")
                .on("click", function () {
                    const interviewId = $(this).data("interview-id");
                    viewDetails(interviewId);
                });

            $(".accept-applicant")
                .off("click")
                .on("click", function () {
                    $("#modal_icon").empty();
                    const jobId = $(this).data("job-id");
                    const seekerId = $(this).data("seeker-id");
                    const isAccepted = true;
                    const modalHeader =
                        $("#modal_header").text("Accept Applicant");
                    const modalIcon = $("#modal_icon")
                        .append(`<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22,4 12,14.01 9,11.01" />
                    </svg>`);
                    const modalMessage = $("#modal_message").text(
                        "Do you want to proceed with accepting this applicant?"
                    );
                    const buttonAppearance = $("#confirm-update-applicant")
                        .removeClass("bg-red-600 hover:bg-red-700")
                        .addClass("bg-green-600 hover:bg-green-700")
                        .text("Accept Applicant");

                    changeApplicantStatus(
                        isAccepted,
                        jobId,
                        seekerId,
                        modalHeader,
                        modalIcon,
                        modalMessage,
                        buttonAppearance
                    );
                });

            $(".reject-applicant")
                .off("click")
                .on("click", function () {
                    $("#modal_icon").empty();
                    const jobId = $(this).data("job-id");
                    const seekerId = $(this).data("seeker-id");
                    const isAccepted = false;
                    const modalHeader =
                        $("#modal_header").text("Reject Applicant");
                    const modalIcon = $("#modal_icon")
                        .append(`<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                        <line x1="9" y1="9" x2="15" y2="15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <line x1="15" y1="9" x2="9" y2="15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>`);
                    const modalMessage = $("#modal_message").text(
                        "Do you want to proceed with rejecting this applicant?"
                    );
                    const buttonAppearance = $("#confirm-update-applicant")
                        .removeClass("bg-green-600 hover:bg-green-700")
                        .addClass("bg-red-600 hover:bg-red-700")
                        .text("Reject Applicant");

                    changeApplicantStatus(
                        isAccepted,
                        jobId,
                        seekerId,
                        modalHeader,
                        modalIcon,
                        modalMessage,
                        buttonAppearance
                    );
                });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function searchInterview() {
    let currentSort = "all";
    let sortDate = "";
    getInterviews("", currentSort, "");

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getInterviews(search, currentSort, sortDate);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getInterviews(currentSearch, currentSort, sortDate);
    });

    $("#sort_date").on("change", function () {
        sortDate = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getInterviews(currentSearch, currentSort, sortDate);
    });
}

function changeApplicantStatus(isAccepted, jobId, seekerId) {
    $("#update-applicant-modal").fadeIn();

    $("#confirm-update-applicant").on("click", function (e) {
        e.preventDefault();

        console.log(isAccepted + " " + jobId + " " + seekerId);
        $.ajax({
            type: "POST",
            url: changeApplicantStatusRoute,
            data: {
                _token: token,
                seeker_id: seekerId,
                job_id: jobId,
                is_accepted: isAccepted,
            },
            dataType: "json",
            success: function (response) {
                getInterviews("", "", "");
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
        $("#update-applicant-modal").fadeOut();
    });
}

$(function () {
    searchInterview();
});

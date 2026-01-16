function getApplication(searchQry = "", sortBy = "all") {
    $.ajax({
        url: getApplicationRoute,
        type: "GET",
        data: {
            search: searchQry,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const data = response.applicants;

            $("#application-container").empty();

            if (!data) {
                $("#application-container").html(
                    `<div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No applications found</h3>
                            <p class="text-gray-600">Try adjusting your search criteria or check back later for new applications.</p>
                        </div>
                    </div>`
                );

                return;
            }

            data.forEach((data) => {
                const viewSeeker = `/employer/job-application/job-seeker/view/seeker_id=${data.seeker_id}/job_id=${data.job_id}`;
                const viewJob = `/employer/job-application/job/view/${data.job_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`;

                const appliedAt = data.applied_at.split(" ")[0];
                const appliedDate = new Date(appliedAt);
                const formatted = appliedDate.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                let status = "Pending";
                let statusStyle =
                    "bg-amber-100 text-amber-800 border-amber-200";
                let statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12,6 12,12 16,14" />
                </svg>`;

                let rejectedStyle = null;
                let rejectedDisabled = "";
                if (data.status === "rejected") {
                    rejectedStyle =
                        "text-red-700 hover:text-white hover:bg-red-600 border-red-300 hover:border-red-600";
                    rejectedDisabled = "";
                } else {
                    rejectedStyle =
                        "text-gray-400 bg-gray-100 border-gray-200 cursor-not-allowed";
                    rejectedDisabled = "disabled";
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
                    case "interview":
                        status = "Interview";
                        statusStyle =
                            "bg-blue-100 text-blue-800 border-blue-200";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full max-h-[350px]">
                    <!-- Header with Applicant Info -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="relative">
                                <img class="w-16 h-16 rounded-xl object-cover border-2 border-gray-100 shadow-sm"
                                    src="${profilePic}" alt="Applicant Photo">
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-sky-500 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
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
                                </div>
                                <p class="text-sm text-gray-600">Applied on ${formatted}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Job Title and Status -->
                    <div class="flex flex-col flex-1 p-6">
                        <div class="mb-4 min-h-[48px] flex items-center">
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
                        
                        <div class="flex space-x-3 mt-auto">
                            <a href="${viewSeeker}"
                                class="flex-1 flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                View Profile
                            </a>
                            <button class="delete-applicant-button flex-1 flex items-center justify-center px-4 py-2.5 border rounded-lg text-sm font-medium transition-all duration-200 ${rejectedStyle}" ${rejectedDisabled} data-seeker-id="${data.seeker_id}" data-job-id="${data.job_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3,6 5,6 21,6" />
                                    <path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                `;

                $("#application-container").append(template);
            });

            $(".delete-applicant-button")
                .off("click")
                .on("click", function () {
                    const seekerId = $(this).data("seeker-id");
                    const jobId = $(this).data("job-id");
                    deleteApplicant(seekerId, jobId);
                });
        },
        error: function (xhr) {
            console.log("Failed to fetch data : ", xhr.responseText);
        },
    });
}

function searchApplicant() {
    let currentSort = "all";
    getApplication("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getApplication(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getApplication(currentSearch, currentSort);
    });
}

function deleteApplicant(seekerId, jobId) {
    if (!seekerId) {
        alert("Invalid job seeker ID.");
        return;
    }
    $("#delete-applicant-modal").fadeIn();

    $("#confirm-delete-applicant").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: deleteApplicantRoute,
            data: {
                _token: token,
                seeker_id: seekerId,
                job_id: jobId,
            },
            dataType: "json",
            success: function (response) {
                getApplication("", "");
            },
            error: function (xhr) {
                console.log("Failed to fetch data : ", xhr.responseText);
            },
        });

        $("#delete-applicant-modal").fadeOut();
    });
}

$(function () {
    searchApplicant();
});

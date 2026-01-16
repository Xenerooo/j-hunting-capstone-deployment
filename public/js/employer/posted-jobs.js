function getPostedJobs(searchQuery = "", sortBy = "all") {
    $.ajax({
        url: postedJobsRoute,
        type: "GET",
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const job = response.data;

            $("#posted-container").empty();

            if (!job.length) {
                $("#posted-container").html(
                    `<div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 12h.01" />
                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                <rect width="20" height="14" x="2" y="6" rx="2" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No jobs found</h3>
                            <p class="text-gray-600">Try adjusting your search criteria or create a new job posting.</p>
                        </div>
                    </div>`
                );
            }

            job.forEach((data) => {
                const viewJob = `/employer/posted-jobs/view/${data.job_id}`;
                const editJob = `/employer/posted-job/edit-job/${data.job_id}`;

                const profilePic = data.employer.profile_pic
                    ? `/storage/${data.employer.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const fullName = `${data.employer.first_name} ${
                    data.employer.mid_name ?? ""
                } ${data.employer.last_name} ${data.employer.suffix ?? ""}`;

                const tag = `<span>${fullName}</span> | <span
                                    class="text-sky-800">${data.employer.comp_name}</span>`;

                const deadlineAt = data.deadline_at;
                const deadlineDate = new Date(deadlineAt);
                const formatted = deadlineDate.toLocaleDateString("en-US", {
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
                const jobTypeBadges =
                    Array.isArray(data.job_types) && data.job_types.length
                        ? data.job_types
                              .map(
                                  (t) =>
                                      `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-sky-700 border border-blue-200 mr-1 mb-1">${t}</span>`
                              )
                              .join("")
                        : data.job_type
                        ? `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 mr-1 mb-1">${data.job_type}</span>`
                        : "";

                const template = `
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group min-h-[300px] flex flex-col">
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex items-start space-x-4">
                                    <div class="relative">
                                        <img class="w-16 h-16 rounded-xl object-cover border-2 border-gray-100 shadow-sm"
                                            src="${profilePic}" alt="Company Logo">
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-sky-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 12h.01" />
                                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                <rect width="20" height="14" x="2" y="6" rx="2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-2">${
                                            data.title
                                        }</h3>
                                        <p class="text-sm text-gray-600 mb-2">${
                                            data.employer.comp_name ?? "----"
                                        }</p>
                                        <div class="flex flex-col items-start space-x-4 text-xs text-gray-500">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                    <circle cx="12" cy="10" r="3" />
                                                </svg>
                                                ${data.location}
                                            </div>
                                            <div class="flex items-center flex-wrap">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12h.01" />
                                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                                </svg>
                                                ${jobTypeBadges}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 justify-end">
                                <div class="mt-auto p-6 flex flex-col h-full">
                                    <div class="flex items-end justify-between mt-auto mb-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border ${statusStyle}">
                                            ${statusIcon}
                                            <span class="ml-1">${status}</span>
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border bg-sky-100 text-sky-800 border-sky-200 ml-2">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12h.01" />
                                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                                </svg>
                                                ${formatted}
                                            </div>
                                        </span>
                                    </div>
                                    <div class="flex space-x-3 mt-auto">
                                        <a href="${editJob}"
                                            class="flex-1 flex items-center justify-center px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="${viewJob}"
                                            class="flex-1 flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                `;

                $("#posted-container").append(template);
            });
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
}

function searchJob() {
    let currentSort = "all";

    getPostedJobs("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getPostedJobs(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getPostedJobs(currentSearch, currentSort);
    });
}

$(function () {
    searchJob();
});

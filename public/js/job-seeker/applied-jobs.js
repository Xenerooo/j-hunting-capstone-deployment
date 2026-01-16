let employerID = null;

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").removeClass().addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function getApplied(searchQry = "", sortBy = "all") {
    $.ajax({
        type: "GET",
        url: getAppliedRoute,
        data: {
            search: searchQry,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const applied = response.data;

            $("#applied-container").empty();

            if (!applied || !applied.length) {
                $("#applied-container").html(
                    `<div class="flex items-center justify-center mt-20 mx-auto">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">No results found.</span>
                        </div>
                    </div>`
                );
                return;
            }

            applied.forEach((data) => {
                employerID = data.employer_id;
                const viewEmployer = `/job-seeker/employer/view/${data.employer_id}`;
                const viewJob = `/job-seeker/job/view/${data.job_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`;

                const appliedAt = data.applied_at.split(" ")[0];
                const applyDate = new Date(appliedAt);
                const formatted = applyDate.toLocaleDateString("en-US", {
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

                let style = "";
                let text = "";

                switch (data.status) {
                    case "pending":
                        style = "bg-yellow-500 text-white";
                        text = "Pending";
                        break;
                    case "accepted":
                        style = "bg-green-500 text-white";
                        text = "Accepted";
                        break;
                    case "rejected":
                        style = "bg-red-500 text-white";
                        text = "Rejected";
                        break;
                    case "interview":
                        style = "bg-blue-500 text-white";
                        text = "Interview";
                        break;
                    default:
                        style = "bg-gray-200 text-gray-700";
                        text =
                            data.status.charAt(0).toUpperCase() +
                            data.status.slice(1);
                        break;
                }

                const template = `
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                            <div class="p-4 md:p-5">
                                <div class="flex items-start space-x-4">
                                    <div class="relative flex items-center">
                                        <img class="w-20 h-20 md:w-14 md:h-14 rounded-xl object-cover border-2 border-gray-100 shadow-sm" src="${profilePic}" alt="Profile">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="javascript:void(0);" data-employer-id="${data.employer_id}" class="view-employer text-sm md:text-base font-bold text-gray-900 hover:text-gray-700 block truncate">${fullName}</a>
                                        <a href="${viewJob}" class="text-xs md:text-sm text-sky-700 font-semibold hover:text-sky-600 block truncate">${data.title}</a>
                                        <div class="mt-3 grid grid-cols-2 lg:grid-cols-4 gap-2 text-xs text-gray-600">
                                            <div class="flex items-center">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full font-medium bg-yellow-600/10 text-yellow-700 border border-yellow-200">
                                                    ${data.employment_type}
                                                </span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12h.01" />
                                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                                </svg>
                                                <span>Applied: ${formatted}</span>
                                            </div>
                                            <div class="flex items-center text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 12h.01" />
                                                    <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                    <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                                </svg>
                                                <span>₱${formatSalary}/${salaryBasis}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                    <circle cx="12" cy="10" r="3" />
                                                </svg>
                                                <span class="truncate max-w-[180px] md:max-w-[260px]">${data.location}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-medium border ${style} text-white">${text}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                `;

                $("#applied-container").append(template);
            });
            navigateEmployer();
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function searchApplied() {
    let currentSort = "all";
    getApplied("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getApplied(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getApplied(currentSearch, currentSort);
    });
}

function navigateEmployer() {
    $(document).off("click", ".view-employer");
    $(document).on("click", ".view-employer", function (e) {
        e.preventDefault();
        const employerId = $(this).data("employer-id");
        $.ajax({
            url: `/job-seeker/employer/view/${employerId}`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.message) {
                    message(
                        "bg-sky-100 border-sky-500 text-sky-700",
                        "Access Denied",
                        response.message,
                        5000
                    );
                } else if (response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                    window.location.href = `/job-seeker/employer/view/${employerId}`;
                }
            },
            error: function (xhr) {
                let msg = "Unable to view employer information.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Access Denied",
                    msg,
                    5000
                );
            },
        });
    });
}

$(function () {
    searchApplied();
    navigateEmployer();
});

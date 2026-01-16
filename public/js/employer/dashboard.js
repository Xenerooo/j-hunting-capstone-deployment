function renderSummaryCards(summary) {
    const container = $("#summary_cards_container");
    if (!container.length) return;

    const cards = [
        {
            href:
                typeof postedJobsRoute !== "undefined" ? postedJobsRoute : "#",
            id: "posted_jobs",
            value: summary?.posted_jobs ?? 0,
            label: "Posted Jobs",
            ringBg: "bg-sky-50",
            ringBorder: "border-gray-200",
            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-check2-icon lucide-file-check-2 text-green-700"><path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" /><path d="M14 2v4a2 2 0 0 0 2 2h4" /><path d="m3 15 2 2 4-4" /></svg>',
        },
        {
            href:
                typeof applicantsRoute !== "undefined" ? applicantsRoute : "#",
            id: "applicants",
            value: summary?.applicants ?? 0,
            label: "Applicants",
            ringBg: "bg-orange-50",
            ringBorder: "border-gray-200",
            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-contact-round-icon lucide-contact-round text-orange-700"><path d="M16 2v2" /><path d="M17.915 22a6 6 0 0 0-12 0" /><path d="M8 2v2" /><circle cx="12" cy="12" r="4" /><rect x="3" y="4" width="18" height="18" rx="2" /></svg>',
        },
        {
            href:
                typeof notificationsRoute !== "undefined"
                    ? notificationsRoute
                    : "#",
            id: "notifications",
            value: summary?.notifications ?? 0,
            label: "Notifications",
            ringBg: "bg-purple-50",
            ringBorder: "border-gray-200",
            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-ring-icon lucide-bell-ring text-purple-700"><path d="M10.268 21a2 2 0 0 0 3.464 0" /><path d="M22 8c0-2.3-.8-4.3-2-6" /><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" /><path d="M4 2C2.8 3.7 2 5.7 2 8" /></svg>',
        },
    ];

    const html = cards
        .map(
            (c) =>
                `<a href="${c.href}" class="bg-white/80 backdrop-blur rounded-lg flex items-center justify-between p-4 ring-1 ring-slate-200 text-gray-800 group transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
                    <div class="flex justify-center items-center w-14 h-14 border ${c.ringBorder} ${c.ringBg} rounded-full transition-all duration-300 transform group-hover:rotate-6">
                        ${c.icon}
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-semibold leading-none" id="${c.id}">${c.value}</p>
                        <p class="text-sm text-gray-500 mt-1">${c.label}</p>
                    </div>
                </a>`
        )
        .join("");

    container.html(html);
}

function getSummary() {
    $.ajax({
        url: getSummaryRoute,
        type: "GET",
        dataType: "json",
        success: function (response) {
            renderSummaryCards(response);
            $("#posted_jobs").text(response.posted_jobs);
            $("#applicants").text(response.applicants);
            $("#notifications").text(response.notifications);
        },
        error: function (xhr) {
            console.error("Failed to fetch data:", xhr);
            renderSummaryCards({
                posted_jobs: 0,
                applicants: 0,
                notifications: 0,
            });
        },
    });
}

function getJobSeekers(searchText = "", jobType = "", location = "") {
    $.ajax({
        url: getJobSeekersRoute,
        type: "GET",
        data: {
            searchText: searchText,
            jobType: jobType,
            location: location,
        },
        dataType: "json",
        success: function (response) {
            const jobSeekers = response.data;
            $("#job_seekers_container").empty();

            if (!jobSeekers.length) {
                $("#job_seekers_container").html(
                    `<div class="flex items-center justify-center mt-20">
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Notice:</strong>
                            <span class="block sm:inline">No job seekers found. Please try adjusting your search or filters.</span>
                        </div>
                    </div>`
                );
                return;
            }

            jobSeekers.forEach((data) => {
                const jobTypes = data.job_types ?? [];
                const jobTypeCount = jobTypes.length;

                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`
                    .replace(/\s+/g, " ")
                    .trim();

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const dateJoined = data.created_at.split(" ")[0];
                const joined = new Date(dateJoined);
                const formatted = joined.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const viewSeeker = `/employer/job-seeker/view/${data.seeker_id}`;

                const template = `
                    <div class="p-2 relative bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 group">
                        <!-- Decorative blob background -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-tr from-sky-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 group-hover:opacity-30 transition-all duration-300"></div>
                        <div class="relative z-10 flex flex-col h-full">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="${profilePic}" alt="Profile Picture"
                                    class="object-cover w-16 h-16 rounded-xl border-2 border-sky-200 shadow-sm bg-white" />
                                <div>
                                    <p class="text-lg font-bold text-gray-900 leading-tight">${fullName}</p>
                                    <p class="text-xs text-gray-500 mt-1">Joined: <span class="font-medium">${formatted}</span></p>
                                </div>
                            </div>
                           <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-1 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7V6a2 2 0 012-2h8a2 2 0 012 2v1" />
                                    <rect x="3" y="7" width="18" height="14" rx="2" stroke-width="2" stroke="currentColor" fill="none"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V9a4 4 0 0 0-8 0v2" />
                                </svg>
                                <span>Job Seeker has <strong>${jobTypeCount}</strong> job types</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-1 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Brgy. ${data.barangay}, ${data.city}</span>
                            </div>
                            <div class="flex-1"></div>
                            <div class="mt-4 flex">
                                <a href="${viewSeeker}"
                                    class="flex-1 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 text-white font-semibold text-sm py-2 px-4 text-center shadow-md hover:from-sky-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                $("#job_seekers_container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data:", xhr);
        },
    });
}

function searchJobSeekers() {
    let currentLocation = "all_location";

    getJobSeekers("", "", currentLocation);

    $("#search_button").on("click", function () {
        const searchText = $("#search_text").val().trim();
        const jobType = $("#job_type_select").val().trim();
        currentLocation = $("#location_select").val().trim();

        getJobSeekers(searchText, jobType, currentLocation);
    });
}

$(function () {
    renderSummaryCards({ posted_jobs: 0, applicants: 0, notifications: 0 });
    getSummary();
    searchJobSeekers();
});

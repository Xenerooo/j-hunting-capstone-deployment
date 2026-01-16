function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function getFeatured(searchQry, jobType, location, isInitial = false) {
    $.ajax({
        type: "GET",
        url: getFeaturedRoute,
        data: {
            search: searchQry,
            job_type: jobType,
            location: location,
            initial: isInitial,
        },
        dataType: "json",
        success: function (response) {
            const employers = response.employers;
            const jobs = response.jobs;

            $("#employers-container").empty();
            if (!employers.length) {
                $("#employers-container").html(
                    `<div class="flex items-center justify-center mt-20">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">No results found.</span>
                        </div>
                </div>`
                );
            }

            $("#jobs-container").empty();
            if (!jobs.length) {
                $("#jobs-container").html(
                    `<div class="flex items-center justify-center mt-20">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">No results found.</span>
                    </div>
                </div>`
                );
            }

            employers.forEach((emp) => {
                const fullName = `${emp.first_name} ${emp.mid_name ?? ""} ${
                    emp.last_name
                } ${emp.suffix ?? ""}`;

                const viewEmployer = `/job-seeker/employer/view/${emp.employer_id}`;

                const profilePic = emp.profile_pic
                    ? `/storage/${emp.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const template = `
                <a href="${viewEmployer}"
                    class="flex-row w-full h-fit shadow rounded p-2 bg-white hover:bg-gray-100 cursor-pointer border border-gray-300">
                    <div class="flex p-2 items-center">
                        <img src="${profilePic}"
                            class="object-cover w-[80px] h-[80px] shadow-lg rounded-xl overflow-hidden mr-5"
                            alt="">
                        
                        <div>
                            <p class="text-md text-sky-800 font-semibold">${
                                emp.comp_name ? emp.comp_name : "----"
                            }</p>
                            <p class="text-sm text-gray-800 font-semibold">${fullName}</p>
                            <span class="text-xs text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-map-pinned-icon lucide-map-pinned">
                                    <path
                                        d="M18 8c0 3.613-3.869 7.429-5.393 8.795a1 1 0 0 1-1.214 0C9.87 15.429 6 11.613 6 8a6 6 0 0 1 12 0" />
                                    <circle cx="12" cy="8" r="2" />
                                    <path
                                        d="M8.714 14h-3.71a1 1 0 0 0-.948.683l-2.004 6A1 1 0 0 0 3 22h18a1 1 0 0 0 .948-1.316l-2-6a1 1 0 0 0-.949-.684h-3.712" />
                                </svg>
                                Brgy. ${emp.barangay}, ${emp.city}</span>
                        </div>
                    </div>
                </a>
                `;

                $("#employers-container").append(template);
            });

            jobs.forEach((job) => {
                const jobType = job.job_types;

                const fullName = `${job.employer.first_name} ${
                    job.employer.mid_name ?? ""
                } ${job.employer.last_name} ${job.employer.suffix ?? ""}`
                    .replace(/\s+/g, " ")
                    .trim();

                const profilePic = job.employer.profile_pic
                    ? `/storage/${job.employer.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const viewJob = `/job-seeker/job/view/${job.job_id}`;

                const datePosted = job.created_at.split(" ")[0];
                const posted = new Date(datePosted);
                const formatted = posted.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const salary = parseFloat(job.expected_salary);
                const formatSalary = salary.toLocaleString("en-PH", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
                const salaryBasis = job.salary_basis;

                const template = `
                <a href="${viewJob}" class="block w-full bg-white border border-gray-300 rounded-xl shadow hover:shadow-md transition-shadow duration-200 mb-2 overflow-hidden group">
                    <div class="flex items-center gap-4 p-4 border-b border-gray-200 bg-gray-50">
                        <img src="${profilePic}" alt="Company Logo"
                            class="w-16 h-16 object-cover rounded-lg shadow bg-white flex-shrink-0">
                        <div class="flex flex-col">
                            <span class="text-sky-800 font-semibold text-base leading-tight">${
                                job.employer.comp_name
                                    ? job.employer.comp_name
                                    : "----"
                            }</span>
                            <span class="text-gray-800 font-medium text-sm">${fullName}</span>
                            <span class="text-xs text-gray-500 mt-1">Posted: ${formatted}</span>
                        </div>

                    </div>
                    <div class="flex items-center justify-between mx-2 mt-2">
                        <span class="p-4 text-sm text-gray-600">${
                            jobType[0].job_type
                        }</span>
                        <span class="px-2 rounded text-[12px] text-gray-800">${
                            job.hired_applicant
                        } out of ${job.max_applicant} Hired</span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-sky-800 mb-1 group-hover:underline">${
                            job.title
                        }</h3>
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-map-pin mr-1">
                                <path d="M12 21s8-7.58 8-11.5A8 8 0 0 0 4 9.5C4 13.42 12 21 12 21z"/>
                                <circle cx="12" cy="9.5" r="3"/>
                            </svg>
                            <span>${job.location}</span>
                        </div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mt-2">
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 font-semibold rounded-full">${
                                job.employment_type
                            }</span>
                            <span class=" text-sky-700 text-xs px-3 py-1 font-semibold rounded-full">₱${formatSalary} / ${salaryBasis}</span>
                        </div>
                    </div>
                </a>
                `;

                $("#jobs-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function search() {
    getFeatured("", "", "", true);

    $("#search_button").on("click", function () {
        const searchText = $("#search_text").val().trim();
        const selectedJobType = $("#job_type_select").val().trim();
        const selectedLocation = $("#location_select").val().trim();

        getFeatured(searchText, selectedJobType, selectedLocation, false);
    });
}

$(function () {
    search();
});

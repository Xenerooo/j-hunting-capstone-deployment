function getJob(searchQuery = "", sortBy = "all") {
    $.ajax({
        url: getJobRoute,
        type: "GET",
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const jobsData = response.data;

            $("#table-body").empty();
            $("#message-container").empty();

            if (!jobsData.length) {
                $("#message-container").html(
                    `<div class="flex items-center justify-center mt-20">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">No results found.</span>
                    </div>
                </div>`
                );
            }

            jobsData.forEach((data) => {
                const jobTypes = data.job_types ?? [];
                const jobTypeName = jobTypes.length
                    ? jobTypes[0].job_type
                    : "'NOT FOUND'";

                const fullName = `${data.employer.first_name} ${
                    data.employer.mid_name ?? ""
                } ${data.employer.last_name} ${data.employer.suffix ?? ""}`;

                const profilePic = data.employer.profile_pic
                    ? `/storage/${data.employer.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const viewJob = `/admin/all-jobs/view/${data.job_id}`;

                const datePosted = data.created_at.split(" ")[0];
                const posted = new Date(datePosted);
                const formatted = posted.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const template = `
                  <tr class="bg-gray-100 border-b border-gray-200">
                      <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                              <img src="${profilePic}"
                                  alt=""
                                  class="w-[70px] h-[70px] rounded-lg overflow-hidden border-1 border-gray-300 mr-3 object-cover">

                              <div>
                                  <p class="text-bold text-sky-800 text-lg">${data.title}</p>
                                  <div class="flex items-center space-x-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="lucide lucide-map-pin-icon lucide-map-pin">
                                          <path
                                              d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                          <circle cx="12" cy="10" r="3" />
                                      </svg>
                                      <span class="text-[12px]">${data.location}</span>
                                  </div>
                                  <div class="flex items-center space-x-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="lucide lucide-briefcase-business-icon lucide-briefcase-business">
                                          <path d="M12 12h.01" />
                                          <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                          <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                          <rect width="20" height="14" x="2" y="6" rx="2" />
                                      </svg>
                                      <span class="text-[12px]">${jobTypeName}</span>
                                  </div>
                              </div>
                          </div>
                      </th>
                      <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                          <p class="px-2 py-1 rounded-xl">${fullName}</p>
                      </th>
                      <td class="px-6 py-4">
                          ${formatted}
                      </td>
                      <td class="px-6 py-3">
                          <div class="flex items-center justify-evenly">
                              <a href="${viewJob}" class="font-medium text-sky-600 hover:underline">View</a>
                          </div>
                      </td>
                </tr>

                `;

                $("#table-body").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function downloadExcel() {
    $("#downloadExcel").on("click", function () {
        const month = $("#month-select").val();
        const year = $('[name="year-select"]').val();
        const sort = $("#select_sort").val();

        const url = new URL(getJobDownloadRoute);
        url.searchParams.append("month", month);
        url.searchParams.append("year", year);
        url.searchParams.append("sort", sort);

        window.location.href = url.toString();
    });
}

$(function () {
    downloadExcel();
    let currentSort = "all";

    getJob("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getJob(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getJob(currentSearch, currentSort);
    });
});

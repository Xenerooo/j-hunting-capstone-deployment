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

            if (!data) {
                $("#interview-container").html(
                    `<div class="flex items-center justify-center mt-20 mx-auto">
                      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                          <strong class="font-bold">Error!</strong>
                          <span class="block sm:inline">No results found.</span>
                      </div>
                  </div>`
                );

                return;
            }

            data.forEach((data) => {
                const viewJob = `/job-seeker/job/view/${data.job_id}`;

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

                let style = "";
                let text = "";
                let statusIcon = "";

                switch (data.status) {
                    case "pending":
                        style = "bg-yellow-600 text-white";
                        text = "Pending";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>`;
                        break;
                    case "complete":
                        style = "bg-green-600 text-white";
                        text = "Complete";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>`;
                        break;
                    case "missed":
                        style = "bg-gray-200 text-gray-700";
                        text = "Missed";
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>`;
                        break;
                    default:
                        style = "bg-gray-200 text-gray-700";
                        text =
                            data.status.charAt(0).toUpperCase() +
                            data.status.slice(1);
                        statusIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>`;
                        break;
                }

                const mode = data.mode
                    ? data.mode === "online"
                        ? "Online"
                        : "In-person"
                    : "-";
                const detailRaw = data.detail || "";
                const isLink = /^https?:\/\//i.test(detailRaw);
                const detail = detailRaw || "-";

                const template = `
                      <div class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg">
                          <div class="p-4">
                              <div class="text-center mb-4">
                                  <img class="h-32 w-32 object-cover rounded-lg shadow-2xl overflow-hidden mx-auto"
                                      src="${profilePic}" alt="">
                                  <div class="py-2">
                                      <h3 class="font-bold text-md text-gray-800 mb-1">${fullName}</h3>
                                      <div class="inline-flex text-gray-700  text-xs">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"
                                              class="lucide lucide-map-pin-icon lucide-map-pin">
                                              <path
                                                  d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                              <circle cx="12" cy="10" r="3" />
                                          </svg>
                                          <span>Brgy. ${data.barangay}, ${
                    data.city
                }</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex flex-col items-center justify-center min-h-[28px]">
                                  <a href="${viewJob}"
                                      class="text-[16px] text-center text-sky-800 hover:text-sky-700 hover:underline font-semibold"
                                      title="view job">${data.title}</a>
                              </div>
                              <div class="mt-2 grid grid-cols-1 gap-2 text-[12px] text-gray-700">
                                  <div class="flex items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                      <span class="text-gray-600">Schedule:</span>&nbsp;<span class="font-semibold">${formatted}</span>
                                  </div>
                                  <div class="flex items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                      <span class="text-gray-600">Mode:</span>&nbsp;<span class="font-semibold">${mode}</span>
                                  </div>
                                  <div class="flex items-start">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 mt-0.5 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                      <span class="text-gray-600">Details:</span>&nbsp;
                                      ${
                                          detail !== "-"
                                              ? isLink
                                                  ? `<a href="${detail}" target="_blank" class="text-sky-700 hover:underline break-all">${detail}</a>`
                                                  : `<span class="font-semibold break-words">${detail}</span>`
                                              : '<span class="font-semibold">-</span>'
                                      }
                                  </div>
                              </div>
                              <div class="h-[1px] bg-gray-300 w-full my-3"></div>
                              <div class="flex flex-col gap-2 px-2">
                                  <span class="view-details inline-flex items-center justify-center rounded-lg ${style} antialiased font-semibold px-4 py-2 text-sm text-center">
                                      ${statusIcon}${text}
                                  </span>
                              </div>
                          </div>
                      </div>
              `;

                $("#interview-container").append(template);
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

$(function () {
    searchInterview();
});

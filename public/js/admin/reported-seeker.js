function ignoreReport(reportId, seekerId) {
    if (!reportId || !seekerId) {
        alert("Invalid report or job seeker ID.");
        return;
    }

    $("#ignore-modal").fadeIn();

    $("#confirm-ignore").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: ignoreReportRoute,
            data: {
                report_id: reportId,
                seeker_id: seekerId,
                _token: token,
            },
            dataType: "json",
            success: function (response) {
                showReportedSeeker("", "all");
            },
            error: function (xhr) {
                console.error("Failed to fetch data : ", xhr);
            },
        });
        $("#ignore-modal").fadeOut();
    });
}

function showReportedSeeker(searchQuery = "", sortBy = "all") {
    $.ajax({
        type: "get",
        url: showReportedSeekerRoute,
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const report = response.data;
            console.log(report);

            $("#reported-container").empty();

            if (!report.length) {
                $("#reported-container").html(
                    `<div class="col-span-1 sm:col-span-2 lg:col-span-3 flex items-center justify-center mt-12">
                      <div class="w-full max-w-md text-center bg-white/80 backdrop-blur-sm border border-rose-100 rounded-2xl shadow-lg p-8">
                          <div class="mx-auto mb-4 flex items-center justify-center w-14 h-14 rounded-full bg-rose-50 text-rose-600">
                              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                          </div>
                          <h3 class="text-lg font-semibold text-gray-900">No reports found</h3>
                          <p class="text-gray-600">Try adjusting your search or sort options.</p>
                      </div>
                  </div>`
                );
                return;
            }

            report.forEach((data) => {
                const fullName = `${data.job_seeker.first_name} ${
                    data.job_seeker.mid_name ?? ""
                } ${data.job_seeker.last_name} ${data.job_seeker.suffix ?? ""}`
                    .replace(/\s+/g, " ")
                    .trim();

                const viewSeeker = `/admin/reported-job-seekers/view/${data.seeker_id}`;

                const profilePic = data.job_seeker.profile_pic
                    ? `/storage/${data.job_seeker.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const reportedAt = data.reported_at;
                const reportDate = new Date(reportedAt);
                const formatted = reportDate.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const template = `
                <div class="group bg-white/85 backdrop-blur-sm border border-rose-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-5">
                        <div class="flex items-start gap-4">
                            <img class="w-16 h-16 rounded-xl ring-4 ring-white object-cover" src="${profilePic}" alt="">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate" name="seeker_name">${fullName}</p>
                                <div class="mt-1 flex flex-wrap items-center gap-3 text-xs text-gray-600">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        Brgy. ${data.job_seeker.barangay}, ${
                    data.job_seeker.city
                }
                                    </span>
                                    <span class="inline-flex items-center gap-1">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-megaphone-icon lucide-megaphone"><path d="M11 6a13 13 0 0 0 8.4-2.8A1 1 0 0 1 21 4v12a1 1 0 0 1-1.6.8A13 13 0 0 0 11 14H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"/><path d="M6 14a12 12 0 0 0 2.4 7.2 2 2 0 0 0 3.2-2.4A8 8 0 0 1 10 14"/><path d="M8 6v8"/></svg>
                                            Reported at <span class="font-semibold">${formatted}</span>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="my-4 h-px bg-gray-200"></div>
                        <div class="space-y-2">
                            <div class="inline-flex items-center gap-2 px-2 py-1 rounded-md bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M7 7h10l1 12H6L7 7z" />
                                </svg>
                                Reported
                            </div>
                            <p class="text-sm text-gray-700"><span class="font-semibold text-rose-700">${
                                data.report_title ?? "(No title)"
                            }</span></p>
                        </div>
                        <div class="mt-5 grid grid-cols-2 gap-2">
                            <a href="${viewSeeker}"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-red-600 text-white font-semibold px-4 py-2.5 text-sm shadow-sm hover:shadow-md hover:from-rose-600 hover:to-red-700 transition">
                                View
                            </a>
                            <button class="ignore-button inline-flex items-center justify-center rounded-xl bg-white text-rose-700 font-semibold px-4 py-2.5 text-sm border border-rose-300 hover:bg-rose-50 transition" data-report-id="${
                                data.report_id
                            }" data-seeker-id="${data.seeker_id}">
                                Ignore Report
                            </button>
                        </div>
                    </div>
                </div>`;

                $("#reported-container").append(template);
            });

            $(".ignore-button")
                .off("click")
                .on("click", function () {
                    const reportId = $(this).data("report-id");
                    const seekerId = $(this).data("seeker-id");
                    ignoreReport(reportId, seekerId);
                });
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

$(function () {
    let currentSort = "all";

    showReportedSeeker("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        showReportedSeeker(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        showReportedSeeker(currentSearch, currentSort);
    });
});

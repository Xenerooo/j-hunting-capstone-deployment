function showRequests(searchQuery = "", sortBy = "all") {
    $.ajax({
        type: "get",
        url: showRequestsRoute,
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const employersData = response.data;

            $("#requests-container").empty();

            if (!employersData.length) {
                $("#requests-container").html(
                    `<div class="col-span-1 sm:col-span-2 lg:col-span-3 flex items-center justify-center mt-12">
                      <div class="w-full max-w-md text-center bg-white/80 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg p-8">
                          <div class="mx-auto mb-4 flex items-center justify-center w-14 h-14 rounded-full bg-sky-50 text-sky-600">
                              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                          </div>
                          <h3 class="text-lg font-semibold text-gray-900">No results found</h3>
                          <p class="text-gray-600">Try adjusting your search or sort options.</p>
                      </div>
                  </div>`
                );
                return;
            }

            employersData.forEach((data) => {
                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`
                    .replace(/\s+/g, " ")
                    .trim();

                const tagName =
                    data.employer_type == "company" ? data.comp_name : fullName;

                const viewEmployer = `/admin/request-employers/view/${data.employer_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const template = `
                      <div class="group bg-white/80 backdrop-blur-sm border border-sky-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                          <div class="p-5">
                              <div class="flex items-start gap-4">
                                  <img class="w-16 h-16 rounded-xl ring-4 ring-white object-cover" src="${profilePic}" alt="">
                                  <div class="min-w-0">
                                      <p class="text-sm font-semibold text-gray-900 truncate">${tagName}</p>
                                      <div class="mt-1 flex flex-wrap items-center gap-3 text-xs text-gray-600">
                                          <span class="inline-flex items-center gap-1">
                                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                  <circle cx="12" cy="10" r="3" />
                                              </svg>
                                              Brgy. ${data.barangay}, ${data.city}
                                          </span>
                                          <span class="inline-flex items-center gap-1">
                                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                  <path d="M12 12h.01" />
                                                  <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                  <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                  <rect width="20" height="14" x="2" y="6" rx="2" />
                                              </svg>
                                              ${data.employer_type}
                                          </span>
                                      </div>
                                  </div>
                              </div>

                              <div class="my-4 h-px bg-gray-200"></div>

                              <div class="space-y-2">
                                  <p class="text-sm text-gray-600">Hello, J-Hunting Administrator! I’m thrilled to be part of this platform and look forward to connecting with qualified job seekers for our growing team!</p>
                              </div>

                              <div class="mt-5 flex gap-2">
                                  <a href="${viewEmployer}"
                                      class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 text-white font-semibold px-4 py-2.5 text-sm shadow-sm hover:shadow-md hover:from-sky-700 hover:to-blue-700 transition">
                                      View
                                  </a>
                              </div>
                          </div>
                      </div>`;

                $("#requests-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

$(function () {
    let currentSort = "all";

    showRequests("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        showRequests(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        showRequests(currentSearch, currentSort);
    });
});

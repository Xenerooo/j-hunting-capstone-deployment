let selectedSeekerId = null;

function unfollow(seeker_id) {
    selectedSeekerId = seeker_id;
    $("#unfollow-modal").fadeIn();

    $("#confirm-unfollow")
        .off("click")
        .on("click", function (e) {
            $.ajax({
                type: "post",
                url: unfollowRoute,
                data: {
                    _token: token,
                    seeker_id: selectedSeekerId,
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $("#unfollow-modal").fadeOut();

                    getFollowing(
                        $("[name='search_input']").val().trim(),
                        $("#select_sort").val() || "all"
                    );
                },
                error: function (xhr) {
                    console.log(xhr);
                },
            });
        });
}

function getFollowing(searchQuery = "", sortBy = "all") {
    $.ajax({
        url: getFollowingRoute,
        type: "GET",
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const seeker = response.data;

            $("#following-container").empty();

            if (!seeker.length) {
                $("#following-container").html(
                    `<div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No job seekers followed</h3>
                            <p class="text-gray-600">Start following job seekers to receive updates about their activities and new job applications.</p>
                        </div>
                    </div>`
                );
            }

            seeker.forEach((data) => {
                const viewSeeker = `/employer/following/view/${data.seeker_id}`;

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const fullName = `${data.first_name} ${data.mid_name ?? ""} ${
                    data.last_name
                } ${data.suffix ?? ""}`;

                const followedAt = data.followed_at.split(" ")[0];
                const followDate = new Date(followedAt);
                const formatted = followDate.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const template = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <!-- Header with Job Seeker Info -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="relative">
                                <img class="w-16 h-16 rounded-xl object-cover border-2 border-gray-100 shadow-sm"
                                    src="${profilePic}" alt="Job Seeker Photo">
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
                                <div class="flex flex-col items-start space-x-4 text-xs text-gray-500 mb-2">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        Brgy. ${data.barangay}, ${data.city}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-start text-gray-600">Followed on ${formatted}</p>
                    </div>
                        
                    <!-- Action Buttons -->
                    <div class="p-6">
                        <div class="flex space-x-3">
                            <a href="${viewSeeker}"
                                class="flex-1 flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-lg hover:from-sky-600 hover:to-blue-700 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                View Profile
                            </a>
                            <button type="button" class="unfollow-button flex-1 flex items-center justify-center px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-700 hover:border-red-300 transition-all duration-200 text-sm font-medium"
                                data-seeker-id="${data.seeker_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="m17 17 5 5" />
                                    <path d="m22 17-5 5" />
                                </svg>
                                Unfollow
                            </button>
                        </div>
                    </div>
                </div>
                `;

                $("#following-container").append(template);
            });

            $(".unfollow-button")
                .off("click")
                .on("click", function () {
                    const seekerId = $(this).data("seeker-id");
                    unfollow(seekerId);
                });
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
}

function searchFollowing() {
    let currentSort = "all";
    getFollowing("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getFollowing(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getFollowing(currentSearch, currentSort);
    });
}

$(function () {
    searchFollowing();
});

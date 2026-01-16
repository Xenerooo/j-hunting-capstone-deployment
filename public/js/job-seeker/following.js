let selectedEmployerId = null;

function muteNotification(employerId, mute) {
    $.ajax({
        type: "POST",
        url: muteNotificationRoute,
        data: {
            _token: token,
            employer_id: employerId,
            mute: mute ? 1 : 0,
        },
        dataType: "json",
        success: function (response) {
            const search = $("[name='search_input']").val().trim();
            const currentSort = $("#select_sort").val();

            getFollowing(search, currentSort);
        },
        error: function (xhr) {
            console.error("Mute request failed:", xhr);
        },
    });
}

function unfollow(employer_id) {
    selectedEmployerId = employer_id;
    $("#unfollow-modal").fadeIn();

    $("#confirm-unfollow")
        .off("click")
        .on("click", function (e) {
            $.ajax({
                type: "post",
                url: unfollowRoute,
                data: {
                    _token: token,
                    employer_id: selectedEmployerId,
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
        type: "GET",
        url: getFollowingRoute,
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const employer = response.data;

            $("#following-container").empty();

            if (!employer) {
                $("#following-container").html(
                    `<div class="flex items-center justify-center mt-20 mx-auto">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">No results found.</span>
                        </div>
                    </div>`
                );
            }

            employer.forEach((data) => {
                const viewEmployer = `/job-seeker/following/view/${data.employer_id}`;

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

                const mute = data.mute;
                let bell = "";

                if (mute === 0) {
                    bell = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"        stroke-linejoin="round" class="lucide lucide-bell-off-icon lucide-bell-off text-red-500">
                                <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                                <path d="M17 17H4a1 1 0 0 1-.74-1.673C4.59 13.956 6 12.499 6 8a6 6 0 0 1 .258-1.742"/>
                                <path d="m2 2 20 20"/>
                                <path d="M8.668 3.01A6 6 0 0 1 18 8c0 2.687.77 4.653 1.707 6.05"/>
                            </svg>`;
                } else {
                    bell = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-icon lucide-bell">
                        <path d="M10.268 21a2 2 0 0 0 3.464 0"/>
                        <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/>
                    </svg>`;
                }

                const template = `
                    <div class="w-full mx-auto bg-gray-50 border border-gray-300 rounded-lg overflow-hidden shadow-lg relative">
                        <div class="notification-toggle absolute top-3 right-3 hover:bg-gray-400 hover:text-white text-gray-600 rounded-full p-2 duration-200 cursor-pointer"
                            title="Mute notification" data-employer-id="${
                                data.employer_id
                            }" data-muted="${mute}">
                            ${bell}
                        </div>
                        <div class="p-3">
                            <div class="text-center mb-4">
                                <img class="h-32 w-32 object-cover rounded-lg border-4 border-white mx-auto"
                                    src="${profilePic}" alt="">
                                <div class="py-2 flex flex-col items-center ">
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
                            <span class="text-[10px] text-start text-gray-600">Followed on ${formatted}</span>
                            <div class="h-[1px] bg-gray-200 w-full my-4"></div>
                            <div class="flex gap-2 px-2">
                                <a href="${viewEmployer}"
                                    class="view-employer flex-1 rounded-lg bg-sky-800 text-gray-100 font-semibold hover:bg-sky-700 px-4 py-2 duration-200 cursor-pointer text-sm text-center"
                                    data-employer-id="${data.employer_id}"
                                    data-approved="${
                                        typeof data.approved !== "undefined"
                                            ? data.approved
                                            : ""
                                    }">
                                    View
                                </a>
                                <button
                                    class="unfollow-button flex-1 rounded-lg border-1 border-gray-400 font-semibold text-gray-700 text-sm px-4 py-2 hover:text-gray-100 hover:bg-red-500 duration-200 cursor-pointer" data-employer-id="${
                                        data.employer_id
                                    }">
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
                    const employerId = $(this).data("employer-id");
                    unfollow(employerId);
                });

            $(".notification-toggle")
                .off("click")
                .on("click", function () {
                    const employerId = $(this).data("employer-id");
                    const mute = $(this).data("muted");
                    muteNotification(employerId, mute);
                });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
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

function navigateEmployer() {
    $(document).off("click", ".view-employer");
    $(document).on("click", ".view-employer", function (e) {
        e.preventDefault();
        const employerId = $(this).data("employer-id");
        const isApproved = $(this).data("approved");

        if (isApproved === 0 || isApproved === false || isApproved === "0") {
            message(
                "bg-red-100 border-red-500 text-red-700",
                "Access Denied",
                "This employer profile is not approved by the admin.",
                5000
            );
            return;
        }
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
                } else if (
                    response.approved === false ||
                    response.approved === 0 ||
                    response.status === "not_approved"
                ) {
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Access Denied",
                        "This employer profile is not approved by the admin.",
                        5000
                    );
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
    searchFollowing();
    navigateEmployer();
});

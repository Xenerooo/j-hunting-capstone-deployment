function getNotification(sort = "all") {
    $.ajax({
        type: "GET",
        url: getNotificationRoute,
        data: {
            sort: sort,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;
            const seekerList = response.jobseeker;
            console.log(response);

            $("#notification-container").empty();

            if (!data.length) {
                $("#notification-container").html(
                    `<div class="flex flex-col items-center justify-center py-16">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No notifications</h3>
                            <p class="text-gray-600">You're all caught up! New notifications will appear here when you receive them.</p>
                        </div>
                    </div>`
                );
            }

            // Helper to capitalize each word
            function capitalizeWords(str) {
                return str.replace(/\w\S*/g, function (txt) {
                    return (
                        txt.charAt(0).toUpperCase() +
                        txt.substr(1).toLowerCase()
                    );
                });
            }

            data.forEach((notif, idx) => {
                const notif_id = notif.notif_id;

                let seeker =
                    seekerList && seekerList[idx] ? seekerList[idx] : {};

                // Determine profilePic based on is_admin and fallback
                let profilePic;
                if (seeker.is_admin) {
                    profilePic = jhuntingProfile;
                } else if (seeker.profile_pic) {
                    profilePic = `/storage/${seeker.profile_pic}`;
                } else {
                    profilePic =
                        "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
                }

                const fullName = seeker.first_name
                    ? `${seeker.first_name ?? ""} ${seeker.mid_name ?? ""} ${
                          seeker.last_name ?? ""
                      } ${seeker.suffix ?? ""}`.trim()
                    : "J-Hunting Admin";

                const receivedAt = timeAgo(notif.received_at);

                const notifTitle = notif.notif_title
                    ? capitalizeWords(notif.notif_title)
                    : "";

                const template = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 notification-item" data-notif-id="${notif_id}">
                    <div class="p-6">
                        <div class="flex items-start space-x-4">
                            <!-- Profile Picture -->
                            <div class="relative flex-shrink-0">
                                <img src="${profilePic}" alt="Profile" class="w-12 h-12 rounded-xl object-cover border-2 border-gray-100 shadow-sm" />
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-sky-500 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Notification Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">${notifTitle}</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed mb-2">${notif.notif_content}</p>
                                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12,6 12,12 16,14" />
                                            </svg>
                                            <span>${receivedAt}</span>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <button type="button" class="delete-notification-btn ml-4 p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200 flex-shrink-0" data-notif-id="${notif_id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6L6 18" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $("#notification-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr);
        },
    });
}

function timeAgo(dateString) {
    const now = new Date();
    const date = new Date(dateString.replace(/-/g, "/"));
    const diffMs = now - date;
    const diffSec = Math.floor(diffMs / 1000);
    const diffMin = Math.floor(diffSec / 60);
    const diffHour = Math.floor(diffMin / 60);
    const diffDay = Math.floor(diffHour / 24);

    if (diffSec < 60) {
        return "just now";
    } else if (diffMin < 60) {
        return `${diffMin} minute${diffMin === 1 ? "" : "s"} ago`;
    } else if (diffHour < 24) {
        return `${diffHour} hour${diffHour === 1 ? "" : "s"} ago`;
    } else {
        return `${diffDay} day${diffDay === 1 ? "" : "s"} ago`;
    }
}

function sortNotification() {
    let currentSort = "all";
    getNotification(currentSort);

    $("#select_sort").on("change", function (e) {
        e.preventDefault();

        currentSort = $(this).val();
        getNotification(currentSort);
    });
}

function deleteNotification(notif_id, callback) {
    $.ajax({
        type: "POST",
        url: deleteNotificationRoute,
        data: {
            _token:
                typeof token !== "undefined"
                    ? token
                    : $('meta[name="csrf-token"]').attr("content"),
            notif_id: notif_id,
        },
        dataType: "json",
        success: function (response) {
            if (typeof callback === "function") callback(response);
        },
        error: function (xhr) {
            console.error("Failed to delete notification : ", xhr);
        },
    });
}

$(function () {
    sortNotification();

    $("#notification-container").on(
        "click",
        ".delete-notification-btn",
        function (e) {
            e.preventDefault();
            const notif_id = $(this).data("notif-id");
            const $notifItem = $(this).closest(".notification-item");

            if (notif_id) {
                deleteNotification(notif_id, function (response) {
                    $notifItem.remove();
                });
            }
        }
    );
});

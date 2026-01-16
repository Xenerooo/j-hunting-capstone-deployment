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
            const employerList = response.employer;

            $("#notification-container").empty();

            if (!data.length) {
                $("#notification-container").html(
                    `<div class="flex items-center justify-center mt-20">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">No results found.</span>
                    </div>
                </div>`
                );
            }

            data.forEach((notif, idx) => {
                const notif_id = notif.notif_id;

                let employer =
                    employerList && employerList[idx] ? employerList[idx] : {};

                const profilePic = employer.profile_pic
                    ? `/storage/${employer.profile_pic}`
                    : jhuntingProfile;

                const fullName = employer.first_name
                    ? `${employer.first_name ?? ""} ${
                          employer.mid_name ?? ""
                      } ${employer.last_name ?? ""} ${
                          employer.suffix ?? ""
                      }`.trim()
                    : "J-Hunting Admin";

                const receivedAt = timeAgo(notif.received_at);

                const template = `
              <div class="grid grid-cols-8 gap-4 rounded border border-gray-300 p-2 notification-item" data-notif-id="${notif_id}">
                  <div class="col-span-6 md:col-span-7 flex flex-row items-center">
                      <img src="${profilePic}" alt="profile"
                          class="object-cover w-[3rem] h-[3rem] md:w-[5rem] md:h-[5rem] rounded border-1 border-gray-300" />

                      <div class="ms-2">
                          <span class="font-medium text-sky-800 text-md md:text-xl">${notif.notif_title}</span>
                          <p class="text-gray-800 flex items-center">
                              <span class="text-[12px]">${notif.notif_content}</span>
                          </p>
                      </div>
                  </div>
                  <div class="col-span-2 md:col-span-1 flex items-center justify-between">
                      <p class=" text-[10px] md:text-[12px] text-semibold text-gray-400">
                          ${receivedAt}</p>
                      <button type="button"
                          class="delete-notification-btn text-red-500 hover:bg-red-400 hover:text-white cursor-pointer duration-200 rounded-full"
                          data-notif-id="${notif_id}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="lucide lucide-circle-x-icon lucide-circle-x ">
                              <circle cx="12" cy="12" r="10" />
                              <path d="m15 9-6 6" />
                              <path d="m9 9 6 6" />
                          </svg>
                      </button >
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

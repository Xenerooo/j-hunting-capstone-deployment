function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function getFeedback(searchQuery = "", sortBy = "all") {
    $.ajax({
        url: getFeedbackRoute,
        type: "GET",
        data: {
            search: searchQuery,
            sort: sortBy,
        },
        dataType: "json",
        success: function (response) {
            const feedbackData = response.data;

            $("#feedback-container").empty();
            $("#empty-container").addClass("hidden");

            if (!feedbackData.length) {
                $("#empty-container").removeClass("hidden");
                return;
            }

            feedbackData.forEach((data) => {
                let borderColor = "";
                if (data.is_displayed === 1) {
                    borderColor = "border-green-500";
                } else {
                    borderColor = "border-red-500";
                }

                const profilePic = data.profile_pic
                    ? `/storage/${data.profile_pic}`
                    : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

                const datePosted = data.feedback_at.split(" ")[0];
                const posted = new Date(datePosted);
                const formatted = posted.toLocaleDateString("en-US", {
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                });

                const rating = data.rating;
                let stars = "";

                for (let i = 1; i <= 5; i++) {
                    const fillColor =
                        i <= rating ? "text-yellow-400" : "text-gray-300";
                    stars += `
                      <svg xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="lucide lucide-star-icon lucide-star ${fillColor} rounded">
                          <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>
                      </svg>
                  `;
                }

                const statusColor =
                    data.is_displayed == "1"
                        ? "bg-green-100 text-green-800"
                        : "bg-yellow-100 text-yellow-800";
                const statusIcon =
                    data.is_displayed == "1"
                        ? `<svg class="w-5 h-5 text-green-800" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>`
                        : `<svg class="w-5 h-5 text-yellow-800" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>`;
                const status =
                    data.is_displayed == "1" ? "Approved" : "Pending";

                const template = `
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-sky-100 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <!-- Header with profile and status -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img src="${profilePic}"
                                            alt="Profile"
                                            class="w-16 h-16 rounded-lg object-cover border-1 border-gray-300">
                                        <div class="absolute -bottom-1 -right-1 w-6 h-6 ${statusColor} rounded-full border-2 border-white flex items-center justify-center">
                                            ${statusIcon}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">${
                                            data.email
                                        }</h3>
                                        <p class="text-sm text-gray-600">Posted on ${formatted}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${statusColor}">
                                        ${statusIcon}
                                        ${status}
                                    </span>
                                    <button onclick="getFeedbackDetails(${
                                        data.feedback_id
                                    })" 
                                        class="inline-flex items-center px-4 py-2 bg-sky-600 text-white text-sm font-medium rounded-lg hover:bg-sky-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="mb-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700">Rating:</span>
                                    <div class="flex items-center space-x-1">
                                        ${stars}
                                    </div>
                                    <span class="text-sm text-gray-600">(${rating}/5)</span>
                                </div>
                            </div>

                            <!-- Feedback Preview -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    ${
                                        data.content
                                            ? data.content.substring(0, 150) +
                                              (data.content.length > 150
                                                  ? "..."
                                                  : "")
                                            : "No feedback message provided."
                                    }
                                </p>
                            </div>
                        </div>
                    </div>`;

                $("#feedback-container").append(template);
            });
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function getFeedbackDetails(feedbackID) {
    $("#view-feedback-modal").fadeIn();

    $("#accept-feedback").off("click");
    $("#delete-feedback").off("click");

    $.ajax({
        url: getFeedbackDetailsRoute,
        type: "GET",
        data: { feedback_id: feedbackID },
        dataType: "json",
        success: function (response) {
            const feedbackData = response.data;

            const rating = feedbackData.rating;
            let stars = "";

            for (let i = 1; i <= 5; i++) {
                const fillColor =
                    i <= rating ? "text-yellow-400" : "text-gray-300";
                stars += `
                      <svg xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="lucide lucide-star-icon lucide-star ${fillColor} rounded">
                          <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>
                      </svg>
                  `;
            }

            $("#accept-feedback").on("click", function (e) {
                e.preventDefault();
                displayFeedback(feedbackID, true);
            });

            $("#delete-feedback").on("click", function (e) {
                e.preventDefault();
                displayFeedback(feedbackID, false);
            });

            $("#stars-container").html(stars);
            $("#email").text(feedbackData.account.email);
            $("#feedback_content").text(feedbackData.content);
            $("#rating-text").text(`(${rating}/5 stars)`);

            const email = feedbackData.account.email;
            const initials = email.split("@")[0].substring(0, 2).toUpperCase();
            $("#user-initials").text(initials);
        },
        error: function (xhr) {
            console.error("Failed to fetch feedback details:", xhr);
        },
    });
}

function displayFeedback(feedbackID, is_accept) {
    $.ajax({
        url: displayFeedbackRoute,
        type: "GET",
        data: {
            feedback_id: feedbackID,
            is_accept: is_accept,
            _token: token,
        },
        dataType: "json",
        success: function (response) {
            getFeedback("", "all");
            $("#view-feedback-modal").fadeOut();

            return message(
                "bg-green-100 border-green-500 text-green-700",
                "Success",
                response.message,
                3000
            );
        },
        error: function (xhr) {
            console.error("Failed to display feedback:", xhr);
        },
    });
}

$(function () {
    let currentSort = "all";

    getFeedback("", currentSort);

    $("[name='search_button']").on("click", function () {
        const search = $("[name='search_input']").val().trim();
        getFeedback(search, currentSort);
    });

    $("#select_sort").on("change", function () {
        currentSort = $(this).val();
        const currentSearch = $("[name='search_input']").val().trim();
        getFeedback(currentSearch, currentSort);
    });
});

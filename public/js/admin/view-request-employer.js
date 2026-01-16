const urlParts = window.location.pathname.split("/");
const employerId = urlParts[urlParts.length - 1];

function map(latitude, longitude, workLocation) {
    var map = L.map("map").setView([latitude, longitude], 19);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    L.marker([latitude, longitude])
        .addTo(map)
        .bindPopup(workLocation)
        .openPopup();
}

function message(color, title, content) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, 6000);
}

function approval() {
    let is_approve = false;

    //approve account
    $("#approve-button").on("click", function (e) {
        e.preventDefault();
        is_approve = true;
        $("#approve-modal").fadeIn();

        $("#confirm-approve").on("click", function () {
            $("#approve-modal").fadeOut();
            console.log(is_approve);

            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    employer_id: employerId,
                    is_approved: is_approve,
                    email: $("[name='email']").text(),
                    title: "Account notice",
                    content:
                        "Congratulation! Your account has been approve by the admin.",
                },
                dataType: "json",
                beforeSend: function () {
                    $("#mailing-overlay").fadeIn();
                },
                success: function (response) {
                    message(
                        "bg-green-100 text-green-700",
                        "Approval Status",
                        response.message
                    );
                    $("#mailing-overlay").fadeOut();
                    window.location.href = pageRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                    $("#mailing-overlay").fadeOut();
                },
            });
        });
    });

    //decline account
    $("#decline-button").on("click", function (e) {
        e.preventDefault();
        is_approve = false;
        $("#message-modal").fadeIn();

        $("#message-modal").on("submit", function (e) {
            e.preventDefault();
            console.log(is_approve);
            $("#mailing-overlay").fadeOut();

            $.ajax({
                type: "post",
                url: approvalRoute,
                data: {
                    _token: token,
                    employer_id: employerId,
                    is_approved: is_approve,
                    email: $("[name='email']").text(),
                    title: $("[name='title']").val(),
                    content: $("[name='content']").val(),
                },
                dataType: "json",
                beforeSend: function () {
                    $("#mailing-overlay").fadeIn();
                },
                success: function (response) {
                    message(
                        "bg-green-100 text-green-700",
                        "Decline Status",
                        response.message
                    );
                    $("#mailing-overlay").fadeOut();
                    window.location.href = pageRoute;
                },
                error: function (xhr) {
                    console.error("Failed to fetch data:", xhr);
                    $("#mailing-overlay").fadeOut();
                },
            });
        });
    });
}

function viewProfile() {
    $.ajax({
        type: "GET",
        url: getProfileRoute,
        data: {
            employer_id: employerId,
        },
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.log("Him inay error");
            }
            const data = response.data;
            const jobType = response.job_type ?? [];

            const fullName = `${data.first_name ?? ""} ${data.mid_name ?? ""} ${
                data.last_name ?? ""
            } ${data.suffix ?? ""}`;

            const location = `Brgy. ${data.barangay ?? ""}, ${data.city ?? ""}`;

            const compName = data.comp_name ?? "";

            $("[name='full_name']").text(fullName);
            $("[name='comp_name']").text(compName);
            $("[name='email']").text(data.account.email);
            $("[name='location']").text(location);
            $("[name='job_type']").text(jobType);

            $.each(data, function (key, value) {
                if (
                    [
                        "employer_id",
                        "account_id",
                        "first_name",
                        "mid_name",
                        "last_name",
                        "suffix",
                        "email",
                        "barangay",
                        "city",
                    ].includes(key)
                )
                    return;
                const $target = $(`[name="${key}"]`);

                try {
                    if (key === "profile_pic") {
                        const imgUrl = value
                            ? `/storage/${value}`
                            : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
                        $('img[name="profile_pic"]').attr("src", imgUrl);
                        return;
                    }
                    if (key === "facebook_link") {
                        const fbLink = value ? value : "";
                        $('a[name="facebook_link"]')
                            .text(fbLink)
                            .attr("href", fbLink)
                            .attr("target", "_blank");
                        return;
                    }

                    if (key === "valid_id") {
                        const validIdUrl = `/storage/${value}`;
                        $("#valid-id-preview").attr("src", validIdUrl);
                        $("#valid-id-preview-modal").attr("src", validIdUrl);
                        return;
                    }

                    if (key === "business_permit") {
                        let formatFile = value.split("permit/").pop() ?? "";

                        if (value) {
                            const permitUrl = `/storage/${value}`;
                            $("[name='permit_name']")
                                .text(formatFile)
                                .attr("href", permitUrl)
                                .attr("target", "_blank")
                                .removeClass("hidden");
                        } else {
                            $("[name='permit_name']")
                                .text("No Business Permit")
                                .removeAttr("href")
                                .attr("target", "")
                                .addClass("hidden");
                        }
                        return;
                    }
                    $target.text(value ?? "");
                } catch (error) {
                    console.log(error);
                }
            });
            map(data.latitude, data.longitude, data.work_location);
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function downloadPermit() {
    $("#permit_download").on("click", function (e) {
        e.preventDefault();
        const permitPath = $("[name='permit_name']").attr("href");
        window.location.href = permitPath;
    });
}

$(function () {
    viewProfile();
    downloadPermit();
    approval();
});

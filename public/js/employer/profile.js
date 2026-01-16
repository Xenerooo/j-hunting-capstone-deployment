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

function setWorkLocation(latitude = 11.6075, longitude = 125.4312) {
    var map = L.map("work_map").setView([latitude, longitude], 19);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap",
    }).addTo(map);

    var marker;

    map.on("click", function (e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        $("[name='add_latitude']").val(lat);
        $("[name='add_longitude']").val(lng);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
}

function checkPermitSize() {
    $("[name='add_business_permit']").on("change", function () {
        const file = this.files[0];

        if (file) {
            const fileSize = file.size;
            const fileInMB = fileSize / (1024 * 1024);

            if (fileInMB > 2) {
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Failed",
                    "Business permit must not exceed to 2MB.",
                    5000
                );

                $(this).val("");
                return;
            }
        }
    });
}

function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function storeProfileData() {
    $("#edit-profile-form").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);
        formData.append("_token", _token);

        const yearInpt = $("[name='add_year']").val();
        const monthInput = $("[name='add_month']").val();
        const currentYear = new Date().getFullYear();

        if (yearInpt && yearInpt > currentYear) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "The year founded cannot be in the future.",
                3000
            );
        }

        // If only one of year or month is filled, show error
        if ((yearInpt && !monthInput) || (!yearInpt && monthInput)) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Please provide both year and month for date founded, or leave both empty.",
                3000
            );
        }

        // If both are empty, set to N/A
        if (!yearInpt && !monthInput) {
            formData.append("add_date_founded", "N/A");
        } else {
            formData.append("add_date_founded", `${yearInpt} ${monthInput}`);
        }

        const city = "Borongan City";
        formData.append("add_city", city);

        const workLocation = `Brgy. ${$(
            "[name='add_barangay']"
        ).val()}, ${city}`;
        formData.append("add_work_location", workLocation);

        $.ajax({
            type: "post",
            url: storeProfileRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                $(
                    "#profile-edit-button, #mobile-edit-profile-button"
                ).removeClass("hidden");
                $(".top-profile").removeClass("hidden").addClass("md:flex");
                location.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = Object.values(errors)[0][0];
                    errorMessage = errorMessage.replace(/add[_\s]?/gi, "");
                    message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Failed",
                        errorMessage,
                        5000
                    );
                } else {
                    console.log("Other error:", xhr);
                }
            },
        });
    });
}

function getProfileData() {
    $.ajax({
        type: "get",
        url: getDataProfileRoute,
        dataType: "json",
        success: function (response) {
            const email = response.account_details.email ?? "";

            if (!response.success) {
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Profile Not Found",
                    response.message,
                    5000
                );
                $('[name="email"]').text(email);
                $(".editProfileButton").text(
                    response.button_text ? response.button_text : "Edit profile"
                );
                return;
            }

            $('[name="followers"]').text(response.followers);
            $('[name="followings"]').text(response.followings);

            const profileDetails = response.profile_details;

            const location = `Brgy. ${profileDetails.barangay}, ${profileDetails.city}`;
            $("[name='living_location']").text(location);

            $('[name="email"]').text(email);

            map(
                profileDetails.latitude,
                profileDetails.longitude,
                profileDetails.work_location
            );

            const jobType = response.job_type;
            $('[name="job_type"]').text(jobType);

            $.each(profileDetails, function (key, value) {
                if (["employer_id", "account_id"].includes(key)) return;
                const $target = $(`[name="${key}"]`);
                try {
                    if (key === "profile_pic") {
                        const imgUrl = value
                            ? `/storage/${value}`
                            : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
                        $('img[name="profile_pic"]').attr("src", imgUrl);
                        return;
                    }
                    if (key === "valid_id") {
                        const imgUrl = value
                            ? `/storage/${value}`
                            : "https://philsys.gov.ph/wp-content/uploads/2022/11/PhilID-specimen-Front_highres1-1024x576.png";
                        $('img[name="valid_id"]').attr("src", imgUrl);
                        return;
                    }
                    if (key === "facebook_link") {
                        const fbLink = value ? value : "#";
                        $('a[name="facebook_link"]')
                            .text(fbLink)
                            .attr("href", fbLink)
                            .attr("target", "_blank");
                        return;
                    }
                    if (key === "business_permit") {
                        let formatFile = value
                            ? value.split("permit/").pop()
                            : "";
                        if (value) {
                            const permitUrl = `/storage/${value}`;
                            $("#permitName")
                                .text(formatFile)
                                .attr("href", permitUrl)
                                .attr("target", "_blank")
                                .removeClass("hidden");
                        } else {
                            $("#permitName")
                                .text("No Resume")
                                .removeAttr("href")
                                .attr("target", "")
                                .addClass("hidden");
                        }
                        return;
                    }
                    if ($target.is("input, textarea")) {
                        $target.val(value ?? "");
                    } else if ($target.is("span, p")) {
                        $target.text(value ?? "");
                    } else {
                        return;
                    }
                } catch (e) {
                    console.error(e);
                }
            });
        },
        error: function (error, xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                console.log(errors);
            } else {
                console.log("Other error:", error);
            }
        },
    });
}

function getEditData() {
    $.ajax({
        url: getEditDataRoute,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (!response.success) {
                console.error(response.message);
                return;
            }

            const data = response.profile;

            const profilePic = data.profile_pic
                ? `/storage/${data.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
            $("#profile-preview").attr("src", profilePic);

            const validId = data.valid_id
                ? `/storage/${data.valid_id}`
                : "https://philsys.gov.ph/wp-content/uploads/2022/11/PhilID-specimen-Front_highres1-1024x576.png";
            $("#valid-id-preview").attr("src", validId);

            const permitFileName = data.business_permit
                ? data.business_permit.split("/").pop()
                : "No File Found";
            $("#permit-preview").text("Current : " + permitFileName);

            const workLocation = data.work_location;
            let formatWorkLocation = "";

            if (workLocation) {
                formatWorkLocation = workLocation
                    .replace(/^Brgy\.\s*/i, "")
                    .replace(/,\s*Borongan City$/i, "")
                    .trim();
            }

            const dateFounded = data.date_founded ?? "";
            const parts = dateFounded.split(" ");
            const year = parts[0];
            const month = parts[1];

            //business information
            $("[name='add_employer_type']").val(data.employer_type ?? "");
            $("[name='add_comp_name']").val(data.comp_name ?? "");
            $("[name='add_month']").val(month ?? "");
            $("[name='add_year']").val(year ?? "");
            $("[name='add_comp_size']").val(data.comp_size ?? "");
            $("[name='add_barangay']").val(data.barangay ?? "");
            $("[name='add_city']").val(data.city ?? "");
            $("[name='add_work_location']").val(formatWorkLocation);
            $("[name='add_latitude']").val(data.latitude ?? "");
            $("[name='add_longitude']").val(data.longitude ?? "");
            $("[name='add_valid_id_type']").val(data.valid_id_type ?? "");
            $("[name='add_job_type']").val(response.job_type ?? "");

            //personal information
            $("[name='add_first_name']").val(data.first_name ?? "");
            $("[name='add_mid_name']").val(data.mid_name ?? "");
            $("[name='add_last_name']").val(data.last_name ?? "");
            $("[name='add_suffix']").val(data.suffix ?? "");

            $("[name='add_phone_num']").val(data.phone_num ?? "");
            $("[name='add_facebook_link']").val(data.facebook_link ?? "");
            $("[name='add_about']").val(data.about ?? "");
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function downloadPermit() {
    $("#downloadPermit").on("click", function (e) {
        e.preventDefault();
        const permitPath = $("#permitName").attr("href");
        window.location.href = permitPath;
    });
}

function editProfileButtons() {
    const editButtons = $("#profile-edit-button, #mobile-edit-profile-button");
    const topProfile = $(".top-profile");
    const editForm = $("#edit-profile-form");
    const recentApplied = $("#recent-applied");
    const saved = $(".saved");
    const cancel = $("#profile-cancel-button");

    editButtons.on("click", function (e) {
        e.preventDefault();

        editButtons.addClass("hidden");
        topProfile.addClass("hidden").removeClass("md:flex overflow-hidden");
        recentApplied.addClass("hidden");
        saved.addClass("hidden");
        editForm.removeClass("hidden");
    });

    cancel.on("click", function () {
        editForm.addClass("hidden");
        saved.removeClass("hidden");
        editButtons.removeClass("hidden");
        topProfile.removeClass("hidden").addClass("md:flex");
    });
}

function profileSelectImage() {
    $("#profile-preview").on("click", function () {
        $("#select-profile").trigger("click");
    });

    $("#select-profile").on("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#profile-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}

function idSelectImage() {
    $("#valid-id-preview").on("click", function () {
        $("#select-valid-id").trigger("click");
    });

    $("#select-valid-id").on("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#valid-id-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}

$(function () {
    checkPermitSize();
    storeProfileData();
    getProfileData();
    getEditData();
    editProfileButtons();
    setWorkLocation();
    profileSelectImage();
    idSelectImage();
    downloadPermit();
});

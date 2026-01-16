function message(color, title, content, interval) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, interval);
}

function jobTypeSelection() {
    const $selectAll = $("#select-all-job-types");
    const $jobTypeCheckboxes = $(".job-type-checkbox");

    $selectAll.on("change", function () {
        $jobTypeCheckboxes.prop("checked", this.checked);
    });

    $jobTypeCheckboxes.on("change", function () {
        if (
            $jobTypeCheckboxes.length ===
            $jobTypeCheckboxes.filter(":checked").length
        ) {
            $selectAll.prop("checked", true);
        } else {
            $selectAll.prop("checked", false);
        }
    });
}

function sendProfileData() {
    $("#edit-profile-form").on("submit", function (e) {
        e.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);

        formData.delete("add_certificate");
        formData.delete("add_license");
        formData.delete("add_portfolio_link");

        formData.append("_token", token);

        const expCount = $("[name='add_experience_count']").val();
        const expTime = $("[name='add_experience_timeframe']").val();
        let experience;

        if (
            (!expCount || expCount.trim() === "") &&
            (!expTime || expTime.trim() === "")
        ) {
            experience = "N/A";
            formData.append("add_experience", experience);
        } else if (
            !expCount ||
            expCount.trim() === "" ||
            !expTime ||
            expTime.trim() === ""
        ) {
            return message(
                "bg-red-100 border-red-500 text-red-700",
                "Failed",
                "Experience must be valid.",
                5000
            );
        } else {
            experience = `${expCount} ${expTime}`;
            formData.append("add_experience", experience);
        }

        const age = $("[name='add_age']").val();
        formData.append("add_age", age);

        const city = "Borongan City";
        formData.append("add_city", city);

        $.ajax({
            type: "POST",
            url: editProfileRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                uploadPortfolio();
                $(
                    "#profile-edit-button, #mobile-edit-profile-button"
                ).removeClass("hidden");
                $(".top-profile").removeClass("hidden").addClass("md:flex");
                location.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    if (xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = Object.values(errors)[0][0];
                        errorMessage = errorMessage.replace(/add[_\s]?/gi, "");
                        message(
                            "bg-red-100 border-red-500 text-red-700",
                            "Failed",
                            errorMessage,
                            5000
                        );
                    } else if (xhr.responseJSON.message) {
                        message(
                            "bg-red-100 border-red-500 text-red-700",
                            "Failed",
                            xhr.responseJSON.message,
                            5000
                        );
                    }
                } else {
                    console.log("Other error:", xhr);
                }
            },
        });
    });
}

function uploadPortfolio() {
    const additionalFile = $("[name='add_file']")[0].files[0];
    const portfolioLink = $("[name='add_portfolio_link']").val() ?? "";

    const formData = new FormData();
    if (additionalFile) formData.append("additional_file", additionalFile);
    if (portfolioLink) formData.append("portfolio_link", portfolioLink);
    formData.append("_token", token);

    if (additionalFile || portfolioLink) {
        $.ajax({
            type: "POST",
            url: uploadPortfolioRoute,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                console.log(response);
            },
            error: function (xhr) {
                console.log(xhr);
            },
        });
    }
}

function getProfileData() {
    $.ajax({
        type: "get",
        url: getDataProfileRoute,
        dataType: "json",
        success: function (response) {
            const portfolio = response.portfolio;
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
            $('[name="email"]').text(email);

            $('[name="followers"]').text(response.followers);
            $('[name="followings"]').text(response.followings);

            $.each(portfolio, function (key, value) {
                if (value.type === "link") {
                    $('a[name="portfolio_link"]').text(value.path);
                }

                if (value.type === "file") {
                    let formatFile = value.path.split("_").pop() ?? "";

                    if (value.path) {
                        const fileUrl = `/storage/${value.path}`;
                        $("#fileName")
                            .text(formatFile)
                            .attr("href", fileUrl)
                            .attr("target", "_blank")
                            .removeClass("hidden");
                    } else {
                        $("#fileName")
                            .text("No File")
                            .removeAttr("href")
                            .attr("target", "")
                            .addClass("hidden");
                    }
                    return;
                }
            });

            const profileDetails = response.profile_details;

            const jobTypes = response.job_types;
            $('[name="job_type"]').text(jobTypes);

            $.each(profileDetails, function (key, value) {
                if (["seeker_id", "account_id"].includes(key)) return;

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
                        const fbLink = value ? value : "#";
                        $('a[name="facebook_link"]')
                            .text(fbLink)
                            .attr("href", fbLink)
                            .attr("target", "_blank");
                        return;
                    }

                    if (key === "resume") {
                        let formatFile = value.split("_").pop() ?? "";

                        if (value) {
                            const resumeUrl = `/storage/${value}`;
                            $("#resumeName")
                                .text(formatFile)
                                .attr("href", resumeUrl)
                                .attr("target", "_blank")
                                .removeClass("hidden");
                        } else {
                            $("#resumeName")
                                .text("No Resume")
                                .removeAttr("href")
                                .attr("target", "")
                                .addClass("hidden");
                        }
                        return;
                    }

                    if (key === "birthday") {
                        const birthday = new Date(value);
                        if (isNaN(birthday)) {
                            console.warn("Invalid date for birthday:", value);
                            return;
                        }

                        const formatted = birthday.toLocaleDateString("en-US", {
                            month: "long",
                            day: "2-digit",
                            year: "numeric",
                        });
                        $target.text(formatted);
                        return;
                    }

                    if ($target.is("input, textarea, select")) {
                        $target.val(value ?? "");
                    } else {
                        $target.text(value ?? "");
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
            const portfolio = response.portfolio;
            const jobTypes = response.job_types || [];

            $.each(portfolio, function (key, value) {
                if (value.type === "link") {
                    $('[name="add_portfolio_link"]').val(value.path);
                }

                if (value.type === "file") {
                    let formatFile = value.path.split("_").pop() ?? "";

                    if (value.path) {
                        $("#filePreview").text("Current : " + formatFile);
                    } else {
                        $("#filePreview").text("Current : No File");
                    }
                }
            });

            const profilePic = data.profile_pic
                ? `/storage/${data.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";
            $("#profile-preview").attr("src", profilePic);

            const resumeFileName = data.resume
                ? data.resume.split("_").pop()
                : "No Resume";
            $("#resumePreview").text("Current : " + resumeFileName);

            $("[name='add_first_name']").val(data.first_name ?? "");
            $("[name='add_mid_name']").val(data.mid_name ?? "");
            $("[name='add_last_name']").val(data.last_name ?? "");
            $("[name='add_suffix']").val(data.suffix ?? "");
            $("[name='add_birthday']").val(data.birthday ?? "");
            $("[name='add_age']").val(data.age ?? "");
            $("[name='add_sex']").val(data.sex ?? "");
            $("[name='add_barangay']").val(data.barangay ?? "");
            $("[name='add_city']").val(data.city ?? "");
            $("[name='add_phone_num']").val(data.phone_num ?? "");
            $("[name='add_facebook_link']").val(data.facebook_link ?? "");
            $("[name='add_expertise']").val(data.expertise ?? "");
            $("[name='add_education']").val(data.education ?? "");
            $("[name='add_about']").val(data.about ?? "");

            if (data.experience) {
                const expParts = data.experience.trim().split(" ");
                if (expParts.length === 2) {
                    $("[name='add_experience_count']").val(expParts[0]);
                    $("[name='add_experience_timeframe']").val(expParts[1]);
                }
            }

            $(".job-type-checkbox").prop("checked", false);
            $("#select-all-job-types").prop("checked", false);

            if (jobTypes.length > 0) {
                jobTypes.forEach(function (jobType) {
                    $(".job-type-checkbox").each(function () {
                        if ($(this).val() === jobType) {
                            $(this).prop("checked", true);
                        }
                    });
                });

                // Check if all job types are selected
                const totalCheckboxes = $(".job-type-checkbox").length;
                const checkedCheckboxes = $(
                    ".job-type-checkbox:checked"
                ).length;
                if (totalCheckboxes === checkedCheckboxes) {
                    $("#select-all-job-types").prop("checked", true);
                }
            }
        },
        error: function (xhr) {
            console.error("Failed to fetch profile data:", xhr);
        },
    });
}

function checkResumeSize() {
    $("[name='add_resume']").on("change", function () {
        const file = this.files[0];

        if (file) {
            const fileSize = file.size;
            const fileInMB = fileSize / (1024 * 1024);

            if (fileInMB > 2) {
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Failed",
                    "Resume must not exceed to 2MB.",
                    5000
                );

                $(this).val("");
                return;
            }
        }
    });

    $("[name='add_file']").on("change", function () {
        const file = this.files[0];

        if (file) {
            const fileSize = file.size;
            const fileInMB = fileSize / (1024 * 1024);

            if (fileInMB > 2) {
                message(
                    "bg-red-100 border-red-500 text-red-700",
                    "Failed",
                    "File must not exceed to 2MB.",
                    5000
                );

                $(this).val("");
                return;
            }
        }
    });
}

function downloadResume() {
    $("#downloadResume").on("click", function (e) {
        e.preventDefault();
        const resumePath = $("#resumeName").attr("href");
        window.location.href = resumePath;
    });

    $("#downloadFile").on("click", function (e) {
        e.preventDefault();
        const filePath = $("#fileName").attr("href");
        window.location.href = filePath;
    });
}

function editProfileButtons() {
    const editButtons = $("#profile-edit-button, #mobile-edit-profile-button");
    const topProfile = $(".top-profile");
    const editForm = $("#edit-profile-form");
    const recentApplied = $("#recent-applied");
    const saved = $(".saved");
    const cancel = $("#profile-cancel-button");
    const save = $("#profile-save-button");

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

function ageGenerator() {
    $("#birthday-input").on("change", function () {
        const birthDate = new Date($(this).val());
        const today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (!isNaN(age) && age >= 0) {
            $("#age").val(age);
        } else {
            $("#age").val("");
        }
    });
}

$(function () {
    checkResumeSize();
    editProfileButtons();
    profileSelectImage();
    ageGenerator();

    jobTypeSelection();
    getEditData();
    getProfileData();
    sendProfileData();

    downloadResume();
});

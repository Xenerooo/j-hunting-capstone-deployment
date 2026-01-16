let employer_id;

function message(color, title, content) {
    $("#message-container").fadeIn();
    $("#message-container").addClass(color);
    $("#message-title").text(title);
    $("#message-content").text(content);

    setTimeout(() => {
        $("#message-container").fadeOut();
    }, 3000);
}

function setWorkLocation() {
    var map = L.map("work_map").setView([11.6075, 125.4312], 19);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap",
    }).addTo(map);

    var marker;

    map.on("click", function (e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        $("#latitude").val(lat);
        $("#longitude").val(lng);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
}

function getEmployerData() {
    $.ajax({
        url: getEmployerDataRoute,
        type: "GET",
        success: function (response) {
            const employerData = response.data;
            employer_id = employerData.employer_id;
            const fullName = `${employerData.first_name ?? ""} ${
                employerData.mid_name ?? ""
            } ${employerData.last_name ?? ""} ${employerData.suffix ?? ""}`;

            const profilePic = employerData.profile_pic
                ? `/storage/${employerData.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

            $("[name='tag_name']").append(
                `<span class="font-semibold">${fullName}</span> | <span class="text-sky-800 font-semibold">${
                    employerData.comp_name ?? "----"
                }</span>`
            );
            $('[name="profile_pic"]').attr("src", profilePic);
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr.responseText);
        },
    });
}

function checkForm(text) {
    return message(
        "bg-red-100 border-red-500 text-red-700",
        "Required Input",
        text
    );
}

function postJob() {
    $("form").on("submit", function (e) {
        e.preventDefault();

        const formData = new FormData($(this).get(0));
        formData.append("_token", token);
        formData.append("employer_id", employer_id);
        formData.delete("tag_name");
        formData.delete("profile_pic");

        // return console.log(formData);

        //pin location
        let lat = $("[name='latitude']").val();
        let long = $("[name='longitude']").val();
        if (lat == "" && long == "") {
            return checkForm("Please pin your exact work location in the map.");
        }
        formData.append("latitude", lat);
        formData.append("longitude", long);

        // job title
        let jobTitle = $("[name='job_title']").val();
        if (jobTitle == "") {
            return checkForm("Please enter the job title.");
        }
        formData.append("job_title", jobTitle);

        // barangay
        let barangay = $("[name='location']").val();
        if (barangay == "") {
            return checkForm("Please select a barangay.");
        }
        const location = `Brgy. ${barangay}, Borongan City`;
        formData.append("location", location);

        // employment type
        let employmentType = $("[name='employment_type']").val();

        if (employmentType == "") {
            return checkForm("Please select a employment type.");
        }
        formData.append("employment_type", employmentType);

        // job type
        let jobType = $("[name='job_type']").val();

        if (jobType == "") {
            return checkForm("Please select a job type.");
        }
        formData.append("job_type", jobType);

        // experience and time frame
        let timeFrame = $("[name='time-frame']").val();
        let experience = $("[name='experience']").val();

        if (experience == "" || timeFrame == "") {
            return checkForm("Please select a experience and time frame.");
        }

        const reqExperience = `${experience} ${timeFrame}`;
        formData.append("experience", reqExperience);

        // qualification
        let qualification = $("[name='qualification']").val();

        if (qualification == "") {
            return checkForm("Please select a qualification.");
        }
        formData.append("qualification", qualification);

        // salary
        let salary = $("[name='salary']").val();

        if (salary == "") {
            return checkForm("Please enter a salary.");
        }
        formData.append("salary", salary);

        $.ajax({
            url: postJobRoute,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success == true) {
                    message(
                        "bg-green-100 border-green-500 text-green-700",
                        "Success!",
                        response.message
                    );

                    const $form = $("#post-job-form");
                    if ($form.length) {
                        $form[0].reset();
                    } else {
                        formData.forEach((value, key) => {
                            if (key !== "_token" && key !== "employer_id") {
                                const $field = $(`[name="${key}"]`);
                                if ($field.is("select")) {
                                    $field.prop("selectedIndex", 0);
                                } else if ($field.is("input")) {
                                    $field.val("");
                                }
                            }
                        });
                    }
                    $("#image-input").val("");
                    $("#image-preview").attr("src", "");
                    $("#preview-container").addClass("hidden");

                    setWorkLocation();
                    return;
                } else {
                    return message(
                        "bg-red-100 border-red-500 text-red-700",
                        "Error!",
                        response.message
                    );
                }
            },
            error: function (xhr) {
                console.error("Failed to post job : ", xhr.responseText);
            },
        });
    });
}

function setJobPhoto() {
    $("#upload-image").on("click", function () {
        $("#image-input").trigger("click");
    });

    $("#image-input").on("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                $("#image-preview").attr("src", event.target.result);
                $("#preview-container").removeClass("hidden");
            };
            reader.readAsDataURL(file);
        }
    });

    $("#remove-image-button").on("click", function () {
        $("#image-input").val("");
        $("#image-preview").attr("src", "");
        $("#preview-container").addClass("hidden");
    });
}

$(function () {
    getEmployerData();
    postJob();
    setWorkLocation();
    setJobPhoto();
});

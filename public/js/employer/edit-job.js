const urlParts = window.location.pathname.split("/");
const jobId = urlParts[urlParts.length - 1];

function setWorkLocation(latitude, longitude, location) {
    latitude = parseFloat(latitude);
    longitude = parseFloat(longitude);

    $("[name='latitude']").val(latitude.toFixed(6));
    $("[name='longitude']").val(longitude.toFixed(6));

    var map = L.map("map").setView([latitude, longitude], 19);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap",
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map).bindPopup(location).openPopup();

    var marker = L.marker([latitude, longitude]).addTo(map);

    map.on("click", function (e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        $("[name='latitude']").val(lat);
        $("[name='longitude']").val(lng);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
}

function getEditData() {
    $.ajax({
        type: "get",
        url: editJobDataRoute,
        data: {
            job_id: jobId,
        },
        dataType: "json",
        success: function (response) {
            const data = response.data;
            const employerData = data.employer;
            const jobType = response.job_type;
            console.log(response);

            const fullName = `${employerData.first_name ?? ""} ${
                employerData.mid_name ?? ""
            } ${employerData.last_name ?? ""} ${employerData.suffix ?? ""}`;

            const profilePic = employerData.profile_pic
                ? `/storage/${employerData.profile_pic}`
                : "https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg";

            const fullAddress = data.location;
            const parts = fullAddress.replace("Brgy. ", "").split(",");
            const location = parts[0].trim();

            const experience = data.experience_level;
            const split = experience.split(" ");
            const expNumber = split[0].trim();
            const expTimeFrame = split[1].trim();

            const datePosted = data.created_at.split(" ")[0];
            const posted = new Date(datePosted);
            const formatted = posted.toLocaleDateString("en-US", {
                month: "long",
                day: "2-digit",
                year: "numeric",
            });

            const deadline = data.deadline_at.split(" ")[0];
            const deadlineDate = new Date(deadline);

            const year = deadlineDate.getFullYear();
            const month = String(deadlineDate.getMonth() + 1).padStart(2, "0");
            const day = String(deadlineDate.getDate()).padStart(2, "0");

            const formattedDeadline = `${year}-${month}-${day}`;

            const jobPhoto = data.job_photo ? `/storage/${data.job_photo}` : "";

            if (jobPhoto) {
                $("#preview-container").removeClass("hidden");
                $("#image-preview").attr("src", jobPhoto);
                $("#job_photo").val(jobPhoto);
            }

            setWorkLocation(data.latitude, data.longitude, data.location);

            $("[name='tag_name']").append(
                `<span class="font-semibold">${fullName}</span> | <span class="text-sky-800 font-semibold">${employerData.comp_name}</span>`
            );
            $('[name="profile_pic"]').attr("src", profilePic);
            $('[name="latitude"]').val(data.latitude);
            $('[name="longitude"]').val(data.longitude);

            $('[name="job_title"]').val(data.title);
            $('[name="location"]').val(location);
            $('[name="description"]').val(data.description);
            $('[name="employment_type"]').val(data.employment_type);
            $('[name="job_type"]').val(jobType);
            $('[name="experience"]').val(expNumber);
            $('[name="time-frame"]').val(expTimeFrame);
            $('[name="qualification"]').val(data.education_level);
            $('[name="max_applicant"]').val(data.max_applicant);
            $('[name="salary"]').val(data.expected_salary);
            $('[name="salary_basis"]').val(data.salary_basis);
            $('[name="date_posted"]').text(formatted);
            $('[name="expiration_date"]').val(formattedDeadline);
        },
        error: function (xhr) {
            console.error("Failed to fetch data : ", xhr.responseJSON);
        },
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

function editJob() {
    $("form").on("submit", function (e) {
        e.preventDefault();

        const formData = new FormData($(this).get(0));
        formData.append("_token", token);
        formData.delete("tag_name");
        formData.delete("profile_pic");

        const location = `Brgy. ${$("[name='location']").val()}, Borongan City`;
        formData.append("location", location);
        formData.append("job_id", jobId);

        const experience =
            `${$("[name='experience']").val()} ${$(
                "[name='time-frame']"
            ).val()}` ?? "N/A";

        formData.append("experience", experience);

        $.ajax({
            url: updateJobRoute,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success) {
                    message(
                        "bg-green-100 border-green-500 text-green-700",
                        "Success!",
                        response.message
                    );
                    window.location.href = goBackRoute;
                    setWorkLocation();
                } else {
                    message(
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

$(function () {
    getEditData();
    setJobPhoto();
    editJob();
});

function loginModal() {
    $("#login-button, #mobile-login-button").on("click", function (e) {
        e.preventDefault();
        $("#login-modal").fadeIn();
    });

    $("#login-modal-close").on("click", function (e) {
        e.preventDefault();
        $("#login-modal").fadeOut();
    });
}

function registration() {
    let currentStep = parseInt($("#step-input").val()) || 1;
    const totalSteps = $(".step-content").length;

    function showStep(step) {
        $(".step-content").addClass("hidden");
        $(`.step-content[data-step="${step}"]`).removeClass("hidden");

        $("#prev-button").prop("disabled", step === 1);
        $("#next-button").toggle(step < totalSteps);
        $("#submit-button").toggle(step === totalSteps);

        $("#step-input").val(step);

        $(".step").each(function () {
            const s = +$(this).data("step");
            const circle = $(this).find("div:first");

            if (s < step) {
                circle.addClass("bg-sky-600 text-white border-sky-600");
            } else if (s === step) {
                circle
                    .addClass("border-sky-600 text-sky-600")
                    .removeClass("bg-sky-600 text-white");
            } else {
                circle.removeClass(
                    "bg-sky-600 text-white border-sky-600 text-sky-600"
                );
            }
        });
    }

    $("#next-button").on("click", function () {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $("#prev-button").on("click", function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
}

function scrollNav() {
    const sections = ["#home", "#new-jobs", "#new-employers", "#about"];
    let observer;
    let manuallyNavigated = false;

    function setActiveLink(id) {
        $(".top-nav-link").each(function () {
            const link = $(this).data("link");
            if (link === id) {
                $(this)
                    .removeClass("text-gray-800 hover:bg-sky-100")
                    .addClass("text-gray-50 bg-sky-600");
            } else {
                $(this)
                    .removeClass("text-gray-50 bg-sky-600")
                    .addClass("text-gray-800 hover:bg-sky-100");
            }
        });
    }

    // Smooth scroll and prevent observer spam
    $(".top-nav-link").on("click", function (e) {
        e.preventDefault();
        const target = $(this).data("link");
        manuallyNavigated = true;
        setActiveLink(target);

        const targetElement = document.querySelector(target);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 64, // adjust if nav has height
                behavior: "smooth",
            });
        }

        // Re-enable after scroll finishes
        setTimeout(() => {
            manuallyNavigated = false;
        }, 800); // matches scroll duration
    });

    // Intersection Observer
    observer = new IntersectionObserver(
        (entries) => {
            if (manuallyNavigated) return; // skip during manual click scroll

            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setActiveLink("#" + entry.target.id);
                    history.replaceState(null, "", "#" + entry.target.id);
                }
            });
        },
        {
            threshold: 0.6, // Adjust how deep the section must be visible
        }
    );

    // Observe sections
    sections.forEach((id) => {
        const section = document.querySelector(id);
        if (section) observer.observe(section);
    });

    // Initial check on load
    setActiveLink(window.location.hash || "#home");
}

function fileUpload() {
    $("#doc-input").on("change", function () {
        const file = this.files[0];
        $("#doc-preview").text(file ? `Selected: ${file.name}` : "");
    });
}

function businessPermitUpload() {
    $("#select-business-permit").on("change", function () {
        const file = this.files[0];
        $("#preview-business-permit").text(
            file ? `Selected: ${file.name}` : ""
        );
    });
}

function profileUpload() {
    $("#profile-preview, #employer-profile-preview").on("click", function () {
        $("#select-profile, #employer-select-profile").click();
    });

    $("#select-profile, #employer-select-profile").on("change", function () {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            $("#profile-preview, #employer-profile-preview").attr(
                "src",
                e.target.result
            );
        };
        reader.readAsDataURL(file);
    });
}

function logoUpload() {
    $("#logo-preview").on("click", function () {
        $("#select-logo").click();
    });

    $("#select-logo").on("change", function () {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            $("#logo-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
    });
}

function validIdUpload() {
    $("#valid-id-preview").on("click", function () {
        $("#select-valid-id").click();
    });

    $("#select-valid-id").on("change", function () {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            $("#valid-id-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
    });
}



$(function () {
    loginModal();
    registration();
    fileUpload();
    profileUpload();
    logoUpload();
    validIdUpload();
    businessPermitUpload();
    setOfficeLocation();
});

function adminDashboardChart() {
    function loadChart(year, userType) {
        $.ajax({
            url: registeredPageRoute,
            method: "GET",
            dataType: "json",
            data: {
                year: year,
                user_type: userType,
            },
            success: function (response) {
                renderChart(response.labels, response.data);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function renderChart(labels, data) {
        const ctx = $("#registrationChart")[0].getContext("2d");

        if (registrationChart instanceof Chart) {
            registrationChart.destroy();
        }

        registrationChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Monthly Registrations",
                        data: data,
                        backgroundColor: "#00598a",
                        borderRadius: 5,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                    },
                },
            },
        });
    }

    const initialYear = $("#yearInput").val();
    const initialType = $("#selectedUserType").val();
    loadChart(initialYear, initialType);

    $("#yearInput, #selectedUserType").on("change", function () {
        const year = $("#yearInput").val();
        const type = $("#selectedUserType").val();
        loadChart(year, type);
    });

    $("#downloadExcel").on("click", function () {
        const year = $("#yearInput").val();
        const userType = $("#selectedUserType").val();

        const url = `/admin/download-registration-excel?year=${year}&user_type=${userType}`;
        window.open(url, "_blank");
    });
}

function show() {
    $.ajax({
        type: "GET",
        url: totalPageRoute,
        dataType: "json",
        success: function (response) {
            $("#jobSeekerTotal").text(response.job_seeker_total);
            $("#employerTotal").text(response.employer_total);
            $("#jobsTotal").text(response.jobs_total);
        },
        error: function (error) {
            console.log(error);
        },
    });
}

$(function () {
    show();
    adminDashboardChart();
});

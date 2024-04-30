// Avgt
document.addEventListener("DOMContentLoaded", function () {
    var url = window.location.href;
    var dataType = url.split("/").pop();

    fetch("/api/data/" + dataType)
        .then((response) => response.json())
        .then((data) => {
            var labels = [];
            var avgtData = [];

            Object.keys(data).forEach((key) => {
                var item = data[key];
                labels.push(key);
                avgtData.push(item.avgt);
            });

            var ctx = document.getElementById("lineChartAvgt").getContext("2d");
            var lineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "avgt",
                            data: avgtData,
                            borderColor: "rgb(255, 99, 132)",
                            borderWidth: 1,
                            fill: false,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        })
        .catch((error) => console.error("Error:", error));
});

// Avgh
document.addEventListener("DOMContentLoaded", function () {
    var url = window.location.href;
    var dataType = url.split("/").pop();

    fetch("/api/data/" + dataType)
        .then((response) => response.json())
        .then((data) => {
            var labels = [];
            var avghData = [];

            Object.keys(data).forEach((key) => {
                var item = data[key];
                labels.push(key);
                avghData.push(item.avgh);
            });

            var ctx = document.getElementById("lineChartAvgh").getContext("2d");
            var lineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "avgh",
                            data: avghData,
                            borderColor: "rgb(54, 162, 235)",
                            borderWidth: 1,
                            fill: false,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        })
        .catch((error) => console.error("Error:", error));
});

document.addEventListener("DOMContentLoaded", function () {
    var url = window.location.href;
    var dataType = url.split("/").pop();

    fetch("/api/data/" + dataType)
        .then((response) => response.json())
        .then((data) => {
            var labels = [];
            var avgtData = [];
            var avghData = [];

            Object.keys(data).forEach((key) => {
                var item = data[key];
                labels.push(key);
                avgtData.push(item.avgt);
                avghData.push(item.avgh);
            });

            // Avgt Chart
            var ctxAvgt = document.getElementById("lineChartAvgt").getContext("2d");
            var lineChartAvgt = new Chart(ctxAvgt, {
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

            // Avgh Chart
            var ctxAvgh = document.getElementById("lineChartAvgh").getContext("2d");
            var lineChartAvgh = new Chart(ctxAvgh, {
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

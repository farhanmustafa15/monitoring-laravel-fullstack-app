document.addEventListener('DOMContentLoaded', function() {
    var url = window.location.href;
    var dataType = url.split('/').pop();

    fetch('/api/data/' + dataType)
    .then(response => response.json())
    .then(data => {
        var labels = [];
        var avgtData = [];
        var avghData = [];

        // Iterate over each object in the JSON data
        Object.keys(data).forEach(key => {
            var item = data[key];
            labels.push(key); // Assuming 'key' is the label, like '1', '2', etc.
            avgtData.push(item.avgt);
            avghData.push(item.avgh);
        });

        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Use the 'labels' array constructed above
                datasets: [
                    {
                        label: 'avgt',
                        data: avgtData,
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'avgh',
                        data: avghData,
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error:', error));
});

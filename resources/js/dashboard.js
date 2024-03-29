
// separate
document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL
    var url = window.location.href;

    // Parse the URL to get the data type
    var dataType = url.split('/').pop();

    // Fetch data based on the data type
    fetch('/api/data/' + dataType)
    .then(response => response.json())
    .then(data => {
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['avgt', 'avgh'], // labels are 'avgt' and 'avgh'
                datasets: [{
                    label: 'avgt',
                    data: [data.avgt], // data is the 'avgt' value
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'avgh',
                    data: [data.avgh], // data is the 'avgh' value
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1,
                    fill: false
                }]
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


// combine
// document.addEventListener('DOMContentLoaded', function() {
//     // Get the current URL
//     var url = window.location.href;

//     // Parse the URL to get the data type
//     var dataType = url.split('/').pop();

//     // Fetch data based on the data type
//     fetch('/api/data/' + dataType)
//     .then(response => response.json())
//     .then(data => {
//         var ctx = document.getElementById('lineChart').getContext('2d');
//         var lineChart = new Chart(ctx, {
//             type: 'line',
//             data: {
//                 labels: ['avgt', 'avgh'], // labels are 'avgt' and 'avgh'
//                 datasets: [{
//                     label: 'Values',
//                     data: [data.avgt, data.avgh], // data is the 'avgt' and 'avgh' values
//                     borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
//                     borderWidth: 1,
//                     fill: false
//                 }]
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true
//                     }
//                 }
//             }
//         });
//     })
//     .catch(error => console.error('Error:', error));
// });


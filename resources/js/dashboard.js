var ctx = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['RumahJamur', 'TugasAkhir'],
        datasets: [{
            label: 'avgt',
            data: [27, 26.2],
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1,
            fill: false
        }, {
            label: 'avgh',
            data: [55, 69.75],
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



















// document.getElementById('rumahJamurButton').addEventListener('click', function() {
//     // Make an AJAX request to fetch the Rumah Jamur data
//     // Update the line chart with the fetched data
//     let labels = ['avgt', 'avgh']; // Example labels
//     let data = [25, 30]; // Example data
//     updateLineChart(labels, data);
// });

// document.getElementById('tugasAkhirButton').addEventListener('click', function() {
//     // Make an AJAX request to fetch the Tugas Akhir data
//     // Update the line chart with the fetched data
//     let labels = ['avgt', 'avgh']; // Example labels
//     let data = [30, 35]; // Example data
//     updateLineChart(labels, data);
// });



// $(document).ready(function() {
//     var ctx = document.getElementById('lineChart').getContext('2d');
//     var lineChart = new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: [],
//             datasets: [{
//                 label: 'avgt',
//                 data: [],
//                 borderColor: 'rgb(255, 99, 132)',
//                 borderWidth: 1,
//                 fill: false
//             }, {
//                 label: 'avgh',
//                 data: [],
//                 borderColor: 'rgb(54, 162, 235)',
//                 borderWidth: 1,
//                 fill: false
//             }]
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });

//     $('#dropdownDefaultButton').on('click', function() {
//         var dataType = $(this).data('type');
//         $.get('/admin/dashboard/' + dataType, function(data) {
//             lineChart.data.labels = Object.keys(data);
//             lineChart.data.datasets[0].data = Object.values(data['avgt']);
//             lineChart.data.datasets[1].data = Object.values(data['avgh']);
//             lineChart.update();
//         });
//     });
// });
document.addEventListener("DOMContentLoaded", function () {
    const ctxPie = document.getElementById('myCharts').getContext('2d');

    fetch("graph.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data);

            if (!Array.isArray(data)) {
                console.error("Error: Expected an array but got:", data);
                return; 
            }

            processDataAndCreateChart(data, 'pie');
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });

    function processDataAndCreateChart(chartData, type) {
        const statusCounts = {};

        // Looping the data and count each delivery status
        chartData.forEach(order => {
            if (!order.hasOwnProperty("del_status")) {
                console.error("Invalid data format:", order);
                return;
            }
            const status = order.del_status.toLowerCase();
            statusCounts[status] = (statusCounts[status] || 0) + 1;
        });

        console.log("Processed Status Counts:", statusCounts);  

        const labels = Object.keys(statusCounts);  
        const values = Object.values(statusCounts); 

        new Chart(ctxPie, {
            // Chart type is pie
            type: type,  
            data: {
                labels: labels, 
                datasets: [{
                    label: 'Orders', 
                    data: values, 
                    backgroundColor: ['orange', 'red', 'yellow'],  
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }
});

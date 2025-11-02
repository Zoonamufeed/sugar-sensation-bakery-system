const ctxLine = document.getElementById('my').getContext('2d');

        fetch("charts.php")
            .then((response) => response.json())
            .then((data) => {
                console.log(data); 
                processDataAndCreateChart(data);
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
            });

        function processDataAndCreateChart(chartData) {
            // Creating arrays for months and revenue
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const revenue = [];

            for (let i = 1; i <= 12; i++) {
                revenue.push(chartData[i] || 0); 
            }

            // Create the chart
            new Chart(ctxLine, {
                type: 'line', 
                data: {
                    labels: months,  
                    datasets: [{
                        label: 'Total Revenue',
                        data: revenue, 
                        borderColor: 'rgb(244, 44, 44)',
                        backgroundColor: 'rgba(192, 75, 75, 0.2)',
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }


<?php
session_start();
include 'includes/databaseconnect.php';
// Initialize variables
$start_date = "";
$end_date = "";
$customers = [];
// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
        // count is used to count the total amount of the order
    //min is refered as the created date and max is created as the last date
    // where keyword is used to filter the start date and end date 
    // question mark is presernt to get the value.
    // group keyword is used to get the results by the user_id of the customer table
    //order by keyword is used to show the descending order
    $query = "
        SELECT 
            u.full_name AS customer_name, 
            u.email AS customer_email, 
            COUNT(o.id) AS total_orders,
            MIN(o.created_at) AS first_order,
            MAX(o.created_at) AS last_order
        FROM `order` o
        JOIN `users` u ON o.user_id = u.id
        WHERE o.created_at BETWEEN ? AND ?
        GROUP BY o.user_id
        ORDER BY total_orders DESC
        LIMIT 3;
    ";
    // Prepareing and executeing while stmt is used to prevent sql injection and ss is converted to string
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
     // Fetching the results
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loyal Customer Report</title>
    <?php include "includes/header_links.php"; ?>
    <link rel="stylesheet" href="css/revenureport.css">
    <link rel="stylesheet" href="css/homead.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include 'includes/adminnavbar.php'; ?>

<div class="report-container">
    <h2>Loyal Customer Report</h2>

    <form action="" method="POST">
        <div class="inputBox">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>
        <div class="inputBox">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn_now">Generate Report</button>
    </form>
    <!-- Pie Chart -->
        <div class="chart-container" style="width:100%; height:70%;">
            <canvas id="loyalCustomerChart"></canvas>
        </div>

    <!-- checking if the form is submited using post and checks if teh customer array is not empty -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($customers)) : ?>
        <table id="customerTable">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Total Orders</th>
                    <th>First Order Date</th>
                    <th>Last Order Date</th>
                    <button onclick="window.print()">Print Report</button>
                    <button onclick="exportTableToExcel('customerTable', 'loyal_customers')">Export to Excel</button>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $customer['customer_name'] ?></td>
                    <td><?= $customer['customer_email'] ?></td>
                    <td><?= $customer['total_orders'] ?></td>
                    <td><?= $customer['first_order'] ?></td>
                    <td><?= $customer['last_order'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No customers found for the selected date range.</p>
    <?php endif; ?>
</div>

<?php include "includes/adminfooter.php"; ?>

<script>
function exportTableToExcel(tableID, filename = ''){
    //creating link
    const downloadLink = document.createElement("a");
    //changing to vnd.ms-excel type
    const dataType = 'application/vnd.ms-excel';
    // calling the table by id
    const tableSelect = document.getElementById(tableID);
    // Get HTML of the table and encode spaces for UR
    const tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify filename
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link and Create a data URL with the table HTML
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    downloadLink.download = filename;

    // Trigger the download
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
// Draw pie chart if data exists
<?php if (!empty($customers)) : ?>
const ctx = document.getElementById('loyalCustomerChart').getContext('2d');
const customerNames = <?= json_encode(array_column($customers, 'customer_name')) ?>;
const orderCounts = <?= json_encode(array_column($customers, 'total_orders')) ?>;
const backgroundColors = ['orange', 'brown', 'yellow']; // Different colors for each pie

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: customerNames,
        datasets: [{
            data: orderCounts,
            backgroundColor: backgroundColors,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    color: '#333',
                    font: { size: 14 }
                }
            },
           
        }
    }
});
<?php endif; ?>
</script>

</body>
</html>

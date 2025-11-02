<?php
include 'includes/databaseconnect.php';

// Initialize variables
$total_revenue = 0;
$start_date = "";
$end_date = "";
$orders = [];

// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    // Fetch all orders within the dates
    $query = "SELECT id, name, total_price, created_at FROM `order` 
              WHERE created_at BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
        // Calculate total revenue
        $total_revenue += $row['total_price']; 
    }

    // Prepare revenue aggregated by date
    $revenue_by_date = [];
    foreach ($orders as $order) {
        $date = date('Y-m-d', strtotime($order['created_at']));
        if (!isset($revenue_by_date[$date])) {
            $revenue_by_date[$date] = 0;
        }
        $revenue_by_date[$date] += $order['total_price'];
    }
    ksort($revenue_by_date);
    $chart_labels = array_keys($revenue_by_date);
    $chart_data   = array_values($revenue_by_date);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <title>Revenue Report</title>
    <link rel="stylesheet" href="css/revenureport.css">
    <link rel="stylesheet" href="css/homead.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include 'includes/adminnavbar.php'; ?>

<div class="report-container">
    <h2>Monthly Revenue Report</h2>
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

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <!-- Chart Canvas -->
        <div class="chart-container" style="width:100%; height:350px; margin:20px auto;">
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Revenue Table -->
        <table id="reveueTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo htmlspecialchars($order['name']); ?></td>
                        <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Total Revenue -->
                <tr>
                    <td colspan="2"><strong>Total Revenue</strong></td>
                    <td colspan="2"><strong style="color:red;">$<?php echo number_format($total_revenue, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <button onclick="window.print()">Print Report</button>
        <button onclick="exportTableToExcel('reveueTable', 'sales_Report')">Export to Excel</button>
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
// geeting Chart.js if data is available
<?php if (!empty($chart_labels)): ?>
    const revenueLabels = <?php echo json_encode($chart_labels); ?>;
    const revenueData   = <?php echo json_encode($chart_data);   ?>;
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Revenue',
                data: revenueData,
                backgroundColor: 'rgba(255, 165, 0, 0.5)',
                borderColor:     'rgba(255, 165, 0, 1)',
                fill: true
            }]
        },
        options: {
            scales: {
                x: { title: { display: true, text: 'Date' } },
                y: { beginAtZero: true, title: { display: true, text: 'Revenue ($)' } }
            }
        }
    });
<?php endif; ?>
</script>
</body>
</html>

<?php
session_start();
include 'includes/databaseconnect.php';

// Best-selling products query
$query = "
    SELECT 
        TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(o.total_products, ',', n.n), '(', 1)) AS product_name,
        COUNT(*) AS total_orders,
        SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.total_products, '(', -1), ')', 1) AS UNSIGNED)) AS total_quantity_sold,
        SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(o.total_products, '(', -1), ')', 1) AS UNSIGNED) * p.price) AS total_revenue
    FROM `order` o
    JOIN (
        SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
        UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10
    ) n ON CHAR_LENGTH(o.total_products) - CHAR_LENGTH(REPLACE(o.total_products, ',', '')) >= n.n - 1
    LEFT JOIN `products` p ON TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(o.total_products, ',', n.n), '(', 1)) = p.name
    GROUP BY product_name
    ORDER BY total_quantity_sold DESC;
";
$result = mysqli_query($conn, $query);

// Fetch all rows into an array for reuse
$products = [];
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    $labels[]   = $row['product_name'];
    $data[]     = (int)$row['total_quantity_sold'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <title>Best-Selling Products Report</title>
    <link rel="stylesheet" href="css/productsales.css">
    <link href="css/homead.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include 'includes/adminnavbar.php'; ?>

<div class="chart-container" style="width: 80%; margin: 40px auto;">
    <canvas id="bestSellingChart"></canvas>
</div>

<div class="report-container">
    <h2>Best-Selling Products Report</h2>

    <table id="bestSelling">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Total Orders</th>
                <th>Total Quantity Sold</th>
                <th>Total Revenue ($)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= number_format($row['total_orders']) ?></td>
                        <td><?= number_format($row['total_quantity_sold']) ?></td>
                        <td>$<?= number_format($row['total_revenue'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="empty">No sales data available</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button onclick="window.print()">Print Report</button>
    <button onclick="exportTableToExcel('bestSelling', 'BestSelling_Products')">Export to Excel</button>
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
// Inject PHP arrays into JS
const labels = <?php echo json_encode($labels); ?>;
const data   = <?php echo json_encode($data);   ?>;

const ctx = document.getElementById('bestSellingChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Units Sold',
            data: data,
            backgroundColor: 'rgba(255, 165, 0, 0.5)', 
            borderColor:     'rgba(255, 165, 0, 1)',    
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Quantity Sold' }
            }
        }
    }
});
</script>
</body>
</html>

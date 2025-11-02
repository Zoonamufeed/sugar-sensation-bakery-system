<?php
session_start();
include 'includes/databaseconnect.php';

// Best-selling products query based on the cart table
$query = "
    SELECT 
        p.name AS product_name,
        COUNT(c.product_id) AS total_orders,
        SUM(c.quantity) AS total_quantity_sold,
        SUM(c.quantity * p.price) AS total_revenue
    FROM cart c
    JOIN products p ON c.product_id = p.id
    GROUP BY p.id
    ORDER BY total_quantity_sold DESC;
";

// Execute the query and check for errors
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <title>Best-Selling Products Report</title>
    <link rel="stylesheet" href="css/productsales.css">
    <link href="css/homead.css" rel="stylesheet" />
</head>
<body>

<?php include 'includes/adminnavbar.php'; ?>

<div class="report-container">
    <h2>Best-Selling Products Report</h2>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Total Orders</th>
                <th>Total Quantity Sold</th>
                <th>Total Revenue ($)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['product_name']) . "</td>
                            <td>" . number_format($row['total_orders']) . "</td>
                            <td>" . number_format($row['total_quantity_sold']) . "</td>
                            <td>$" . number_format($row['total_revenue'], 2) . "</td>
                          </tr>";
                }
            } else {
                echo '<tr><td colspan="4" class="empty">No sales data available</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <button onclick="window.print()">Print Report</button>
</div>

<?php include "includes/adminfooter.php"; ?>

</body>
</html>

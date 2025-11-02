<?php
session_start();
include 'includes/databaseconnect.php';

// Fetch order summary data
$query = "
    SELECT 
        COUNT(o.id) AS total_orders, 
        SUM(o.total_price) AS total_revenue,
        SUM(CASE WHEN d.del_status = 'delivered' THEN 1 ELSE 0 END) AS completed_orders,
        SUM(CASE WHEN d.del_status = 'Pending' THEN 1 ELSE 0 END) AS pending_orders,
        SUM(CASE WHEN d.del_status = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled_orders
    FROM `order` o
    LEFT JOIN `delivery` d ON o.id = d.order_id
";

// $query = "
//     SELECT 
//         (SELECT COUNT(*) FROM `order`) AS total_orders, 
//         SUM(o.total_price) AS total_revenue,
//         COUNT(CASE WHEN d.del_status = 'delivered' THEN 1 END) AS completed_orders,
//         COUNT(CASE WHEN d.del_status = 'Pending' THEN 1 END) AS pending_orders,
//         COUNT(CASE WHEN d.del_status = 'Cancelled' THEN 1 END) AS cancelled_orders
//     FROM `order` o
//     LEFT JOIN `delivery` d ON o.id = d.order_id
// ";


$result = mysqli_query($conn, $query);
$summary = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <title>Order Summary Report</title>
    <link rel="stylesheet" href="css/reports.css"> 
    <link href="css/homead.css" rel="stylesheet" />
</head>
<body>

<?php include 'includes/adminnavbar.php'; ?>

<div class="report-container">
    <h2>Order Summary Report</h2>

    <div class="summary-cards">
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo number_format($summary['total_orders']); ?></p>
        </div>
        <div class="card">
            <h3>Total Revenue</h3>
            <p>$<?php echo number_format($summary['total_revenue'], 2); ?></p>
        </div>
        <div class="card">
            <h3>Completed Orders</h3>
            <p><?php echo number_format($summary['completed_orders']); ?></p>
        </div>
        <div class="card">
            <h3>Pending Orders</h3>
            <p><?php echo number_format($summary['pending_orders']); ?></p>
        </div>
        <div class="card cancelled">
            <h3>Cancelled Orders</h3>
            <p><?php echo number_format($summary['cancelled_orders']); ?></p>
        </div>
    </div>

    <button  onclick="window.print()">Print Report</button>
</div>

<?php include "includes/adminfooter.php"; ?>

</body>
</html>

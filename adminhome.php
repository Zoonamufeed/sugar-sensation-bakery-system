<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet" />
    <link href="css/adminhome.css" rel="stylesheet" />
    <link href="css/charts.css" rel="stylesheet"/>
    <title>Manage Deliveries</title>
</head>
<body>
<?php include 'includes/adminnavbar.php'; ?>
<div class="treat">
    <img src="img\3.jpg" alt="treatimage">
    <p>"Fuel Your Day with a Touch of Sweetness!"</p>
</div>
<div class="reports">
    <h1>Reports</h1>
    <div>
    <div class="pop"><a href="report.php"><img class="display-report" src="img/sales.png" alt="sales report"></a></div>
    <div class="pop"><a href="report.php"><img class="display-report" src="img/vsit.png" alt="visit report"></a></div>
    <div class="pop"><a href="report.php"><img class="display-report" src="img/earn.png" alt="earn report"></a></div>
    <div class="pop"><a href="report.php"><img class="display-report" src="img/cart.png" alt="cart report"></a></div>
</div>
</div>
<div class="visual">
    <div class="line">
        <canvas id="my"></canvas>
    </div>
    <div class="chart pie">
        <h1>Todays Order status </h1>
        <canvas id="myCharts"></canvas>
    </div>
</div>

<?php include "includes/adminfooter.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/chart.js"></script> 
<script src="js/graph.js"></script>
</body>
</html>
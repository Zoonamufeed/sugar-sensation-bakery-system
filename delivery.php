<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/delivery.css" rel="stylesheet"/>
    <?php
    include "includes/header_links.php";
    ?>
    <title>Delivery</title>
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="delivery">
<div class="containers">
    <div class="detailed">
        <div class="order">
        <h1>Order <span> 10</span></h1>
</div>
<div class="date">
    <p>Expected Arrival 02/02/2025</p>
    <pCODE<b>2134235435346356</b></p>
</div>
</div>
<div class="track">
    <ul id="progress" class="text-center">
        <li class="active"></li>
        <li class="active"></li>
        <li class="active"></li>
        <li class=""></li>
</ul>
</div> 
<div class="lists">
    <div class="list">
        <img src="img/CheckList.png" alt="checklist">
        <p>Order<br>Processed</p>   
</div>
<div class="list">
        <img src="img/Shipping.png" alt="checklist">
        <p>Order<br>Shipped</p>   
</div>
<div class="list">
        <img src="img/Delivery.png" alt="checklist">
        <p>Order<br>Route</p>   
</div>
<div class="list">
        <img src="img/Home.png" alt="checklist">
        <p>Order<br>Arrived</p>   
</div>
</div>
</div>
<?php include "includes/footer.php"; ?>
</body>    
</html>
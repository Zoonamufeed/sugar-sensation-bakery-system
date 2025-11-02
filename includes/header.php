<?php
include 'includes/databaseconnect.php';

$select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['full_name'] : "Guest";

// Checking if the order is placed for delivery
$orderPlaced = isset($_SESSION['order_placed']) && $_SESSION['order_placed'];
?>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-links">
        <a href="main.php">Home</a>
        <a href="products.php">Menu</a>
        <a href="aboutus.php">About</a>
        <a href="contact.php">Contact</a>
    </div>

    <div class="logo-container">
        <img src="img/sslogo.png" alt="Logo">
    </div>

    <div class="right-nav">
        <form id="search-form" class="form-inline" role="search" onsubmit="search(event)">
            <input type="text" class="form-control" id="search-input" placeholder="Search" style="width:150px;">
            <button type="submit" class="btn-default">Search</button>
        </form>

        <?php if ($isLoggedIn): ?>
            <!-- If the user is logged in -->
            <span class="nav-name">Hi, <?php echo $_SESSION['full_name']; ?></span>
            <a href="logout.php">
                <span class="glyphicon glyphicon-log-out"></span> Logout
            </a>
            <a href="shoppingcart.php" class="cart">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span class="cart-count"><?php echo $row_count; ?></span>
            </a>
            <a href="delivery.php" 
               <?php if (!$orderPlaced): ?>
                   onclick="alert('No order placed yet!'); return false;"
               <?php endif; ?>>
                <img src="img/delivery.jpg" alt="Delivery">
            </a>
            <a href="view_history.php">View History</a>
        <?php else: ?>
            <!-- If the user is not logged in -->
            <a href="#signup-container"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
            <a href="#login-container"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            <a href="shoppingcart.php" class="cart">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span class="cart-count"><?php echo $row_count; ?></span>
            </a>
        <?php endif; ?>
    </div>
</nav>

<div id="loading" style="display:none;">Loading...</div>

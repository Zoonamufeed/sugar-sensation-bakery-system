<?php
session_start();
include 'includes/databaseconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch orders with status from delivery table
$order_query = mysqli_query($conn, 
    "SELECT o.id, o.total_products, o.total_price, d.del_status 
     FROM `order` o
     LEFT JOIN `delivery` d ON o.id = d.order_id
     WHERE o.user_id = '$user_id'
     ORDER BY o.id DESC"
) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <link href="css/viewhistory.css" rel="stylesheet"/>
    <title>Your Orders</title>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="order-history-content">
    <h2>Your Order History</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Products Ordered</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($order_query) > 0) {
                while ($order = mysqli_fetch_assoc($order_query)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td class="product-list">
                        <div class="product-images">
                            <?php
                            $product_list = explode(', ', $order['total_products']);
                            foreach ($product_list as $product_detail) {
                                preg_match('/(.*?) \((\d+)\)/', $product_detail, $matches);
                                if (isset($matches[1]) && isset($matches[2])) {
                                    $product_name = $matches[1];
                                    $quantity = $matches[2];

                                    // Fetch product details
                                    $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '$product_name' LIMIT 1");
                                    if ($product = mysqli_fetch_assoc($product_query)) {
                                        echo "<div class='product-item'>
                                                <img src='uploaded_img/" . htmlspecialchars($product['image']) . "' 
                                                     alt='" . htmlspecialchars($product['name']) . "' class='product-image'>
                                                <span>" . htmlspecialchars($product['name']) . " ({$quantity})</span>
                                              </div>";
                                    } else {
                                        echo "<span>" . htmlspecialchars($product_name) . " ({$quantity})</span>";
                                    }
                                }
                            }
                            ?>
                            </div>
                        </td>
                        <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['del_status']); ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4" class="empty">No orders found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<?php
    include "includes/footer.php";
    ?>
</body>
</html>

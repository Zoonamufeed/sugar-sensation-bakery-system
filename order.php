<?php
session_start();
include 'includes/databaseconnect.php';

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    
    // Check the status of the checkbox
    if (isset($_POST['status_checkbox']) && $_POST['status_checkbox'] == '1') {
        // If checkbox is checked, set status to 1
        $update_query = "UPDATE `order` SET `status` = 1 WHERE `id` = '$order_id'";
    } else {
        // If checkbox is unchecked, set status to 0
        $update_query = "UPDATE `order` SET `status` = 0 WHERE `id` = '$order_id'";
    }

    // Execute the query
    $result = mysqli_query($conn, $update_query);
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    // Redirect to the order page after update
    header('Location: order.php');
    exit;
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id") or die('Query failed');
    if ($delete_query) {
        $_SESSION['message'] = 'Order has been deleted';
    } else {
        $_SESSION['message'] = 'Order could not be deleted';
    }
    header('location:order.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet"/>
    <link href="css/order.css" rel="stylesheet"/>
    <title>Order Details</title>
</head>
<body>
<?php
if (isset($_SESSION['message'])) {
    echo '<div class="message"><span>' . $_SESSION['message'] . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    unset($_SESSION['message']);
}
?>

<!-- Navbar -->
<?php include 'includes/adminnavbar.php'; ?>

<div class="op_content">
    <h2>Orders Placed</h2>
    <table>
        <thead>
            <th>Customer Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Product and Quantity</th>
            <th>Status</th>
            <th>Delivery Time</th> 
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            // Fetch order and delivery details with JOIN query
            $order_query = mysqli_query($conn, "SELECT `order`.*, `delivery`.`delivery_time`
                                    FROM `order`
                                    LEFT JOIN `delivery` ON `order`.`id` = `delivery`.`order_id`
                                    ORDER BY `order`.`id` DESC") or die('Query Failed');            
            if (mysqli_num_rows($order_query) > 0) {
                while ($row = mysqli_fetch_assoc($order_query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['total_products']; ?></td>
                        <td>
                            <!-- Status Checkbox -->
                            <form action="order.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <input type="checkbox" name="status_checkbox" value="1" <?php echo ($row['status'] == 1) ? 'checked' : ''; ?> onchange="this.form.submit();">
                            </form>
                        </td>
                        <td>
                            <!-- Display delivery time -->
                            <?php echo $row['delivery_time'] ? $row['delivery_time'] : 'Not Available'; ?>
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <a href="order.php?delete=<?php echo $row['id']; ?>" class="delete_btn" onclick="return confirm('Are you sure you want to delete this order?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="7" class="empty">No orders found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<?php include "includes/adminfooter.php"; ?>

</body>
</html>

<?php
session_start();
include "includes/databaseconnect.php";

// Update Delivery
if (isset($_POST['update_delivery'])) {
    $update_d_id = $_POST['update_d_id'];
    $update_delivery_date = $_POST['update_delivery_date'];
    $update_delivery_time = $_POST['update_delivery_time'];
    $update_delivery_status = $_POST['update_delivery_status'];

    $update_query = mysqli_query($conn, "UPDATE delivery SET 
        delivery_date = '$update_delivery_date', 
        delivery_time = '$update_delivery_time', 
        del_status = '$update_delivery_status' 
        WHERE id = '$update_d_id'");

    if ($update_query) {
        $_SESSION['message'] = 'Delivery updated successfully';
        header('location:admindelivery.php');
        exit();
    } else {
        $_SESSION['message'] = 'Failed to update delivery';
        header('location:admindelivery.php');
        exit();
    }
}

// Delete a delivery record
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `delivery` WHERE id = $delete_id") or die('Query failed');
    if ($delete_query) {
        $_SESSION['message'] = 'Delivery deleted successfully';
    } else {
        $_SESSION['message'] = 'Failed to delete delivery';
    }
    header('location:admindelivery.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet" />
    <link href="css/admindelivery.css" rel="stylesheet" />
    <title>Manage Deliveries</title>
</head>
<body>
    <?php
    // Display messages
    if (isset($_SESSION['message'])) {
        echo '<div class="message"><span>' . $_SESSION['message'] . '</span> 
        <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
        unset($_SESSION['message']);
    }
    ?>
    <?php include 'includes/adminnavbar.php'; ?>

    <!-- Display Delivery Records -->
    <section class="displaytable">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Delivery Address</th>
                    <th>Contact Number</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>   
            </thead>
            <tbody>
                <?php
                $select_deliveries = mysqli_query($conn, "SELECT * FROM `delivery`ORDER BY `order_id` DESC") or die('Query failed');
                if (mysqli_num_rows($select_deliveries) > 0) {
                    while ($row = mysqli_fetch_assoc($select_deliveries)) {
                ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['order_cname']; ?></td>
                    <td><?php echo $row['delivery_address']; ?></td>
                    <td><?php echo $row['contact_no']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['delivery_time']; ?></td>
                    <td><?php echo $row['del_status']; ?></td>
                    <td>
                        <a href="admindelivery.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                        <a href="admindelivery.php?edit=<?php echo $row['id']; ?>" class="option-btn">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='empty'>No deliveries available</td></tr>";
                }
                ?>
            </tbody>    
        </table>
    </section>

    <!-- Edit Form -->
    <section class="edit-form-container" style="display: <?php echo isset($_GET['edit']) ? 'flex' : 'none'; ?>;">
    <?php
    if (isset($_GET['edit'])) {
        $edit_id = intval($_GET['edit']);
        $edit_query = mysqli_query($conn, "SELECT * FROM delivery WHERE id = $edit_id");

        if ($edit_query && mysqli_num_rows($edit_query) > 0) {
            $fetch_edit = mysqli_fetch_assoc($edit_query);
    ?>
    <form action="" method="post">
        <input type="hidden" name="update_d_id" value="<?php echo $fetch_edit['id']; ?>">
        <input type="text" name="update_order_id" class="box" value="<?php echo $fetch_edit['order_id']; ?>" readonly>
        <input type="text" name="update_order_cname" class="box" value="<?php echo $fetch_edit['order_cname']; ?>" readonly>
        <input type="text" name="update_delivery_address" class="box" value="<?php echo $fetch_edit['delivery_address']; ?>" readonly>
        <input type="text" name="update_order_contactno" class="box" value="<?php echo $fetch_edit['contact_no']; ?>" readonly>
        <label for="update_delivery_date">Delivery Date</label>
        <input type="date" name="update_delivery_date" class="box" value="<?php echo date('Y-m-d', strtotime($fetch_edit['delivery_date'])); ?>" required>
        <label for="update_delivery_time">Delivery Time</label>
        <input type="time" name="update_delivery_time" class="box" value="<?php echo $fetch_edit['delivery_time']; ?>" required>
        <label>Status</label>
        <select name="update_delivery_status" class="box" required>
            <option value="pending" <?php echo ($fetch_edit['del_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="delivered" <?php echo ($fetch_edit['del_status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
            <option value="cancelled" <?php echo ($fetch_edit['del_status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
        </select>
        <input type="submit" value="Update Delivery" name="update_delivery" class="bton">
        <button type="button" onclick="document.querySelector('.edit-form-container').style.display='none'" class="option-btn">Cancel</button>
    </form>
    <?php
        }
    }
    ?>
</section>

    <?php include "includes/adminfooter.php"; ?>
</body>
</html>

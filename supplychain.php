<?php
session_start();
include "includes/databaseconnect.php";

// Add Supply Product
if (isset($_POST['add_sproduct'])) {
    $supplier_name = $_POST['supplier_name'];
    $supply_area = $_POST['supply_area'];
    $supply_product = $_POST['supply_product'];
    // $received_date = $_POST['received_date'];
    $received_date = date('Y-m-d');
    $manufacture_date = $_POST['manufacture_date'];
    $expire_date = $_POST['expire_date'];
    
    $insert_product_query = mysqli_query($conn, 
        "INSERT INTO `supplychain` (supplier_name, supply_area, supply_product, received_date, manufacture_date, expire_date) 
        VALUES ('$supplier_name', '$supply_area', '$supply_product', '$received_date', '$manufacture_date', '$expire_date')") or die('Query failed');

    if ($insert_product_query) {
        $_SESSION['message'] = 'Supply product added successfully';
    } else {
        $_SESSION['message'] = 'Failed to add supply product';
    }
}

// Update Supply Product
if (isset($_POST['update_sproduct'])) {
    $update_s_id = $_POST['update_s_id'];
    $update_supplier_name = $_POST['update_supplier_name'];
    $update_supply_area = $_POST['update_supply_area'];
    $update_supply_product = $_POST['update_supply_product'];
    $update_received_date = date('Y-m-d');
    $update_manufacture_date = $_POST['update_manufacture_date'];
    $update_expire_date = $_POST['update_expire_date'];

    $update_query = mysqli_query($conn, 
        "UPDATE `supplychain` SET supplier_name = '$update_supplier_name', supply_area = '$update_supply_area', 
         supply_product = '$update_supply_product', received_date = '$update_received_date', 
         manufacture_date = '$update_manufacture_date', expire_date = '$update_expire_date' WHERE id = '$update_s_id'");

    if ($update_query) {
        $_SESSION['message'] = 'Supply product updated successfully';
        header('location:supplychain.php');
        exit();
    } else {
        $_SESSION['message'] = 'Failed to update supply product';
        header('location:supplychain.php');
        exit();
    }
}

// Delete Supply Product
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `supplychain` WHERE id = $delete_id") or die('Query failed');
    if ($delete_query) {
        $_SESSION['message'] = 'Supply product deleted successfully';
    } else {
        $_SESSION['message'] = 'Failed to delete supply product';
    }
    header('location:supplychain.php');
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
    <link href="css/supplychain.css" rel="stylesheet" />
    <title>Supply Chain</title>
</head>
<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message"><span>' . $_SESSION['message'] . '</span> 
              <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
        unset($_SESSION['message']);
    }
    ?>
    <?php include 'includes/adminnavbar.php'; ?>

    <!-- Add Supply Product Form -->
    <section>
        <form action="" method="post" class="add-supply-form">
            <h3>Add Supplier Details</h3>
            <input type="text" name="supplier_name" placeholder="Enter Supplier Name" class="box" required>
            <input type="text" name="supply_area" placeholder="Enter Supplier Area" class="box" required>
            <input type="text" name="supply_product" placeholder="Enter Supply Product" class="box" required>
            <!-- <label>Received Date</label>
            <input type="date" name="received_date" class="box" required> -->
            <label>Manufacture Date</label>
            <input type="date" name="manufacture_date" class="box" required>
            <label>Expire Date</label>
            <input type="date" name="expire_date" class="box" required>
            <input type="submit" value="Add Supply Product" name="add_sproduct" class="btn">
        </form>
    </section>

    <!-- Display Supply Product Table -->
    <section class="displaytable">
        <table>
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Supplier Area</th>
                    <th>Product Type</th>
                    <th>Received Date</th>
                    <th>Manufacture Date</th>
                    <th>Expire Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $select_products = mysqli_query($conn, "SELECT * FROM `supplychain`");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($row = mysqli_fetch_assoc($select_products)) {
                ?>
                <tr>
                    <td><?php echo $row['supplier_name']; ?></td>
                    <td><?php echo $row['supply_area']; ?></td>
                    <td><?php echo $row['supply_product']; ?></td>
                    <td><?php echo $row['received_date']; ?></td>
                    <td><?php echo $row['manufacture_date']; ?></td>
                    <td><?php echo $row['expire_date']; ?></td>
                    <td>
                        <a href="supplychain.php?delete=<?php echo $row['id']; ?>" class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this?');">
                           <i class="fas fa-trash"></i> Delete</a>
                        <a href="supplychain.php?edit=<?php echo $row['id']; ?>" class="option-btn">
                           <i class="fas fa-edit"></i> Update</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='empty'>No supply chain products available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Edit Form -->
    <section class="edit-form-container" style="display: <?php echo isset($_GET['edit']) ? 'flex' : 'none'; ?>;">
        <?php
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `supplychain` WHERE id = $edit_id");
            if (mysqli_num_rows($edit_query) > 0) {
                $fetch_edit = mysqli_fetch_assoc($edit_query);
        ?>
        <form action="" method="post">
            <input type="hidden" name="update_s_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" name="update_supplier_name" class="box" value="<?php echo $fetch_edit['supplier_name']; ?>" required>
            <input type="text" name="update_supply_area" class="box" value="<?php echo $fetch_edit['supply_area']; ?>" required>
            <input type="text" name="update_supply_product" class="box" value="<?php echo $fetch_edit['supply_product']; ?>" required>
            <!-- <label>Received Date</label>
            <input type="date" name="update_received_date" class="box" value="<?php echo $fetch_edit['received_date']; ?>" required> -->
            <label>Manufacture Date</label>
            <input type="date" name="update_manufacture_date" class="box" value="<?php echo $fetch_edit['manufacture_date']; ?>" required>
            <label>Expire Date</label>
            <input type="date" name="update_expire_date" class="box" value="<?php echo $fetch_edit['expire_date']; ?>" required>
            <input type="submit" value="Update Supply Product" name="update_sproduct" class="btn">
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

    
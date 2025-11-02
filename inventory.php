<?php
session_start();
include "includes/databaseconnect.php";

// Fetch supply products (no need to fetch supplier names anymore)
$supplier_query = mysqli_query($conn, "SELECT * FROM `supplychain`") or die('Query failed');
$suppliers = [];
if (mysqli_num_rows($supplier_query) > 0) {
    while ($supplier_row = mysqli_fetch_assoc($supplier_query)) {
        $suppliers[] = $supplier_row;
    }
}

if (isset($_POST['add_inventory'])) {
    $supply_product = $_POST['supply_product'];
    $stock_qty = $_POST['stock_qty'];
    $last_restocked_date = $_POST['last_restocked_date'];
    $last_restocked_date = date('Y-m-d'); 

    // Fetch the dates from the supplychain table based on the selected supply_product
    $query = mysqli_query($conn, "SELECT * FROM `supplychain` WHERE supply_product = '$supply_product'") or die('Query failed');
    $product_details = mysqli_fetch_assoc($query);

    // Get the values for received_date, manufacture_date, expire_date
    $received_date = $product_details['received_date'];
    $manufacture_date = $product_details['manufacture_date'];
    $expire_date = $product_details['expire_date'];

    // Insert into inventory table
    $insert_inventory = mysqli_query($conn, 
        "INSERT INTO `inventory` (supply_product, received_date, manufacture_date, expire_date, stock_qty, last_restocked_date) 
        VALUES ('$supply_product', '$received_date', '$manufacture_date', '$expire_date', '$stock_qty', '$last_restocked_date')") 
        or die('Query failed');

    if ($insert_inventory) {
        $_SESSION['message'] = 'Inventory added successfully';
    } else {
        $_SESSION['message'] = 'Failed to add inventory';
    }
}


// delete Supply Product
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `inventory` WHERE id = $delete_id") or die('Query failed');

    if ($delete_query) {
        $_SESSION['message'] = 'Inventory item deleted successfully';
    } else {
        $_SESSION['message'] = 'Failed to delete inventory item';
    }
    header('location: inventory.php');
}

// Update Inventory
if (isset($_POST['update_inventory'])) {
    $update_id = $_POST['update_id'];
    $supply_product = $_POST['update_supply_product'];
    $received_date = $_POST['update_received_date'];
    $manufacture_date = $_POST['update_manufacture_date'];
    $expire_date = $_POST['update_expire_date'];
    $stock_qty = $_POST['update_stock_qty'];

    $update_query = mysqli_query($conn, 
        "UPDATE `inventory` SET 
        supply_product = '$supply_product',
        received_date = '$received_date',
        manufacture_date = '$manufacture_date',
        expire_date = '$expire_date',
        stock_qty = '$stock_qty'
        WHERE id = $update_id"
    ) or die('Query failed');

    if ($update_query) {
        $_SESSION['message'] = 'Inventory item updated successfully';
    } else {
        $_SESSION['message'] = 'Failed to update inventory item';
    }
    header('location: inventory.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet" />
    <link href="css/inventory.css" rel="stylesheet" />
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

    
    <section>
        <form action="" method="post" class="add-inventory-form">
            <h3>Add Inventory Details</h3>

            
            <select name="supply_product" class="box" required>
                <option value="" disabled selected>Supply Product</option>
                <?php foreach ($suppliers as $supplier) { ?>
                    <option value="<?php echo $supplier['supply_product']; ?>">
                        <?php echo $supplier['supply_product']; ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Include stock_qty and last_restocked_date fields in the form -->
            <input type="number" name="stock_qty" placeholder="Enter Stock Quantity" class="box" required>
            <label>Last Restocked Date</label>
            <input type="date" name="last_restocked_date" class="box" required>

            <input type="submit" value="Add Inventory" name="add_inventory" class="btn">
        </form>
    </section>

    <section class="displaytable">
    <table>
        <thead>
            <tr>
                <th>Supply Product</th>
                <th>Stock Quantity</th>
                <th>Received Date</th>
                <th>Manufacture Date</th>
                <th>Expire Date</th>
                <th>Last Restocked</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $select_inventories = mysqli_query($conn, "SELECT * FROM `inventory`") or die('Query failed');
        if (mysqli_num_rows($select_inventories) > 0) {
            while ($row = mysqli_fetch_assoc($select_inventories)) {
        ?>
        <tr>
            <td><?php echo $row['supply_product']; ?></td>
            <td><?php echo $row['stock_qty']; ?></td>
            <td><?php echo $row['received_date']; ?></td>
            <td><?php echo $row['manufacture_date']; ?></td>
            <td><?php echo $row['expire_date']; ?></td>
            <td><?php echo isset($row['last_restocked_date']) ? $row['last_restocked_date'] : 'Not available'; ?></td>
            <td>
                <a href="inventory.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');">
                    <i class="fas fa-trash"></i> Delete
                </a>
                <a href="inventory.php?edit=<?php echo $row['id']; ?>" class="option-btn">
                    <i class="fas fa-edit"></i> Update
                </a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='empty'>No inventory available</td></tr>";
        }
        ?>
        </tbody>
    </table>
</section>


    <section class="edit-form-container" style="display: <?php echo isset($_GET['edit']) && !empty($_GET['edit']) ? 'flex' : 'none'; ?>;">
<?php
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE id = $edit_id");
    if (mysqli_num_rows($edit_query) > 0) {
        $fetch_edit = mysqli_fetch_assoc($edit_query);

        // Fetch the dates from supplychain based on the supply_product
        $supply_product = $fetch_edit['supply_product'];
        $supply_details = mysqli_query($conn, "SELECT * FROM `supplychain` WHERE supply_product = '$supply_product'") or die('Query failed');
        $product_details = mysqli_fetch_assoc($supply_details);

        $received_date = $product_details['received_date'];
        $manufacture_date = $product_details['manufacture_date'];
        $expire_date = $product_details['expire_date'];
?>
<form action="" method="post">
    <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
    <input type="text" name="update_supply_product" class="box" value="<?php echo $fetch_edit['supply_product']; ?>" required>
    
    <!-- Show the fetched dates, these won't be editable -->
    <input type="text" class="box" value="<?php echo $received_date; ?>" disabled>
    <input type="text" class="box" value="<?php echo $manufacture_date; ?>" disabled>
    <input type="text" class="box" value="<?php echo $expire_date; ?>" disabled>

    <input type="number" name="update_stock_qty" class="box" value="<?php echo $fetch_edit['stock_qty']; ?>" required>
    <input type="submit" value="Update Inventory" name="update_inventory" class="btn">
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

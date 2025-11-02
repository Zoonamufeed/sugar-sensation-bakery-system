<?php
session_start();
include 'includes/databaseconnect.php';

//displaying message bassed on session
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '<i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    // Clear the message after displaying it
    unset($_SESSION['message']); 
}

//Add Product
if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;
    $category_id = $_POST['category_id'];

    $insert_product_query = mysqli_query($conn, 
        "INSERT INTO `products` (name, price, image, category_id) 
        VALUES ('$p_name', '$p_price', '$p_image', '$category_id')") or die('Query failed');

    if ($insert_product_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'Product added successfully';
    } else {
        $message[] = 'Failed to add product';
    }
}

// Delete Product
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id") or die('Query failed');
    if ($delete_query) {
        $_SESSION['message'] = 'Product has been deleted';
    } else {
        $_SESSION['message']= 'Product could not be deleted';
    }
    header('location:items.php'); 
    exit(); 
}

/*Update Table*/
if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/'.$update_p_image;
 
    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");
 
    if($update_query){
       move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
       //stroing the messages in the session
       $_SESSION['message'] = 'Product updated successfully'; 
    } else {
       $_SESSION['message'] = 'Product could not be updated'; 
    }
    header('location:items.php'); 
    exit(); 
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "includes/header_links.php";
    ?>
   <link href="css/homead.css" rel="stylesheet"/>
   <link rel="stylesheet" href="css/admin.css">
    <title>Admin Panel</title>
</head>
<body>

<?php
//displaying message bassed on array
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span> 
        <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
}
?>
<?php
    include 'includes/adminnavbar.php';
 ?>
   
    <!-- Add Product Form -->
    <section>
        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>Add a New Product</h3>
            <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="Enter the product price" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>

            <select name="category_id" class="box" required>
                <option value="" disabled selected>Select Category</option>
                <?php
                $categories_query = mysqli_query($conn, "SELECT * FROM `categories`") or die('Query failed');
                if (mysqli_num_rows($categories_query) > 0) {
                    while ($row = mysqli_fetch_assoc($categories_query)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "<option value='' disabled>No categories available</option>";
                }
                ?>
            </select>

            <input type="submit" value="Add Product" name="add_product" class="btns">
        </form>
    </section>

    <!-- Display Products by Category -->
</div>
<section class="display-product-table">
    <table>
        <thead>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Product Price</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php
            $select_products = mysqli_query($conn, 
                "SELECT p.*, c.name AS category_name 
                FROM `products` p 
                LEFT JOIN `categories` c 
                ON p.category_id = c.id") or die('Query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($row = mysqli_fetch_assoc($select_products)) {
            ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['category_name'] ?: 'Uncategorized'; ?></td>
                <td>$<?php echo $row['price']; ?>/-</td>
                <td>
                    <a href="items.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                    <a href="items.php?edit=<?php echo $row['id']; ?>" class="option-btn">
                        <i class="fas fa-edit"></i> Update
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5' class='empty'>No products added</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

 
 <!--Edit form table-->
<section class="edit-form-container">
<?php
if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
   if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
?>

<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
   <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
   <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
   <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
   <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
   <div class="butns">
   <input type="submit" value="update the prodcut" name="update_product" class="btn">
   <input type="reset" value="cancel" id="close-edit" class="option-btn">
      </div>
</form>
<?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
<?php
    include "includes/adminfooter.php";
    ?>
</body>
</html>

<?php
include 'includes/databaseconnect.php';

// Add Category
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $insert_category_query = mysqli_query($conn, "INSERT INTO `categories` (name) VALUES ('$category_name')") or die('Query failed');
    if ($insert_category_query) {
        $message[] = 'Category added successfully';
    } else {
        $message[] = 'Failed to add category';
    }
}

// Add Product
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
        header('location:admins.php');
        $message[] = 'Product has been deleted';
    } else {
        header('location:admins.php');
        $message[] = 'Product could not be deleted';
    }
}

// Delete Category
if (isset($_GET['delete_category'])) {
    $delete_category_id = $_GET['delete_category'];
    $delete_category_query = mysqli_query($conn, "DELETE FROM `categories` WHERE id = $delete_category_id") or die('Query failed');
    if ($delete_category_query) {
        $message[] = 'Category and associated products deleted successfully';
        header('location:admins.php'); // Redirect to admin page after deletion
    } else {
        $message[] = 'Category could not be deleted';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
}
?>

<div class="container">

    <!-- Add Category Form -->
    <section>
        <form action="" method="post" class="add-category-form">
            <h3>Add a New Category</h3>
            <input type="text" name="category_name" placeholder="Enter category name" class="box" required>
            <input type="submit" value="Add Category" name="add_category" class="btn">
        </form>
    </section>

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

            <input type="submit" value="Add Product" name="add_product" class="btn">
        </form>
    </section>

    <!-- Display Products by Category -->
    <section class="categories">
        <h1 class="heading">Product Categories</h1>
        <?php
        $categories_query = mysqli_query($conn, "SELECT * FROM `categories`") or die('Query failed');
        if (mysqli_num_rows($categories_query) > 0) {
            while ($category = mysqli_fetch_assoc($categories_query)) {
                $category_id = $category['id'];
                echo "<div class='category'>
                      <h2>{$category['name']}</h2>
                      <div class='products'>";

                $products_query = mysqli_query($conn, "SELECT * FROM `products` WHERE category_id = $category_id") or die('Query failed');
                if (mysqli_num_rows($products_query) > 0) {
                    while ($product = mysqli_fetch_assoc($products_query)) {
                        echo "<div class='product'>
                              <img src='uploaded_img/{$product['image']}' alt='{$product['name']}'>
                              <h3>{$product['name']}</h3>
                              <p>$ {$product['price']}</p>
                              <a href='admins.php?delete={$product['id']}' class='delete-btn' onclick='return confirm(\'Are you sure you want to delete this?\');'>Delete</a>
                              </div>";
                    }
                } else {
                    echo "<p>No products available under this category</p>";
                }

                echo "</div></div>";
            }
        } else {
            echo "<p>No categories available</p>";
        }
        ?>
    </section>
    <section class="categories">
    <h1 class="heading">Product Categories</h1>
    <?php
    $categories_query = mysqli_query($conn, "SELECT * FROM `categories`") or die('Query failed');
    if (mysqli_num_rows($categories_query) > 0) {
        while ($category = mysqli_fetch_assoc($categories_query)) {
            $category_id = $category['id'];
            echo "<div class='category'>
                  <h2>{$category['name']}</h2>
                  <a href='admins.php?delete_category={$category_id}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this category and all associated products?\");'>Delete Category</a>
                  <div class='products'>";

            $products_query = mysqli_query($conn, "SELECT * FROM `products` WHERE category_id = $category_id") or die('Query failed');
            if (mysqli_num_rows($products_query) > 0) {
                while ($product = mysqli_fetch_assoc($products_query)) {
                    echo "<div class='product'>
                          <img src='uploaded_img/{$product['image']}' alt='{$product['name']}'>
                          <h3>{$product['name']}</h3>
                          <p>$ {$product['price']}</p>
                          </div>";
                }
            } else {
                echo "<p>No products available under this category</p>";
            }

            echo "</div></div>";
        }
    } else {
        echo "<p>No categories available</p>";
    }
    ?>
</section>


</div>

</body>
</html>













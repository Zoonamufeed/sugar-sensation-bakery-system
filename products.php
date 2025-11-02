<?php
session_start();
include 'includes/databaseconnect.php';

$isLoggedIn = isset($_SESSION['users_id']);

/*products are being added to cart*/
if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'product already added to cart';
    }else{
       $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
       $message[] = 'product added to cart succesfully';
    }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/menu.css" rel="stylesheet"/>
    <?php
    include "includes/header_links.php";
    ?>
    <title>Menu</title>
</head>
<body>
    <!--displays message-->
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>
    <!--navbar-->
    <?php
    include "includes/header.php";
    ?>
    <!--Products-->
    <div class="heading">
        <img class="wallpaper" src="img/kneading.jpg" alt="knead-dough">
        <h1 class="main_heading">Menu</h1>
    </div>

    <div class="container">
        <section class="products">
            <h1 class="heading">Our Products</h1>
            
            <?php
            // Fetch all categories
            $categories_query = mysqli_query($conn, "SELECT * FROM `categories`") or die('Query failed');
            if (mysqli_num_rows($categories_query) > 0) {
                while ($category = mysqli_fetch_assoc($categories_query)) {
                    $category_id = $category['id'];
                    echo "<div class='category'>
                          <h2>{$category['name']}</h2>
                          <div class='box-container'>";

                    // Fetch products for the current category
                    $products_query = mysqli_query($conn, "SELECT * FROM `products` WHERE category_id = $category_id") or die('Query failed');
                    if (mysqli_num_rows($products_query) > 0) {
                        while ($product = mysqli_fetch_assoc($products_query)) {
                            echo "
                            <form action='' method='post'>
                                <div class='box'>
                                    <img src='uploaded_img/{$product['image']}' alt='{$product['name']}'>
                                    <h3>{$product['name']}</h3>
                                    <div class='price'>$ {$product['price']} /-</div>
                                    <input type='hidden' name='product_name' value='{$product['name']}'>
                                    <input type='hidden' name='product_price' value='{$product['price']}'>
                                    <input type='hidden' name='product_image' value='{$product['image']}'>
                                    <input type='submit' class='btn_add_to_cart' value='Add to Cart' name='add_to_cart'>
                                </div>
                            </form>";
                        }
                    } else {
                        echo "<p>No products available under this category.</p>";
                    }
                    
                    echo "</div></div>";
                }
            } else {
                echo "<p>No categories available.</p>";
            }
            ?>
        </section>
    </div>

<?php
    include "includes/signup.php";
    include "includes/login.php";
    include "includes/footer.php";
    ?>

</body>
</html>
    
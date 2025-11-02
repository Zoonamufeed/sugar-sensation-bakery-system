<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="sample.css" rel="stylesheet"/>
</head>
<body>
    <div id="signup-container">
        <form id="sign-up" action="" method="post">
            <div>
                <p class="signup-header">Sign up with Sugar Sensation Bakery</p>
                <a href="#" class="close-signup">X</a>
            </div>
            <hr>
            <fieldset>
                <i class="fas fa-user">
                    <input type="text" name="name" placeholder="Full Name" required />
                </i>
                <i class="fa fa-phone">
                    <input type="text" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required />
                </i>
                <i class="fa fa-envelope">
                    <input type="email" name="email" placeholder="Email" required />
                </i>
                <i class="fa fa-lock">
                    <input type="password" name="password" placeholder="Password" required />
                    </i>
                <button class="signup-button" type="submit" name="submit">Create Account</button>
            </fieldset>
            <hr>
            <p class="signup-footer">Already have an account? <a href="#">Login</a></p>
        </form>
    </div>
    <div class="login-container">
        <form id="login" action="" method="post">
         <div>
            <fieldset class="login-fieldset">
            <p class="login-header"> Login with Sugar Sensation Bakery</p>
            <a href="#" class="close-login">X</a>         
            </div>
            <hr>
            <i class="fa fa-envelope">
                <input type="email" name="email" placeholder="Email" required />
            </i>
            <i class="fa fa-lock">
                <input type="password" name="password" placeholder="Password" required />
                </i>
            <button class="login-button" type="submit" name="submit">Login</button>  
            </fieldset>
            <hr>
            <p class="signup-footer"><a href="#">Click here</a> to register a new account</p>
        </form>
    </div>
</body>
</html>-->
<?php
include 'includes/databaseconnect.php';


if(isset($_POST['add_product'])){
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_image;
 
    $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');
 
    if($insert_query){
       move_uploaded_file($p_image_tmp_name, $p_image_folder);
       $message[] = 'product add succesfully';
    }else{
       $message[] = 'could not add the product';
    }
 };

 /*delete Table*/
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
       header('location:admins.php');
       $message[] = 'product has been deleted';
    }else{
       header('location:admins.php');
       $message[] = 'product could not be deleted';
    };
 };
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
       $message[] = 'product updated succesfully';
       header('location:admins.php');
    }else{
       $message[] = 'product could not be updated';
       header('location:admins.php');
    }
 }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device=width, initial-scale=1.0">
        <title>Admin Panel</title>
        <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/admin.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>


    <?php
    include "head.php"
    ?>
<!--ADD PRODUCTS FORM-->
<div class="container">
    <section>
    <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>
<!--DISPALY PRODUCT TABLE-->

<section class="display-product-table">

   <table>

      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admins.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');">
                 <i class="fas fa-trash"></i> delete </a>
               <a href="admins.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit">

               </i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
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
   <input type="submit" value="update the prodcut" name="update_product" class="btn">
   <input type="reset" value="cancel" id="close-edit" class="option-btn">
</form>
<?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
</div>



<!-- custom javascript file -->
 <script src="js/admin.js"></script>
</body>
</html>   

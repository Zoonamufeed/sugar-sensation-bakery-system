<?php
session_start();
include 'includes/databaseconnect.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); 

// Display order page and set session variable for order placed
$_SESSION['order_placed'] = true;

// Process order submission
if (isset($_POST['order_btn'])) {

   // Retrieve form data
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   // Retrieve cart items
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;

   // Loop through cart items and calculate total price
   if (mysqli_num_rows($cart_query) > 0) {
       while ($product_item = mysqli_fetch_assoc($cart_query)) {
           $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
           $product_price = number_format($product_item['price'] * $product_item['quantity']);
           $price_total += $product_price;
       }
   }

   // Join product names and quantities into a single string
   $total_product = implode(', ', $product_name);

   // Get the logged-in user's ID from the session
   $user_id = $_SESSION['user_id'];

   // Insert order details into the database, including user_id
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(user_id, name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price)
                                       VALUES('$user_id', '$name', '$number', '$email', '$method', '$flat', '$street', '$city', '$state', '$country', '$pin_code', '$total_product', '$price_total')")
   or die('Order query failed');

   // Get the last inserted order ID
   $order_id = mysqli_insert_id($conn);
   $date = date('Y-m-d');
   // Insert delivery details with default status as 'pending'
   $delivery_query = mysqli_query($conn, "INSERT INTO `delivery`(order_id, order_cname, contact_no, delivery_address, delivery_date, del_status)
                                          VALUES('$order_id', '$name', '$number', '$city','$date', 'pending')")
   or die('Delivery query failed');

   // Show order confirmation
   if ($cart_query && $detail_query && $delivery_query) {
       echo "
       <div class='order-message-container'>
           <div class='message-container'>
               <h3>Thank you for shopping!</h3>
               <div class='order-detail'>
                   <span>" . $total_product . "</span>
                   <span class='total'>Total: $ " . $price_total . " /-</span>
               </div>
               <div class='customer-details'>
                   <p>Your name: <span>" . $name . "</span></p>
                   <p>Your number: <span>" . $number . "</span></p>
                   <p>Your email: <span>" . $email . "</span></p>
                   <p>Your address: <span>" . $city . "</span></p>
                   <p>Your payment mode: <span>" . $method . "</span></p>
                  
               </div>
               <a href='products.php' class='btn'>Continue shopping</a>
           </div>
       </div>
       ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php" ?>
    <title>Checkout</title>
    <!-- Font awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/checkingout.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">

<section class="checkout-form">
   <h1 class="heading">Complete Your Order</h1>
   <form action="" method="post">
      <!-- Displaying the list of cart items and their quantities, grand total -->
      <div class="display-order">
          <?php
          /* Fetch Cart Items */
          $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
          /* Initialize Variables */
          $total = 0;
          $grand_total = 0;
          /* Check if Cart Contains Items */
          if (mysqli_num_rows($select_cart) > 0) {
              /* Loop Through Cart Items */
              while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                  $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total = $total += $total_price;
          ?>
          <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
          <?php
              }
          } else {
              /* If the Cart is Empty */
              echo "<div class='display-order'><span>Your cart is empty!</span></div>";
          }
          ?>
          <!-- Display the Grand Total -->
          <span class="grand-total">Grand Total: $<?= $grand_total; ?>/-</span>
      </div>

      <div class="flex">
         <div class="inputBox">
            <span>Your name</span>
            <input type="text" placeholder="Enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>Your number</span>
            <input type="text" placeholder="Enter your number" name="number" maxlength="10" pattern="^\d{10}$" required>
         </div>
         <div class="inputBox">
            <span>Your email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
         </div>
         <!-- <div class="inputBox">
            <span>Payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>Cash on delivery</option>
               <option value="credit card">Credit card</option>
               <option value="paypal">Debit card</option>
            </select>
         </div> -->
         <div class="inputBox">
    <span>Payment method</span>
    <select name="method" id="payment-method">
        <option value="cash on delivery" selected>Cash on delivery</option>
        <option value="credit card">Credit card</option>
        <option value="Debit card">Debit card</option>
    </select>
</div>


<div id="card-details" style="display: none;">
    <div class="inputBox">
        <span>Cardholder Name</span>
        <input type="text" placeholder="Enter cardholder name" name="cardholder_name" >
    </div>
    <div class="inputBox">
        <span>Card Number</span>
        <input type="text" placeholder="Enter card number" name="card_number" maxlength="16" pattern="\d{16}" >
    </div>
    <div class="inputBox">
        <span>Expiration Date</span>
        <input type="text" placeholder="MM/YY" name="expiration_date" maxlength="4" pattern="\d{4}" >
    </div>
    <div class="inputBox">
        <span>CVC</span>
        <input type="text" placeholder="Enter CVC" name="cvc" maxlength="3" pattern="\d{3}" >
    </div>
</div>




         <div class="inputBox">
            <span>Address line 1</span>
            <input type="text" placeholder="e.g., Flat No." name="flat" required>
         </div>
         <div class="inputBox">
            <span>Address line 2</span>
            <input type="text" placeholder="e.g., Street Name" name="street" required>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" placeholder="e.g., London" name="city" required>
         </div>
         <div class="inputBox">
            <span>State</span>
            <input type="text" placeholder="e.g., England" name="state" required>
         </div>
         <div class="inputBox">
            <span>Country</span>
            <input type="text" placeholder="e.g., United Kingdom" name="country" required>
         </div>
         <div class="inputBox">
            <span>Pin code</span>
            <input type="text" placeholder="e.g., 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="Order Now" name="order_btn" class="btn_now">
   </form>

</section>
</div>

<script src="js/shopping.js"></script>
<?php include "includes/footer.php"; ?>

</body>
<script>
document.getElementById("payment-method").addEventListener("change", function() {
    var selectedMethod = this.value;
    var cardDetails = document.getElementById("card-details");
    var paymentMessage = document.getElementById("payment-message");

    if (selectedMethod === "credit card" || selectedMethod === "paypal") {
        cardDetails.style.display = "block";  // Show card details
        paymentMessage.innerHTML = "(*Pay securely using your card*)";
    } else {
        cardDetails.style.display = "none";   // Hide card details
        paymentMessage.innerHTML = "(*Pay when product arrives*)";
    }
});
</script>

</html>

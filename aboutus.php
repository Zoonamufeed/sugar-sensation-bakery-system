<?php
session_start();
$isLoggedIn = isset($_SESSION['users_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include "includes/header_links.php";
    ?>
    <link href="css/about_us.css" rel="stylesheet"/>
    <title>About_us</title>
</head>
<body>
    <!--navbar-->
    <?php
    include "includes/header.php";
    ?>
   <!-- About US -->
    
   <div class="heading">
        <img class="wallpaper" src="img/kneading.jpg" alt="knead-dough">
        <h1 class="heading_main">About us</h1>
    </div>
    <div class="details">
        <div class="about-content-img">
            <marquee direction="right" scrollamount="20" behavior="slide" loop="1" >
            <img class="chef" src="img/chef.jpg" alt="chef-image"></marquee>
        </div>
        <div class="about-content">
            <h2 class="abut-us-heading">Our Story</h2>
            <p class="para">Sugar Sensation Bakery, located in the capital of England, has been delighting clients
                 with its amazing baked goods and savory goods for many years. Which began as a small,
                  community-focused bakery soon achieved popularity for its superb taste and quality,
                   resulting in loyal clients built through community events. Over time, our dedication
                    to producing high-quality items and providing enjoyable experiences has earned us
                     a well-known brand in the region.</p>
            <p class="para">We are creating an e-commerce platform to better serve our consumers by enabling for
                 online ordering and delivery at any time and from any location. This change intends
                  to reach a larger audience, decrease operational issues, and improve the overall
                   buying experience. Customers may quickly browse our offers, make purchases, and
                    enjoy the same quality while having greater convenience. This changes is a key
                     step in achieving our goal of spreading baking delight.
                </p>
        </div>
    </div>
    <div class="display">
    <div class="block">
        <div class="test-container">
            <img class="test-img" src="img/girl.png">
        </div>
        <div class="test-text">
            <p>"The desserts are heavenly, perfectly crafted, while the savory treats are irresistible, bursting with flavor in every bite!"</p>
        </div>
        <div class="test-name">Maria Jennifer</div>
    </div>
    </div>
    
    <?php
    include "includes/signup.php";
    include "includes/login.php";
    include "includes/footer.php";
    ?>

       
       
</body>
</html>
    
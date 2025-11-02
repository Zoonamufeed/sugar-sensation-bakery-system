<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php
    include "includes/header_links.php";
    ?>
    <link href="css/main.css" src="stylesheet"/>
    <title>SugarSensationBakery</title>
</head>
<body>
    <!--navbar-->
    <?php
    include "includes/header.php";
    ?>
    
    <div class="cc">
    <!--carousel-->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/display.png" alt="cake">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/cpuff.jpg" alt="puff pastry">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/cpizza.png" alt="pizza">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>
    
<!-- Chatbot -->
<button id="chatbotButton" class="chatbot-button">
        <img src="img/chatbot.webp" alt="Chatbot Icon">
      </button>
      <div id="chatbot-container" class="chat-hidden">
        <div class="chat-container">
          <div class="chat-header">
            <img class="imgchatbot" src="img/chatbot.webp" alt="Chatbot">
            <button id="closeChatbot" class="close-chatbot">X</button>
          </div>
          <div class="chat-box" id="chatBox"></div>
          <div class="chat-input">
            <input type="text" id="userInput" placeholder="Type your message here..." />
            <button id="sendButton">Send</button>
          </div>
        </div>
      </div>     
  <!--main body-->
  <div class="body">
  <div class="ratings">
    <div class="experience">
        <i class="fas fa-certificate"></i>
        <p>Years Experience</p>
        <label id="countLabel1" data-target="4">0</label>
    </div>
    <div class="experience">
        <i class="fas fa-users"></i>
        <p>Skilled professionals</p>
        <label id="countLabel2" data-target="25">0</label>
    </div>
    <div class="experience">
        <i class="fas fa-bread-slice"></i>
        <p>Total Products</p>
        <label id="countLabel3" data-target="35">0</label>
    </div>
    <div class="experience">
        <i class="fa fa-shopping-cart"></i>
        <p>Order Everyday</p>
        <label id="countLabel4"data-target="55">0</label>
    </div>
</div>
<h1 class="pop_heading">Popular Products</h1>
<div class="popular">
  <div class="pop"><a href="products.php"><img src="img/donut.jpg" alt="donut"></a></div>
  <div class="pop"><a href="products.php"><img src="img/friedrice.jpeg" alt="Rice"></a></div>
  <div class="pop"><a href="products.php"><img src="img/pizza.jpg" alt="Pizza"></a></div>
  <div class="pop"><a href="products.php"><img src="img/bluedrink.jpg" alt="mojito"></a></div>
</div>
</div>    
    <?php
    include "includes/signup.php";
    include "includes/login.php";
    include "includes/footer.php";
    ?>

       
  
</body>
</html>


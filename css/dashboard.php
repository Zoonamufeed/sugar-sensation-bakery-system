<?php
session_start();
require "includes/databaseconnect.php";

if (!isset($_SESSION["user_id"])) {
    header("location: dashboard.php");
    die();
}
$user_id = $_SESSION['user_id'];

$sql_1 = "SELECT * FROM users WHERE id = $user_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include "includes/header_links.php";
    ?>
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
          
 
     
    <?php
    include "includes/logout.php";
    include "includes/footer.php";
    ?>

       <script src="js/chatbot.js"></script>
       <script src="js/client.js"></script>
       
</body>
</html>

      
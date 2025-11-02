<?php
session_start();
$isLoggedIn = isset($_SESSION['users_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/contact.css" rel="stylesheet"/>
    <?php
    include "includes/header_links.php";
    ?>
    <title>Contact</title>
</head>
<body>
<?php
    // Display messages
    if (isset($_SESSION['message'])) {
        echo '<div class="message"><span>' . $_SESSION['message'] . '</span> 
        <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
        unset($_SESSION['message']);
    }
    ?>
    <!--navbar-->
    <?php
    include "includes/header.php";
    ?>
   <!--Contact body-->
   
    <div>
   <div class="background">
        <img class="sourbread" src="img/bread.jpeg" alt="sourbread backgroud">
        <div class="content-container">
            <h1 class="head-main">Contact Us</h1>
                <p class="openings">Monday - Friday 7.00 AM - 6.00 PM | Saturday 7.00 AM - 4.00 PM</p>
                <p class="openings">Closed Sunday</p>
                <form class="contact-form" action="contactsub.php" method="post">
                    <input class="contact_type" type="text" name="fname" placeholder="First Name" required>
                    <input class="contact_type" type="text" name="lname" placeholder="Last Name" required>
                    <input class="contact_type" type="email" name="email" placeholder="Email Address" required>
                    <input class="contact_type" type="text" name="subject" placeholder="Subject" required>
                    <textarea name="message" cols="50" rows="5" placeholder="Your Message..." required></textarea>
                        <button class="submit-form" type="submit" name="add_contact">Submit Form</button>
                </form>
        </div>
    </div>

    <div class="location">
        <div class="contact-details">
            <ul class="detial-contact">
            <li><i class="fa fa-envelope"> <p class="detial-contact-p">Email: suagarsensation@gmail.com</p></i></li>
            <li><i class="fa fa-phone"> <p class="detial-contact-p"> Phone: 0812 233 433</p></i>
            <li><i class="fas fa-map-marker-alt"> <p class="detial-contact-p">Address: 350 Peradeniya Rd</p></i></li>
            </ul>
        </div>
        <div class="located">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.6056933178484!2d80.62301287448514!3d7.2856243138390475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3689b3e893d7d%3A0x8b9365c5023fd6a1!2s350%20Peradeniya%20Rd%2C%20Kandy%2020000!5e0!3m2!1sen!2slk!4v1734714226372!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
            
    <?php
    include "includes/signup.php";
    include "includes/login.php";
    include "includes/footer.php";
    ?>
     
</body>
</html>
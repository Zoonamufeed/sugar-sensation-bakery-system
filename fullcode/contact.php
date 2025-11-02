<!DOCTYPE html>
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
    <link href="css/main.css" rel="stylesheet"/>
    <link href="css/contact.css" rel="stylesheet"/>
    <title>SugarSensationBakery</title>
</head>
<body>
    <!--navbar-->
    <nav class="navbar">
        <div class="nav-links">
            <a href="main.php">Home</a>
            <a href="#menu">Menu</a>
            <a href="#order">Order</a>
            <a href="aboutus.php">About</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="logo-container">
            <img src="img/sslogo.png" alt="Logo">
        </div>

        <div class="right-nav">
            <form class="form-inline" role="search">
                <input type="text" class="form-control" placeholder="Search" style="width:150px;" >
                <button type="submit" class="btn btn-default">Search</button>
            </form>
            <a href="#shopping">
                <i class="glyphicon glyphicon-shopping-cart"></i>
            </a>
            <a href="#delivery">
                <img src="img/delivery.jpg" alt="Delivery">
            </a>
            <a href="#signup-container"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
            <a href="#login-container" ><span class="glyphicon glyphicon-log-in"></span> Login</a>
        </div>
    </nav>
    
    <!--Contact body-->
     
    <div class="background">
        <img class="sourbread" src="img/bread.jpeg" alt="sourbread backgroud">
        <div class="content-container">
            <h1 class="head-main">Contact Us</h1>
                <p class="openings">Monday - Friday 7.00 AM - 6.00 PM | Saturday 7.00 AM - 4.00 PM</p>
                <p class="openings">Closed Sunday</p>
            <form class="contact-form" action="" method="post" >
                <input type="text" name="fname" placeholder="First Name">
                <input type="text" name="lname" placeholder="Last Name" required/>
                <input type="email" name="email" placeholder="Email Address">
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" col="50" rows="5"> Your Message.....</textarea>
                <button class="submit-form" type="submit" name="submit">Submit Form</button>
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

      <!-- Footer -->
      <footer>
        <div class="container">
         <div class="footer-container">
           <h3>Contact us</h3>
           <p>Email: suagarsensation@gmail.com</p>
           <p>Phone: 0812 233 433</p>
           <p>Address: 350 Peradeniya Rd</p>
         </div>
         <div class="footer-container">
           <h3>Quick Links</h3>
           <ul  class="list">
             <li><a href="main.php">Home</a></li>
             <li><a href="#menu">Menu</a></li>
             <li><a href="#order">Order</a></li>
             <li><a href="aboutus.php">About</a></li>
             <li><a href="contact.php">Contact</a></li>
           </ul>
         </div>
         <div class="footer-container">
           <h3>Follow us</h3>
           <ul class="social-icons">
           <li><a href=""><i class="fab fa-facebook"></i></a></li>
           <li><a href=""><i class="fab fa-twitter"></i></a></li>
           <li><a href=""><i class="fab fa-instagram"></i></a></li>
           <li><a href=""><i class="fab fa-linkedin"></i></a></li>
           </ul>
         </div>
       </div>
         <div class="footer-bottom">
           <p class="copy-rights">
             &copy; Sugar Sensation Bakery All rights reserved</p>
         </div>
        </footer>
        
 </body>
 </html>
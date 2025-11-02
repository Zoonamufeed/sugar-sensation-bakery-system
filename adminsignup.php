<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <link rel="stylesheet" href="css/adminsignup.css">
    <title>Admin dashboard Login</title>
</head>
<body>
<section class="login">
    <img src="img/wallpaper.avif" alt="background">
    <div class="image">
    <div class="form-display">
    <h1>WELCOME TO Admin Panel</h1>
        <!-- Sign Up -->
<div id="signup-container" >
    <form id="signup" action="submit/adminsignup_sub.php" method="post">
        <div>
            <p class="signup-header">Sign up with Sugar Sensation Bakery</p>
        </div>
        <hr>
        <fieldset class="login-fieldset">
            <i class="fas fa-user">
                <input type="text" name="full_name" placeholder="Full Name" required />
            </i>
            <i class="fa fa-phone">
                <input type="text" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required />
            </i>
            <i class="fa fa-envelope">
                <input type="email" name="email" placeholder="Email" required />
            </i>
            <div class="input-group password-container">
                <i class="fa fa-lock"></i> <!-- Padlock icon outside -->
                <input type="password" id="password" name="password" placeholder="Password" required />
                <i class="fa fa-eye toggle-password" id="togglePassword"></i> <!-- Eye inside input box -->
            </div>
            <button class="signup-button" type="submit" name="submit">Create Account</button>
        </fieldset>
        <hr>
        <p class="signup-footer">Already have an account? <a href="adminlogin.php">Login</a></p>
    </form>
</div>

          
          <hr>
          <div class="">
       © All rights reserved Sugar Sensation Bakery.
    </div>
          <div class="icons">
          <i class="fab fa-facebook-f"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-linkedin-in"></i>
          <i class="fab fa-instagram"></i>
        </div>
      </form>
    </div>
</div>
</section>
<script src="js/adminsignup.js"></script>
</body>
</html>

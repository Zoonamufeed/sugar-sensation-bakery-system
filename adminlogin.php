<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/adminlogin.css">
    <title>Admin Dashboard Login</title>
</head>
<body>
<section class="login">
    <img src="img/wallpaper.avif" alt="background">
    <div class="image">
        <div class="form-display">
            <h1>WELCOME TO Admin Panel</h1>
            
            <form id="login" action="submit/adlogin_sub.php" method="post">
                <fieldset class="login-fieldset">
                    <i class="fa fa-envelope">
                        <input type="email" name="email" placeholder="Email" required />
                    </i>
                    <div class="input-group password-container">
                        <i class="fa fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required />
                        <i class="fa fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </fieldset>
                <label class="remem">
                    <input type="checkbox" name="remember_me" />
                    Remember me
                </label>
                <button class="login-button" type="submit" name="submit">Login</button>
                <hr>
                <p class="signup-footer"><a href="adminsignup.php">Click here</a> to register a new account</p>
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
<script src="js/adminlogin.js"></script>
</body>
</html>


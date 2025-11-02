 <!-- Sign Up -->
<div id="signup-container" >
    <form id="signup" action="submit/signup_sub.php" method="post">
        <div>
            <p class="signup-header">Sign up with Sugar Sensation Bakery</p>
            <a href="#" class="close-signup">X</a>
        </div>
        <hr>
        <fieldset>
            <i class="fas fa-user">
                <input type="text" name="full_name" placeholder="Full Name" required />
            </i>
            <i class="fa fa-phone">
                <input type="text" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required />
            </i>
            <i class="fa fa-envelope">
                <input type="email" name="email" placeholder="Email" required />
            </i>
            <!-- <div class="password-container">
                <i class="fa fa-lock"></i>
                <span class="toggle-password">
                <input type="password" id="password" name="password" placeholder="Password" required />
                <i class="fa fa-eye" id="togglePassword">
                   </i>
                </span>
            </div> -->
            <div class="input-group password-container">
                <i class="fa fa-lock"></i> <!-- Padlock icon outside -->
                <input type="password" id="password" name="password" placeholder="Password" required />
                <i class="fa fa-eye toggle-password" id="togglePassword"></i> <!-- Eye inside input box -->
            </div>
            <button class="signup-button" type="submit" name="submit">Create Account</button>
        </fieldset>
        <hr>
        <p class="signup-footer">Already have an account? <a href="#login-container">Login</a></p>
    </form>
</div>

<!-- Sign Up Link -->
<!-- <a href="#signup-container" id="signup-link">Sign Up</a> -->

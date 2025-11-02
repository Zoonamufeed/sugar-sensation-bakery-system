document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login");

    // Handle the Login form submission
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(loginForm);

            fetch("submit/adlogin_sub.php", {
                method: "POST",
                body: formData,
            })
            .then((response) => response.text())
            .then((data) => {
                // Check for errors in the response
                if (data.includes("Invalid password") || data.includes("Email not found")) {
                    alert("Invalid password or email not found! Please check your credentials.");  // Show error message
                } else {
                    window.location.href = "adminhome.php"; // Redirect to the admin dashboard on successful login
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            });
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    // Toggle the password visibility
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
     
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Toggle the eye icon to open to close
            this.classList.toggle("fa-eye-slash");
        });
    }
});

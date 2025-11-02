document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signup");

    // Handle the Sign Up form submission
    if (signupForm) {
        signupForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(signupForm);

            fetch("submit/adminsignup_sub.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    if (data.includes("Registration successful!")) {
                        alert("Registration successful!");
                        window.location.href = "adminlogin.php"; // Redirect to login page
                    } else if (data.includes("Email already exists")) {
                        alert("Email already exists");
                    } else {
                        alert("Error during registration");
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
            // Check the type of the input field and toggle it
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Toggle the eye icon (changing to open/closed)
            this.classList.toggle("fa-eye-slash");
        });
    }
});


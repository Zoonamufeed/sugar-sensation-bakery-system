document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signup");
    const loginForm = document.getElementById("login");
    const signupContainer = document.getElementById("signup-container");
    const loginContainer = document.getElementById("login-container");

    // Handle the Sign Up form submission
    if (signupForm) {
        signupForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(signupForm);

            fetch("submit/signup_sub.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to create an account");
                    }
                    return response.json();
                })
                .then((data) => {
                    alert(data.message);
                    if (data.success) {
                        signupContainer.style.display = "none"; // Hide the Sign Up form
                        location.reload();
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Successfully Registered");
                });
        });
    }

    // Handle the Login form submission
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(loginForm);

            fetch("submit/login_sub.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (response.status === 401) {
                        throw new Error("Invalid email or password");
                    } else if (!response.ok) {
                        throw new Error("Failed to log in");
                    }
                    return response.text();
                })
                .then(() => {
                    alert("Login successful!");
                    loginContainer.style.display = "none";
                    location.reload();
                    window.location.href = "main.php";
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert(error.message);
                });
        });
    }

    // Handle the close buttons for the forms
    document.querySelector(".close-signup").addEventListener("click", function () {
        signupContainer.style.display = "none";
    });

    document.querySelector(".close-login").addEventListener("click", function () {
        loginContainer.style.display = "none";
    });

    signupContainer.addEventListener("click", function (event) {
        if (event.target === signupContainer) {
            signupContainer.style.display = "none";
        }
    });

    loginContainer.addEventListener("click", function (event) {
        if (event.target === loginContainer) {
            loginContainer.style.display = "none";
        }
    });
});




/*search function*/
function search(event) {
    event.preventDefault(); // Prevent form submission
    const searchInput = document.getElementById('search-input').value.trim().toLowerCase();

    // Mapping keywords to URLs
    const pageRedirects = {
        "home":"main.php",
        "menu": "products.php",
        "contact": "contact.php",
        "aboutus": "aboutus.php",
        "about us": "aboutus.php",
        "about": "aboutus.php",
        "cola": "products.php",
        "sandwich": "products.php",
        "rice": "products.php",
    };

    if (pageRedirects[searchInput]) {
        // Redirect to the corresponding page
        window.location.href = pageRedirects[searchInput];
    } else {
        alert("No results found for your search.");
    }
}

/*count in main*/
let countStarted = false;

function startCounting(element, targetCount) {
    let count = 0;
    const interval = setInterval(() => {
        count++;
        element.innerHTML = count;
        if (count === targetCount) {
            clearInterval(interval);
        }
    }, 50);
}

window.addEventListener("scroll", () => {
    if (!countStarted) {
        const experienceSection = document.querySelector(".ratings");
        const sectionPosition = experienceSection.getBoundingClientRect();

        // Check if the ratings section is visible in the viewport
        if (sectionPosition.top >= 0 && sectionPosition.bottom <= window.innerHeight) {
            countStarted = true;

            // Get all labels and their target counts
            const labels = document.querySelectorAll(".experience label");
            labels.forEach(label => {
                const target = parseInt(label.getAttribute("data-target"), 10);
                startCounting(label, target);
            });
        }
    }
});

    

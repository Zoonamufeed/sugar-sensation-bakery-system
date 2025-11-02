document.getElementById('checkout-btn').addEventListener('click', function (event) {
    // Check if user is logged in
    const userLoggedIn = localStorage.getItem('user_logged_in');
    
    if (userLoggedIn !== 'true') {
        event.preventDefault(); // Prevent the default action (redirect to checkout page)
        alert('Please sign up or log in to proceed to checkout.'); // Show an alert message
        window.location.href = '#signup-container'; // Redirect to the signup section
    }
});

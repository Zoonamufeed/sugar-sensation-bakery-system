<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
require("../includes/databaseconnect.php");

// Start session
session_start();

// Check if the form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize the form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the email exists
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store session data for the user
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['full_name'];

            // Redirect to admin home page
            echo "<script>window.location.href = '../adminhome.php';</script>";
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password'); window.location.href = '../adminlogin.php';</script>";
        }
    } else {
        // No user found with the provided email
        echo "<script>alert('Email not found'); window.location.href = '../adminlogin.php';</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

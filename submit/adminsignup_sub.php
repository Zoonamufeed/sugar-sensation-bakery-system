
<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
require("../includes/databaseconnect.php");

// Check if the form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize the form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists'); window.location.href = 'adminsignup.php';</script>";
        exit();
    }

    // Insert the new admin into the database
    $insertQuery = "INSERT INTO admin (full_name, phone, email, password) VALUES ('$full_name', '$phone', '$email', '$hashed_password')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Registration successful!'); window.location.href = 'adminlogin.php';</script>";
    } else {
        echo "<script>alert('Error during registration: " . mysqli_error($conn) . "'); window.location.href = 'adminsignup.php';</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


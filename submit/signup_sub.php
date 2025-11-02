<?php
header('Content-Type: application/json'); 
require("../includes/databaseconnect.php");
session_start(); 


$full_name = $_POST["full_name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$password = $_POST["password"];
$password = sha1($password);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    // Return error message in JSON format
    $response = array("success" => false, "message" => "Something went wrong here!");
    echo json_encode($response);
    return;
}

$row_count = mysqli_num_rows($result);
if ($row_count != 0) {
    // If email already exists, return an error message
    $response = array("success" => false, "message" => "This email id is already registered with us!");
    echo json_encode($response);
    return;
}

// Insert new user into the database
$sql = "INSERT INTO users (full_name, phone, email, password) VALUES ('$full_name', '$phone', '$email', '$password')";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something is missing!");
    echo json_encode($response);
    return;
}

// Return success message
$response = array("success" => true, "message" => "Your account has been created successfully!");
echo json_encode($response);
exit;


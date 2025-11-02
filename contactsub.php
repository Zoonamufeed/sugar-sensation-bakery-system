<?php
session_start();
include "includes/databaseconnect.php";

// Taking all form values
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$subject = $_REQUEST["subject"];
$message = $_REQUEST["message"];

// Performing the insert query
$sql = "INSERT INTO contact (fname, lname, email, subject, message) VALUES ('$fname', '$lname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Your message has been submitted successfully!";
} else {
    $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: contact.php");
exit();
?>

/*

  //taking all 4 values from the form data input
  $fname=$_REQUEST["fname"];
  $lname=$_REQUEST["lname"];
  $email=$_REQUEST["email"];
 $subject=$_REQUEST["subject"];
 $message=$_REQUEST["message"];
// perfroming insert query

$sql = "INSERT INTO contact (fname, lname, email,subject,message) VALUES
 ('$fname','$lname', '$email', '$subject','$message')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Form submitted successfully!";
} else {
    $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
    header("Location: contact.php");
    exit();
?>*/

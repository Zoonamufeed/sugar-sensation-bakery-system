<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";        
$password = "";           
$dbname = "sugarsensationbakery"; 

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);  // If connection fails, stop the script and display the error

}
// $sql = "SELECT * FROM `delivery`";
$sql ="SELECT del_status FROM `delivery` WHERE delivery_date = CURDATE()";
$res = $mysqli->query($sql);

$data = [];
while($row = $res->fetch_assoc()){
    array_push($data, $row);
}

echo json_encode($data);

?>

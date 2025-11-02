<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";        
$password = "";            
$dbname = "sugarsensationbakery"; 

// Createing database connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);  
}
//query to get monthly sales
$sql = "SELECT 
            MONTH(created_at) AS month, 
            SUM(total_price) AS total_revenue
        FROM `order`
        -- WHERE YEAR(created_at) = YEAR(CURDATE()) 
        GROUP BY MONTH(created_at)
        ORDER BY MONTH(created_at)";

// Executing the query
$res = $mysqli->query($sql);
$data = [];
for ($i = 1; $i <= 12; $i++) {
    // Initialize all months with 0 revenue
    $data[$i] = 0; 
}

while ($row = $res->fetch_assoc()) {
    $month = $row['month'];
    $data[$month] = $row['total_revenue']; 
}
// Returning the data as JSON
echo json_encode($data); 
?>

<?php
include 'includes/databaseconnect.php';
//variables are intialized to store
$total_revenue = 0;
$start_date = "";
$end_date = "";
//checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // calculate the total revenue 
    $query = "SELECT SUM(total_price) AS total_revenue FROM `order` 
              WHERE created_at BETWEEN ? AND ?";
    // stmt is used to prevent sql injection and ss is converted to string
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    // if the total revenu is found it is stored in the tota revenu and if not found its stored as 0
    $total_revenue = $data['total_revenue'] ? $data['total_revenue'] : 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <title>Revenue Report</title>
    <link rel="stylesheet" href="css/revenureport.css">
    <link rel="stylesheet" href="css/homead.css">

</head>
<body>
<?php include 'includes/adminnavbar.php'; ?>

    <div class="report-container">
        <h2>Monthly Revenue Report</h2>
        <form action="" method="POST">
            <div class="inputBox">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="inputBox">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn_now">Generate Report</button>
        </form>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
            <table>
                <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $start_date; ?></td>
                        <td><?php echo $end_date; ?></td>
                        <td><b><span style="color:red;">$<?php echo number_format($total_revenue, 2); ?></span></b></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php include "includes/adminfooter.php"; ?>
</body>
</html>

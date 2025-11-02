<?php
include 'includes/databaseconnect.php';
// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    // Join query to fetch the devlivery details
    $query = "SELECT delivery.id, delivery.order_id, delivery.order_cname, delivery.contact_no, 
                     delivery.delivery_address, delivery.delivery_date, delivery.delivery_time, 
                     delivery.del_status 
              FROM `delivery` 
              JOIN `order` ON delivery.order_id = `order`.id 
              WHERE delivery.del_status = ? 
              AND delivery.delivery_date BETWEEN ? AND ?";
      // Prepareing and executeing while stmt is used to prevent sql injection and sss is converted to string
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $status, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <title>Delivery Status Report</title>
    <link rel="stylesheet" href="css/filter.css">
    <link rel="stylesheet" href="css/homead.css">
</head>
<body>
<?php include 'includes/adminnavbar.php'; ?>

    <div class="report-container">
        <h2>Delivery Status Report</h2>
        <form action="" method="POST">
            <div class="inputBox">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="inputBox">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="inputBox">
                <label for="status">Delivery Status</label>
                <select name="status" required>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="delivered">Delivered</option>
                </select>
            </div>
            <button type="submit" class="btn_now">Generate Report</button>
        </form>

        <?php
        // If the query has been executed and results are present
        if (isset($result)) :
            // Check if there are any records returned
            if ($result->num_rows > 0): ?>
                <table id="orderFilter">
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Contact No</th>
                        <th>Delivery Address</th>
                        <th>Delivery Date</th>
                        <th>Delivery Time</th>
                        <th>Status</th>
                        <button onclick="window.print()">Print Report</button>
                        <button onclick="exportTableToExcel('orderFilter', 'status_Report')">Export to Excel</button>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['order_cname']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td><?php echo $row['delivery_address']; ?></td>
                            <td><?php echo $row['delivery_date']; ?></td>
                            <td><?php echo $row['delivery_time']; ?></td>
                            <td><?php echo $row['del_status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p style="color:red;">No records found for the selected dates and status.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php include "includes/adminfooter.php"; ?>
<script>
function exportTableToExcel(tableID, filename = ''){
    //creating link
    const downloadLink = document.createElement("a");
    //changing to vnd.ms-excel type
    const dataType = 'application/vnd.ms-excel';
    // calling the table by id
    const tableSelect = document.getElementById(tableID);
    // Get HTML of the table and encode spaces for UR
    const tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify filename
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link and Create a data URL with the table HTML
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    downloadLink.download = filename;

    // Trigger the download
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
</script>

</body>
</html>

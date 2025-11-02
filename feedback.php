<?php
include 'includes/databaseconnect.php';
?>
<!-- display feeback -->
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet"/>
    <link href="css/feedback.css" rel="stylesheet"/>
    <title>customer feedback</title>
</head>
<body>
<?php include 'includes/adminnavbar.php'; ?>
    <!-- Displaying Contact Information -->
<section class="display-contact-table">
    <table>
        <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </thead>
        <tbody>
            <?php
            // Fetching data from the contact table
            $contacts_query = mysqli_query($conn, "SELECT * FROM `contact`") or die('Query failed');
            
            // Checking if there are any records
            if (mysqli_num_rows($contacts_query) > 0) {
                while ($row = mysqli_fetch_assoc($contacts_query)) {
            ?>
            <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['message']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' class='empty'>No contact messages available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>
<?php include "includes/adminfooter.php"; ?>
</body>
</html>
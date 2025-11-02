<?php
session_start();
require "includes/databaseconnect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "includes/header_links.php";
    ?>
   <link href="css/homead.css" rel="stylesheet"/>
   <link rel="stylesheet" href="css/admin.css">
    <title>Amin dashboard</title>
</head>
<body>
    <!--navbar-->
    <?php
    include 'includes/adminnavbar.php';
 ?>
    <div class="my-profile page-container">
        <h1>My Profile</h1>
        <div class="row">
            <div class="col-md-3 profile-img-container">
                <i class="fas fa-user profile-img"></i>
            </div>
            <div class="col-md-9">
                <div class="row no-gutters justify-content-between align-items-end">
                    <div class="profile">
                        <div class="name"><?= $user['full_name'] ?></div>
                        <div class="email"><?= $user['email'] ?></div>
                        <div class="phone"><?= $user['phone'] ?></div>
                    </div>
                    <div class="edit">
                        <div class="edit-profile">Edit Profile</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    include "includes/adminfooter.php";
    ?>
</body>
</html>

      
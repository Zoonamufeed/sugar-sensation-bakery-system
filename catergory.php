<?php
include 'includes/databaseconnect.php';


// Add Category
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    // Check if the category already exists data duplication
    $check_category_query = mysqli_query($conn, "SELECT * FROM `categories` WHERE name = '$category_name'") or die('Query failed');
     // if category already exists 
    if (mysqli_num_rows($check_category_query) > 0) {
        $message[] = 'Category already exists'; 
    } else {
        // Insert new category if the catergory doesn't exit
        $insert_category_query = mysqli_query($conn, "INSERT INTO `categories` (name) VALUES ('$category_name')") or die('Query failed');
        if ($insert_category_query) {
            $message[] = 'Category added successfully';
        } else {
            $message[] = 'Failed to add category';
        }
    }
}

// Delete Category
if (isset($_GET['delete_category'])) {
   $delete_category_id = $_GET['delete_category'];
   $delete_category_query = mysqli_query($conn, "DELETE FROM `categories` WHERE id = $delete_category_id") or die('Query failed');
   if ($delete_category_query) {
       $message[] = 'Category deleted successfully';
   } else {
       $message[] = 'Category could not be deleted';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/header_links.php"; ?>
    <link href="css/homead.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/categroy.css">
    <title>Category Management</title>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span> 
        <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
}
?>
<?php include 'includes/adminnavbar.php'; ?>

<!-- Add Category Form -->
<section>
    <form action="" method="post" class="add-category-form">
        <h3>Add a New Category</h3>
        <input type="text" name="category_name" placeholder="Enter category name" class="box" required>
        <input type="submit" value="Add Category" name="add_category" class="btn">
    </form>
</section>

<!-- Display Categories -->
<section class="display-product-table">
    <table>
        <thead>
            <th>Category Name</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            $categories_query = mysqli_query($conn, "SELECT * FROM `categories`") or die('Query failed');
            if (mysqli_num_rows($categories_query) > 0) {
                while ($row = mysqli_fetch_assoc($categories_query)) {
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <a href="catergory.php?delete_category=<?php echo $row['id']; ?>" class="delete-btn" name="delete_category" onclick="return confirm('Are you sure you want to delete this category?');">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='2' class='empty'>No categories available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<?php include "includes/adminfooter.php"; ?>

</body>
</html>

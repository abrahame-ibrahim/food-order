<?php
include('../config/constants.php');

// Check if ID and image name are set for the food item
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id']; 
    $image_name = $_GET['image_name'];

    // Display the delete confirmation prompt
    echo "<script>
        if (confirm('Are you sure you want to delete this food item?')) {
            window.location.href = 'delete-food.php?id=$id&image_name=$image_name&confirm=yes';
        } else {
            window.location.href = '" . SITEURL . "admin/manage-food.php';
        }
    </script>";

    // Check if 'confirm=yes' is in the URL, which indicates the admin confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {

        // If image_name is not empty, try to remove the image file
        if ($image_name != "") {
            $path = "../images/food/" . $image_name;  // Corrected path for food images
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to remove food image.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();
            }
        }

        // SQL query to delete the food item
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
        }

        // Redirect to manage food page
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

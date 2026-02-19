<?php
include('../config/constants.php');

// Check if id and image_name are set in the URL parameters
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Retrieve the values from the URL parameters
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // If the user confirms deletion, proceed
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Remove the image file if image_name is not empty
        if ($image_name != "") {
            $path = "../images/category/" . $image_name;

            // Check if the file exists before attempting to delete it
            if (file_exists($path)) {
                $remove = unlink($path);

                // If the image removal failed, set a session message and redirect
                if ($remove == false) {
                    $_SESSION['remove'] = "<div class='error'>Failed to remove category image. Please check file permissions.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    die();
                }
            } else {
                $_SESSION['remove'] = "<div class='error'>Category image does not exist on the server.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                die();
            }
        }

        // SQL query to delete the category from the database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to delete category. Database query failed.</div>";
        }

        // Redirect to manage-category.php with the appropriate session message
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // Display a JavaScript confirmation prompt
        echo "<script>
            if (confirm('Are you sure you want to delete this category?')) {
                window.location.href = 'delete-category.php?id=$id&image_name=$image_name&confirm=yes';
            } else {
                window.location.href = '" . SITEURL . "admin/manage-category.php';
            }
        </script>";
    }
} else {
    // Redirect to manage-category.php if id and image_name are not set in the URL parameters
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>

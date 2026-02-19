<?php 
ob_start(); 
include('partials/menu.php'); 
?>

<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer

    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 && mysqli_num_rows($res2) == 1) {
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $unit = $row2['unit']; // Add this line to fetch unit
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit();
}
?>

<?php
if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']); // Capture unit here
    $current_image = $_POST['current_image'];
    $category = intval($_POST['category']);
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // Check if food ID still exists in DB
    $sql_check = "SELECT * FROM tbl_food WHERE id = $id";
    $res_check = mysqli_query($conn, $sql_check);
    if (!$res_check || mysqli_num_rows($res_check) == 0) {
        $_SESSION['update'] = "<div class='error'>Invalid food ID. No record to update.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        ob_end_flush();
        exit();
    }

    // Handle image upload
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = "Food-Name-" . rand(100, 999) . '.' . $ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);
        if (!$upload) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload new Image.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            ob_end_flush();
            exit();
        }

        // Remove old image if exists
        if ($current_image != "") {
            $remove_path = "../images/food/" . $current_image;
            $remove = unlink($remove_path);
            if (!$remove) {
                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                ob_end_flush();
                exit();
            }
        }
    } else {
        $image_name = $current_image; // Keep old image
    }

    // Update query, include unit
    $sql3 = "UPDATE tbl_food SET 
        title = '$title',
        description = '$description',
        price = $price,
        unit = '$unit',
        image_name = '$image_name',
        category_id = $category,
        featured = '$featured',
        active = '$active'
        WHERE id = $id";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3) {
        $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update Food. Error: " . mysqli_error($conn) . "</div>";
    }

    header('location:' . SITEURL . 'admin/manage-food.php');
    ob_end_flush();
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo htmlspecialchars($description); ?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" step="0.01" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Unit:</td> <!-- Unit input field -->
                    <td><input type="text" name="unit" value="<?php echo htmlspecialchars($unit); ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            echo "<img src='" . SITEURL . "images/food/$current_image' width='150px'>";
                        } else {
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            if ($res && mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    $selected = ($current_category == $category_id) ? "selected" : "";
                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                            } else {
                                echo "<option value='0'>Category not available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

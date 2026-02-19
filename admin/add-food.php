<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" placeholder="Enter price"></td>
                </tr>

                <!-- ✅ Added Unit input -->
                <tr>
                    <td>Unit:</td>
                    <td><input type="text" name="unit" placeholder="E.g. 1 Plate, 500g"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $unit = mysqli_real_escape_string($conn, $_POST['unit']); // ✅ Capture unit
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Handle image upload
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                
                // Extract extension using pathinfo()
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                // Rename the image
                $image_name = "Food_Name_" . rand(0000, 9999) . "." . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                // Upload the image
                if (!move_uploaded_file($source_path, $destination_path)) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:' . SITEURL . 'admin/add-food.php');
                    die();
                }
            } else {
                $image_name = "";
            }

            // Insert into database including unit
            $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = '$price',
                unit = '$unit', -- ✅ Insert unit
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header('location:' . SITEURL . 'admin/add-food.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

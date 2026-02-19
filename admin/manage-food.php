<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br /><br /><br />

        <!-- Search Form -->
        <form action="" method="POST">
            <input type="text" name="search" placeholder="Search for food..." required>
            <button type="submit" name="submit" class="btn-secondary">Search</button>
        </form>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <?php
        // CSV Export Functionality
        if (isset($_POST['export_csv'])) {
            ob_clean();

            $sql = "SELECT * FROM tbl_food ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename="food_report.csv"');

                $output = fopen('php://output', 'w');

                // Include Unit in CSV
                $headers = ['S.N.', 'Title', 'Price', 'Unit', 'Quantity', 'Image Name', 'Featured', 'Active'];
                fputcsv($output, $headers);

                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $data = [
                        $sn++,
                        $row['title'],
                        $row['price'],
                        $row['unit'],
                        isset($row['quantity']) ? $row['quantity'] : 0,
                        $row['image_name'],
                        $row['featured'],
                        $row['active']
                    ];
                    fputcsv($output, $data);
                }

                fclose($output);
                exit();
            } else {
                echo "<script>alert('No food items available to export.');</script>";
            }
        }
        ?>

        <!-- Button to Download CSV -->
        <form method="post">
            <button type="submit" name="export_csv" class="btn-primary">Download Food Report</button>
        </form>
        <br /><br />

        <!-- Update Quantity Logic -->
        <?php
        if (isset($_POST['update_quantity'])) {
            $food_id = $_POST['food_id'];
            $new_quantity = $_POST['new_quantity'];
            $new_unit = $_POST['new_unit']; // Fetch new unit value

            // Update query now includes unit
            $update_sql = "UPDATE tbl_food SET quantity = '$new_quantity', unit = '$new_unit' WHERE id = '$food_id'";
            $update_res = mysqli_query($conn, $update_sql);

            if ($update_res) {
                $_SESSION['update'] = "<div class='success'>Quantity and Unit Updated Successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Quantity and Unit.</div>";
            }

            echo "<script>window.location.href='manage-food.php';</script>";
            exit();
        }
        ?>

        <!-- Food Table -->
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Unit</th> <!-- New Unit Column Header -->
                <th>Quantity</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // Fetch food items
            if (isset($_POST['submit'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM tbl_food ORDER BY id DESC";
            }

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $unit = isset($row['unit']) ? $row['unit'] : ''; // Get unit
                    $quantity = isset($row['quantity']) ? $row['quantity'] : 0;
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td>sh.<?php echo $price; ?></td>
                        <td><?php echo $unit; ?></td> <!-- New Unit Column Value -->
                        <td>
                            <form method="post" style="display: flex; align-items: center;">
                                <input type="number" name="new_quantity" value="<?php echo $quantity; ?>" min="0" style="width: 60px; margin-right: 5px;">
                                <input type="text" name="new_unit" value="<?php echo $unit; ?>" style="width: 60px; margin-right: 5px;"> <!-- Unit Input -->
                                <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                <button type="submit" name="update_quantity" class="btn-secondary">Update</button>
                            </form>
                        </td>
                        <td>
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not added.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9' class='error'>Food not found.</td></tr>"; //<!-- Corrected colspan to 9 -->
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>

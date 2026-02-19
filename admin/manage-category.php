<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <?php
        // Display session messages
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>

        <br><br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <!-- Search Form -->
        <form action="" method="POST" style="margin-top: 20px;">
            <input type="text" name="search" placeholder="Search Category..." class="input-responsive">
            <input type="submit" name="submit" value="Search" class="btn-primary">
        </form>
        <br><br>

        <?php
        // CSV Export Functionality
        if (isset($_POST['export_csv'])) {
            ob_clean(); // Clean output buffer

            // Fetch categories
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                // Set headers for CSV download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename="categories.csv"');

                // Open output stream
                $output = fopen('php://output', 'w');

                // Write column headers
                $headers = ['S.N.', 'Title', 'Image', 'Featured', 'Active'];
                fputcsv($output, $headers);

                // Write category data
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $data = [
                        $sn++,
                        $row['title'],
                        $row['image_name'],
                        $row['featured'],
                        $row['active']
                    ];
                    fputcsv($output, $data);
                }

                fclose($output);
                exit(); // Stop script execution after output
            } else {
                echo "<script>alert('No categories available to export.');</script>";
            }
        }
        ?>

        <!-- Button to Download CSV -->
        <form method="POST">
            <button type="submit" name="export_csv" class="btn-primary">Download Report</button>
        </form>
        <br><br>

        <!-- Category Table -->
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // SQL query to fetch categories
            $sql = "SELECT * FROM tbl_category";

            if (isset($_POST['submit'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                $sql = "SELECT * FROM tbl_category WHERE title LIKE '%$search%'";
            }

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $sn = 1; // Serial number
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Image not added.</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'><div class='error'>No Category Found.</div></td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>

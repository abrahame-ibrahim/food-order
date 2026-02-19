<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        // Check if the ID is passed in the URL
        if (isset($_GET['id'])) {
            // Get the ID of the selected admin
            $id = $_GET['id'];

            // SQL query to get admin details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            // Check if the query executed successfully
            if ($res == true) {
                $count = mysqli_num_rows($res);

                // Check if admin exists
                if ($count == 1) {
                    // Get admin details
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    // Redirect if admin not found
                    $_SESSION['update'] = "<div class='error'>Admin Not Found.</div>";
                    header('location:' . SITEURL . 'admin/manage.admin.php');
                    exit();
                }
            } else {
                // Handle query failure
                $_SESSION['update'] = "<div class='error'>Failed to Fetch Admin Details.</div>";
                header('location:' . SITEURL . 'admin/manage.admin.php');
                exit();
            }
        } else {
            // Redirect if ID is not passed
            $_SESSION['update'] = "<div class='error'>Unauthorized Access.</div>";
            header('location:' . SITEURL . 'admin/manage.admin.php');
            exit();
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Get values from form
    $id = $_POST['id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    // SQL query to update admin details
    $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage.admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
        header('location:' . SITEURL . 'admin/manage.admin.php');
    }
}
?>

<?php include('partials/footer.php'); ?>

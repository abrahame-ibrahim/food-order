<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php
        // Display session message if set
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
// Process the form only if the submit button is clicked
if (isset($_POST['submit'])) {
    // Use isset to ensure these keys exist
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';

    // Database connection
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conn)); // Replace '' with 'your_password' if root has a password
    $db_select = mysqli_select_db($conn, 'food-fusion') or die(mysqli_error($conn));

    // SQL query to insert admin data
    $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res) {
        // Set session message if successful
        $_SESSION['add'] = "Admin added successfully.";
    } else {
        // Set session message if failed
        $_SESSION['add'] = "Failed to add admin.";
    }

    // Redirect to the same page or another page after submission
    header('Location: add-admin.php');
}
?>

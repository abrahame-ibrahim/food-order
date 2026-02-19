
<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the registration page
    $_SESSION['no-access-message'] = "Please register or log in to access the homepage.";
    header("Location: register.php");
    exit();
}
?>

<!-- Homepage content here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Food Order System</title>
</head>
<body>
    <h1>Welcome to the Food Order System!</h1>
    <p>You are successfully registered and logged in as <?php echo $_SESSION['user']; ?>.</p>
</body>
</html>

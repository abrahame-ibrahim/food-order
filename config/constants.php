<?php
// Start the session to manage user login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define constants for site URL and database credentials only if not already defined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/food-fusion/');
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'food-fusion');
}

// Establish the database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Ensure database selection is successful
$db_select = mysqli_select_db($conn, DB_NAME);

if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>

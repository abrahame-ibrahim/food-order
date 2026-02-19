<?php
session_start();  // Start the session at the beginning

// Include database configuration
include('config/constants.php');
include('partials-front/menu.php'); 

// Handle form submission
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain password (to hash later)
    $contact = $_POST['contact'];

    // Sanitize input (good practice to avoid XSS or other issues)
    $username = htmlspecialchars($username);
    $email = htmlspecialchars($email);
    $contact = htmlspecialchars($contact);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Hash the password using PASSWORD_DEFAULT
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Connect to the database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, contact) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $contact);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Registration successful! You can now log in.";

            // Redirect to login.php after successful registration
            header('Location: login.php');
            exit; // Ensure no further code is executed after redirection
        } else {
            $error = "Failed to register. Please try again.";
        }

        // Close the prepared statement and connection
        $stmt->close();
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Online Ordering System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .register-container { width: 400px; margin: 100px auto; padding: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); border-radius: 10px; }
        h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        .error { color: red; font-size: 0.9em; }
        .login-link { text-align: center; margin-top: 10px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
            <button type="submit" name="register">Register</button>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
<?php include('partials-front/footer.php'); ?>
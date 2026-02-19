<?php
// Include the database connection file
include('../config/constants.php');

// Start the session if it isn't already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish the database connection if not already done
    if (!isset($conn)) {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
    }

    // Get form data and escape it
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    
    // Encrypt password using password_hash for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // SQL query to insert user into the database
    $sql = "INSERT INTO admins (username, email, password, contact) 
            VALUES ('$username', '$email', '$hashed_password', '$contact')";

    // Execute query and check if successful
    if (mysqli_query($conn, $sql)) {
        // Registration success
        $_SESSION['Register'] = "Registration successful. You can now log in.";
        header('location: login.php');
    } else {
        // Registration failed
        $_SESSION['no-Register-message'] = "Registration failed. Please try again.";
        header('location: register.php');
    }
}
?>

<html>
<head>
    <title>Register - Food Order System</title>
    <style>
        /* Your existing CSS here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .Register {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1.text-center {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .message.success {
            color: green;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

c
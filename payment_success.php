<?php
session_start();

// Check if the cart is empty (to prevent direct access to this page)
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Clear the cart (optional, if not already cleared in the checkout process)
$_SESSION['cart'] = [];

// You can also destroy the session completely if needed
// session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        .success-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .success-message {
            font-size: 18px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .continue-link {
            text-decoration: none;
            font-size: 16px;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="success-container">
    <h1>Payment Successful!</h1>
    <p class="success-message">Thank you for your order. Your payment has been processed successfully.</p>
    <p><a class="continue-link" href="index.php">Continue Shopping</a></p>
</div>

</body>
</html>

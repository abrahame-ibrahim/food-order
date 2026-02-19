<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure the cart is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Calculate the grand total for the cart
$grandTotal = 0;
foreach ($_SESSION['cart'] as $id => $details) {
    $grandTotal += $details['price'] * $details['quantity'];
}

// If the user submits the checkout form, handle the order details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $amount = $grandTotal;

    if (!preg_match('/^\d{10}$/', $phone)) {
        $error = "Invalid phone number. Please enter a 10-digit phone number.";
    } else {
        // Simulate payment success
        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            // Clear the cart
            $_SESSION['cart'] = [];

            // Redirect to success page
            header("Location: mpesai/m-pesa.php");
            exit();
        } else {
            $error = "Payment failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Styles for checkout and MPESA integration */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .checkout-container, .mpesa-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #007bff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            background: #ffe6e6;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #ffcccc;
        }
    </style>
</head>
<body>

<!-- Checkout Form -->
<div class="checkout-container">
    <!-- <h1>Delivery Details</h1> -->
    <form action="checkout.php" method="POST">
        <!-- <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="address">Shipping Address:</label>
            <textarea name="address" id="address" placeholder="Enter your shipping address" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>
        </div> -->
        <!-- <button type="submit" name="submit">Proceed to Payment</button> -->
    </form>
</div>

<!-- MPESA Payment Integration -->
<div class="mpesa-container">
    <h2>Mpesa Payment</h2>
    <form action="mpesai/stk_initiate.php" method="POST">
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" name="amount" value="<?= htmlspecialchars($grandTotal); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" required>
        </div>
        <button type="submit" class="btn btn-success" name="submit" value="submit">Make Payment</button>
    </form>
</div>

</body>
</html>

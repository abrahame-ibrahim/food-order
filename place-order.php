<?php
// Include the database connection (adjust path as needed)
include('config/constants.php');

// Start the session for user authentication
session_start();

// Ensure that the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    $_SESSION['order_error'] = "Please log in to place an order.";
    header('location: login.php');
    exit();
}

// Check if the form is submitted to place an order
if (isset($_POST['place_order'])) {
    $customer_id = $_SESSION['customer_id']; // Assuming the user is logged in
    $cart = $_SESSION['cart']; // Cart contains food_id, quantity, unit, and price

    // Calculate total amount
    $total_amount = 0;
    foreach ($cart as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    // Insert into tbl_orders to create an order
    $sql_order = "INSERT INTO tbl_orders (customer_id, total_amount) VALUES ('$customer_id', '$total_amount')";
    $res_order = mysqli_query($conn, $sql_order);

    if ($res_order) {
        // Get the last inserted order ID
        $order_id = mysqli_insert_id($conn);

        // Insert order items into tbl_order_items
        foreach ($cart as $item) {
            $food_id = $item['food_id'];
            $quantity = $item['quantity'];
            $unit = $item['unit']; // Added unit to the order item
            $price = $item['price'];

            $sql_items = "INSERT INTO tbl_order_items (order_id, food_id, quantity, unit, price) 
                          VALUES ('$order_id', '$food_id', '$quantity', '$unit', '$price')";
            mysqli_query($conn, $sql_items);
        }

        // Clear the cart after the order is placed
        unset($_SESSION['cart']);
        $_SESSION['order_success'] = "Your order has been placed successfully!";
        header('location: order-success.php'); // Redirect to success page
    } else {
        // If the order insertion failed
        $_SESSION['order_error'] = "Failed to place your order. Please try again.";
        header('location: cart.php'); // Redirect back to the cart page
    }
}

// Check if the form is for adding the order (from the frontend)
if (isset($_POST['submit_order'])) {
    // Get form data
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in and their ID is stored in session

    // Get food details (like price) from the database
    $sql = "SELECT * FROM tbl_food WHERE id='$food_id' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    $food_data = mysqli_fetch_assoc($res);

    if ($food_data) {
        // Calculate total price (assuming price is per unit)
        $price = $food_data['price'];
        $total_price = $price * $quantity;

        // Insert order into the orders table (assuming an 'orders' table exists)
        $order_sql = "INSERT INTO tbl_orders (user_id, food_id, quantity, unit, total_price, order_date)
                      VALUES ('$user_id', '$food_id', '$quantity', '$unit', '$total_price', NOW())";
        $order_res = mysqli_query($conn, $order_sql);

        if ($order_res) {
            $_SESSION['order_success'] = "<div class='success'>Order placed successfully!</div>";
            header('Location: order-success.php');
        } else {
            $_SESSION['order_error'] = "<div class='error'>Failed to place order. Please try again.</div>";
            header('Location: cart.php');
        }
    } else {
        $_SESSION['order_error'] = "<div class='error'>Food not found. Please select a valid item.</div>";
        header('Location: cart.php');
    }
}
?>

<?php
include('partials-front/menu.php'); 

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the form is submitted and handle the action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Handle the addition of items to the cart
    if ($action === 'add' && isset($_POST['food_id'], $_POST['food_name'], $_POST['price'], $_POST['quantity'])) {
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $price = (float)$_POST['price'];
        $quantity = (int)$_POST['quantity'];

        // Check if the item already exists in the cart
        if (isset($_SESSION['cart'][$food_id])) {
            // Update quantity if the item is already in the cart
            $_SESSION['cart'][$food_id]['quantity'] += $quantity;
        } else {
            // Add new item to the cart
            $_SESSION['cart'][$food_id] = [
                'food_name' => $food_name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }

        // Redirect back to the previous page (food menu)
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Handle the update of item quantity
    if ($action === 'update' && isset($_POST['food_id'], $_POST['quantity'])) {
        $food_id = $_POST['food_id'];
        $quantity = (int)$_POST['quantity'];

        // Update the quantity
        if (isset($_SESSION['cart'][$food_id]) && $quantity > 0) {
            $_SESSION['cart'][$food_id]['quantity'] = $quantity;
        }

        // Redirect back to cart
        header('location: cart.php');
        exit();
    }

    // Handle the removal of an item from the cart
    if ($action === 'remove' && isset($_POST['food_id'])) {
        $food_id = $_POST['food_id'];

        // Remove the item from the cart
        if (isset($_SESSION['cart'][$food_id])) {
            unset($_SESSION['cart'][$food_id]);
        }

        // Redirect back to cart
        header('location: cart.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .cart-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .total {
            font-size: 1.2em;
            font-weight: bold;
            color: #007bff;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }

        button:hover {
            background-color: #0056b3;
        }

        .checkout {
            margin-top: 20px;
            text-align: right;
        }

        .checkout button {
            padding: 12px 20px;
            font-size: 1em;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 0.9em;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .empty-cart {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 20px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="cart-container">
    <h1>Your Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grandTotal = 0;
            if (!empty($_SESSION['cart'])):
                foreach ($_SESSION['cart'] as $food_id => $details):
                    $itemTotal = $details['price'] * $details['quantity'];
                    $grandTotal += $itemTotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($details['food_name']) ?></td>
                <td>Ksh.<?= number_format($details['price'], 2) ?></td>
                <td>
                    <form action="cart.php" method="POST" style="display: inline;">
                        <input type="number" name="quantity" value="<?= $details['quantity'] ?>" min="1" required>
                        <input type="hidden" name="food_id" value="<?= htmlspecialchars($food_id) ?>">
                        <input type="hidden" name="action" value="update">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>Ksh.<?= number_format($itemTotal, 2) ?></td>
                <td>
                    <form action="cart.php" method="POST" style="display: inline;">
                        <input type="hidden" name="food_id" value="<?= htmlspecialchars($food_id) ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?> 
            <tr>
                <td colspan="3" class="total">Grand Total</td>
                <td class="total">Ksh.<?= number_format($grandTotal, 2) ?></td>
                <td></td>
            </tr>
            <?php else: ?>
            <tr>
                <td colspan="5" class="empty-cart">Your cart is empty.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="checkout">
        <?php if (!empty($_SESSION['cart'])): ?>
        <a href="orders.php"><button>Proceed to Checkout</button></a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

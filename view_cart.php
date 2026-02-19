<?php
session_start();

echo "<h2>Your Cart</h2>";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<table border='1'>";
    echo "<tr><th>Food Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<tr>
                <td>{$item['food_name']}</td>
                <td>sh{$item['price']}</td>
                <td>{$item['quantity']}</td>
                <td>sh{$item['total_price']}</td>
              </tr>";
    }
    echo "</table>";
    echo "<br><a href='checkout.php'>Proceed to Checkout</a>";
}
?>

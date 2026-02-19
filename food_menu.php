<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'food-fusion');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// fetch food items
$sql = "SELECT * FROM food_items";
$result = mysqli_query($conn, $sql);

echo "<h2>Menu</h2>";
echo "<form method='POST' action='order.php'>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div style='margin-bottom: 20px;'>";
    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "<p><strong>Price:</strong> KSh " . number_format($row['price'], 2) . " per " . htmlspecialchars($row['unit']) . "</p>";
    echo "<label>Quantity:</label> ";
    echo "<input type='number' name='quantity[" . $row['id'] . "]' min='0' value='0'>";
    echo "</div>";
}
echo "<input type='submit' value='Place Order'>";
echo "</form>";

mysqli_close($conn);
?>

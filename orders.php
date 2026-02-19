<?php  
// Start session at the top of the file to avoid any header issues
session_start();

// Set the default timezone to Nairobi (Kenya)
date_default_timezone_set('Africa/Nairobi');

// Include the necessary files
include('partials-front/menu.php'); 

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get customer details from form submission
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    // Get the current date and time
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    // Loop through cart items and insert them into the order
    foreach ($_SESSION['cart'] as $food_id => $cart_item) {
        $food_name = $cart_item['food_name'];
        $price = $cart_item['price'];
        $qty = $cart_item['quantity'];
        $total = $price * $qty;

        // Insert order into database
        $sql = "INSERT INTO tbl_order SET 
            food = '$food_name',
            price = '$price',
            qty = '$qty',
            total = '$total',
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'";
        
        if (!mysqli_query($conn, $sql)) {
            echo "<div class='error text-center'>Failed to place the order. Please try again later.</div>";
            exit();
        }
    }

    // Set a session success message
    $_SESSION['order'] = "<div class='success text-center'>Order placed successfully.</div>";

    // Optional: Clear the cart after order submission
    // unset($_SESSION['cart']);

    // Redirect to checkout page
    header('Location: checkout.php');
    exit();
}
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="post" class="order">
            <fieldset>
                <legend>Cart Items</legend>
                <div>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        echo "<table class='cart-table'>";
                        echo "<thead>
                                <tr>
                                    <th>Food Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                              </thead><tbody>";
                        foreach ($_SESSION['cart'] as $food_id => $cart_item) {
                            echo "<tr>
                                    <td>{$cart_item['food_name']}</td>
                                    <td>sh{$cart_item['price']}</td>
                                    <td>
                                        <form action='' method='post' style='display: inline-block;'>
                                            <input type='number' name='update_qty' value='{$cart_item['quantity']}' min='1' required>
                                            <input type='hidden' name='update_food_id' value='{$food_id}'>
                                            <button type='submit' name='update_cart' class='btn btn-secondary'></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='' method='post' style='display: inline-block;'>
                                            <input type='hidden' name='remove_food_id' value='{$food_id}'>
                                            <button type='submit' name='remove_cart' class='btn btn-danger'>Remove</button>
                                        </form>
                                    </td>
                                  </tr>";
                            echo "<input type='hidden' name='cart_items[]' value='" . json_encode($cart_item) . "'>";
                        }
                        echo "</tbody></table>";
                    }
                    ?>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Ibrahim" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. ibrahim@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

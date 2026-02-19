<?php include('partials-front/menu.php'); ?>

<?php
// Start session for cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if category ID is provided
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch category title
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } else {
        header('location:' . SITEURL);
        exit();
    }
} else {
    header('location:' . SITEURL);
    exit();
}
?>

<!-- FOOD SEARCH -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>

<!-- FOOD MENU -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="text-right">
            <a href="<?php echo SITEURL; ?>cart.php" class="btn btn-primary">View Cart (<?php echo count($_SESSION['cart']); ?>)</a>
        </div>
        <br>

        <?php
        // Fetch foods under the selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 && mysqli_num_rows($res2) > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                $quantity = isset($row2['quantity']) ? (int)$row2['quantity'] : 0;
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if ($image_name != "") { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } else { echo "<div class='error'>Image not available.</div>"; } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">sh<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>

                        <?php if ($quantity > 0) { ?>
                        <form action="<?php echo SITEURL; ?>cart.php" method="POST">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="food_name" value="<?php echo $title; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <label for="quantity-<?php echo $id; ?>">Quantity:</label>
                            <input type="number" id="quantity-<?php echo $id; ?>" name="quantity" value="1" min="1" max="<?php echo $quantity; ?>" required>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                        <?php } else { ?>
                            <p class="error">Out of Stock</p>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='error'>Food not available.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

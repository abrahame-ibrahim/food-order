<?php 

include('partials-front/menu.php'); 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        
        <!-- Add Cart Button -->
        <div class="text-right">
            <a href="<?php echo SITEURL; ?>cart.php" class="btn btn-primary">View Cart (<?php echo count($_SESSION['cart']); ?>)</a>
        </div>
        <br>
        
        <?php
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if ($image_name != "") { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } else { ?>
                            <div class="error">Image not available.</div>
                        <?php } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">sh.<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <form action="<?php echo SITEURL; ?>cart.php" method="POST">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="food_name" value="<?php echo $title; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <label for="quantity-<?php echo $id; ?>">Quantity:</label>
                            <input type="number" id="quantity-<?php echo $id; ?>" name="quantity" value="1" min="1" required>
                            <button type="submit" class="btn btn-primary">Add Cart</button>
                        </form>
                        <!-- <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-secondary">Order Now</a> -->
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food not found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

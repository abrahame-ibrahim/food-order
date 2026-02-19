<?php
session_start(); // Start the session

// Include constants for DB connection
include('config/constants.php');

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['no-access-message'] = "Please register or log in to access the homepage.";
    header("Location: login.php");
    exit();
}

include('partials-front/menu.php');
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <a href="orders.php">Orders</a>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php if ($image_name == "") { ?>
                            <div class="error">Image not Available.</div>
                        <?php } else { ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class='error'>No categories added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // ✏️ IMPORTANT: Add 'quantity' field to your SELECT!
        $sql2 = "SELECT id, title, price, description, image_name, quantity FROM tbl_food WHERE active='Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 && mysqli_num_rows($res2) > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $available_quantity = $row['quantity']; // 🆕 Fetch available quantity
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if ($image_name == "") { ?>
                            <div class="error">Image not Available.</div>
                        <?php } else { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">sh.<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <?php if ($available_quantity > 0) { ?>
                            <form action="<?php echo SITEURL; ?>cart.php" method="POST">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="food_name" value="<?php echo $title; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <label for="quantity-<?php echo $id; ?>">Quantity:</label>
                                <input type="number" id="quantity-<?php echo $id; ?>" name="quantity"
                                    value="1" min="1" max="<?php echo $available_quantity; ?>" required>
                                <button type="submit" class="btn btn-primary">Add Cart</button>
                            </form>
                            
                        <?php } else { ?>
                            <div class="error">Out of stock</div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='error'>No food items available.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>


<?php include('partials-front/footer.php'); ?>

<?php 
 include('config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food-Fusion Website</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>" title="Home"><i class="fas fa-home"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>categories.php" title="Categories"><i class="fas fa-th-large"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>foods.php" title="Foods"><i class="fas fa-utensils"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>cart.php" title="Cart"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>view.php" title="View Order Status"><i class="fas fa-eye"></i></a>
                    </li>
                    <li>
                        <a href="feedback.php" title="Feedback"><i class="fas fa-comment-dots"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>about-us.php" title="About Us"><i class="fas fa-info-circle"></i></a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
</body>
</html>

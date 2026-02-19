<?php include('partials/menu.php'); ?> 

<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['Register'])) {
            echo $_SESSION['Register'];
            unset($_SESSION['Register']);
        }
        ?>
        <br><br>
        
        <div class="col-4 text-center">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
            <i class="fas fa-th-list fa-3x" title="Categories"></i>
            <h1><?php echo $count; ?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
            $sql2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <i class="fas fa-utensils fa-3x" title="Foods"></i>
            <h1><?php echo $count2; ?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
            $sql3 = "SELECT * FROM tbl_order";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <i class="fas fa-receipt fa-3x" title="Total Orders"></i>
            <h1><?php echo $count3; ?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue = $row4['Total'];
            ?>
            <i class="fas fa-coins fa-3x" title="Revenue Generated"></i>
            <h1>Ksh <?php echo $total_revenue; ?></h1>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php'); ?> 

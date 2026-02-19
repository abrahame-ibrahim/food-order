<?php 
include('../config/constants.php');
include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Fusion Website </title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php" title="Home"><i class="fas fa-home"></i></a></li>
            <li><a href="manage.admin.php" title="Admin"><i class="fas fa-user-shield"></i></a></li>
            <li><a href="manage-category.php" title="Category"><i class="fas fa-th-list"></i></a></li>
            <li><a href="manage-food.php" title="Food"><i class="fas fa-hamburger"></i></a></li>
            <li><a href="manage-order.php" title="Order"><i class="fas fa-receipt"></i></a></li>
            <li><a href="view-feedback.php" title="View Feedback"><i class="fas fa-comments"></i></a></li>
            <li><a href="insights.php" title="Analytics"><i class="fas fa-chart-line"></i></a></li>
            <li><a href="logout.php" title="Logout"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>    
</div>

</body>
</html>

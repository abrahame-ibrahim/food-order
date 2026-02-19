<?php
include('partials/menu.php'); 
// Include database connection
include('../config/constants.php');

// Query total orders
$order_result = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM tbl_order");
$order_data = mysqli_fetch_assoc($order_result);

// Query total sales
$sales_result = mysqli_query($conn, "SELECT SUM(total) AS total_sales FROM tbl_order WHERE status = 'Delivered'");
$sales_data = mysqli_fetch_assoc($sales_result);

// Most ordered food
$top_food_result = mysqli_query($conn, "
    SELECT food, COUNT(*) AS count 
    FROM tbl_order 
    GROUP BY food 
    ORDER BY count DESC 
    LIMIT 1");
$top_food_data = mysqli_fetch_assoc($top_food_result);

// Total feedback entries
$feedback_result = mysqli_query($conn, "SELECT COUNT(*) AS total_feedback FROM customer_feedback");
$feedback_data = mysqli_fetch_assoc($feedback_result);

// Average rating
$rating_result = mysqli_query($conn, "SELECT AVG(rating) AS average_rating FROM customer_feedback");
$rating_data = mysqli_fetch_assoc($rating_result);

// Total customers (assuming unique names represent customers)
$customer_result = mysqli_query($conn, "SELECT COUNT(DISTINCT customer_name) AS total_customers FROM tbl_order");
$customer_data = mysqli_fetch_assoc($customer_result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>System Insights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .insight-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 2em;
            margin: 10px 0;
            color: #007bff;
        }

        .card p {
            font-size: 1em;
            color: #555;
        }
    </style>
</head>
<body>

    <h2>📊 Food Ordering System Insights</h2>

    <div class="insight-container">
        <div class="card">
            <p>Total Orders</p>
            <h3><?= $order_data['total_orders'] ?></h3>
        </div>

        <div class="card">
            <p>Total Sales</p>
            <h3>KES <?= number_format($sales_data['total_sales'], 2) ?></h3>
        </div>

        <div class="card">
            <p>Most Ordered Food</p>
            <h3><?= htmlspecialchars($top_food_data['food'] ?? 'N/A') ?></h3>
        </div>

        <div class="card">
            <p>Total Feedbacks</p>
            <h3><?= $feedback_data['total_feedback'] ?></h3>
        </div>

        <div class="card">
            <p>Average Rating</p>
            <h3><?= number_format($rating_data['average_rating'], 1) ?> ⭐</h3>
        </div>

        <div class="card">
            <p>Total Customers</p>
            <h3><?= $customer_data['total_customers'] ?></h3>
        </div>
    </div>

</body>
</html>
<?php include('partials/footer.php'); ?>
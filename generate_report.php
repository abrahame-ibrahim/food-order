<?php  
// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'food-fusion'); // Ensure correct database name

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch order data from tbl_order
$sql = "
    SELECT o.id AS order_id, o.food, o.price, o.qty, o.total, o.order_date, o.status, 
           o.customer_name, o.customer_contact, o.customer_email, o.customer_address
    FROM tbl_order o 
    ORDER BY o.order_date DESC
";
$result = $conn->query($sql);

// Fetch total sales from tbl_order
$totalSalesSql = "SELECT SUM(total) AS total_sales FROM tbl_order";
$totalSalesResult = $conn->query($totalSalesSql);
$totalSales = $totalSalesResult->fetch_assoc()['total_sales'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        /* Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7fa;
            color: #333;
        }

        .report-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2980b9;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            color: #27ae60;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #7f8c8d;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="report-container">
    <h2>Order Report</h2>

    <!-- Total Sales -->
    <p class="total"><strong>Total Sales: </strong> <?= number_format($totalSales, 2) ?></p>

    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['order_id']) ?></td>
                        <td><?= htmlspecialchars($row['food']) ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= htmlspecialchars($row['qty']) ?></td>
                        <td><?= number_format($row['total'], 2) ?></td>
                        <td><?= htmlspecialchars($row['order_date']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['customer_contact']) ?></td>
                        <td><?= htmlspecialchars($row['customer_email']) ?></td>
                        <td><?= htmlspecialchars($row['customer_address']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Download PDF Button -->
    <form action="download-pdf.php" method="post">
        <button type="submit">Download PDF</button>
    </form>

    <div class="footer">
        <p>Report generated on <?= date('Y-m-d H:i:s') ?></p>
    </div>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

<?php
include('partials/menu.php'); // Include the menu/navigation
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br><br>

        <?php
        // Display session messages if any
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <!-- Search Form -->
        <form method="post">
            <input 
                type="text" 
                name="search" 
                placeholder="Search Orders by Food or Customer Name..." 
                class="input-responsive"
            >
            <button type="submit" name="submit" class="btn-primary">Search</button>
        </form>
        <br><br>

        <?php
        // CSV Export Functionality
        if (isset($_POST['export_csv'])) {
            // Clean the output buffer to prevent any HTML content in the CSV file
            ob_clean();

            // SQL query to fetch orders
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                // Set headers for CSV export
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename="orders.csv"');

                // Open output stream
                $output = fopen('php://output', 'w');

                // CSV Column Headers
                $headers = ['S.N.', 'Food', 'Price', 'Qty', 'Total', 'Order Date', 'Status', 'Customer Name', 'Contact', 'Email', 'Address'];
                fputcsv($output, $headers);

                // Write each order row to the CSV file
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $data = [
                        $sn++,
                        $row['food'],
                        $row['price'],
                        $row['qty'],
                        $row['total'],
                        $row['order_date'],
                        $row['status'],
                        $row['customer_name'],
                        $row['customer_contact'],
                        $row['customer_email'],
                        $row['customer_address']
                    ];
                    fputcsv($output, $data);
                }

                fclose($output);
                exit(); // End script execution after outputting the CSV
            } else {
                echo "<script>alert('No orders available to export.');</script>";
            }
        }
        ?>

        <!-- Button to Download CSV -->
        <form method="post">
            <button type="submit" name="export_csv" class="btn-primary">Download Report</button>
        </form>
        <br><br>

        <!-- Orders Table -->
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to fetch orders
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            if (isset($_POST['submit'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                $sql = "SELECT * FROM tbl_order 
                        WHERE food LIKE '%$search%' OR customer_name LIKE '%$search%' 
                        ORDER BY id DESC";
            }

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                // Loop through the orders and display them
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php
                            if ($status == "ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "on delivery") {
                                echo "<label style='color:orange;'>$status</label>";
                            } elseif ($status == "delivered") {
                                echo "<label style='color:green;'>$status</label>";
                            } elseif ($status == "cancelled") {
                                echo "<label style='color:red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='12' class='error'>No orders found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php
include('partials/footer.php'); // Include the footer
?>

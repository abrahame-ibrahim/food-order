<?php
include('config/constants.php');
$order_id = $_GET['order_id'];
$status = $_POST['status'];

$sql = "UPDATE tbl_orders SET status = '$status' WHERE id = '$order_id'";
$res = mysqli_query($conn, $sql);

if ($res) {
    $_SESSION['update'] = "Order status updated successfully!";
} else {
    $_SESSION['update_error'] = "Failed to update order status.";
}

header('location: manage-orders.php');
?>

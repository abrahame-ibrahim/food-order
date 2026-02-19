<?php include('partials/menu.php'); ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendOrderDeliveredEmail($email, $name, $orderId) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abrahameibrahim@gmail.com';
        $mail->Password = 'pmzfkoiqncbveutb'; // App-specific password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPDebug = 0; // Turn off debug output for production

        $mail->setFrom('abrahameibrahim@gmail.com', 'Food Ordering System');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Your Order Has Arrived!';
        $mail->Body = "Dear $name,<br><br>Your order <strong>#$orderId</strong> has been delivered successfully. Enjoy your meal!<br><br>Thank you for ordering with us.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log ("Mailer Error: " . $mail->ErrorInfo); // Log it, don't echo
        return false;
    }
}



function sendOrderDeliveredSMS($phoneNumber, $name, $orderId) {
    $apiKey = 'your_api_key'; // Replace with your actual API key
    $username = 'your_username'; // Replace with your Africa's Talking username
    $message = "Hi $name, your order #$orderId has arrived. Thank you for using our service.";

    $postData = array(
        'username' => $username,
        'to' => $phoneNumber,
        'message' => $message
    );

    $url = 'https://api.africastalking.com/version1/messaging';
    $headers = array(
        'apiKey: ' . $apiKey,
        'Content-Type: application/x-www-form-urlencoded'
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit();
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit();
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status"> 
                            <option value="ordered" <?php if($status == "ordered") { echo "selected"; } ?>>ordered</option>
                            <option value="on delivery" <?php if($status == "on delivery") { echo "selected"; } ?>>on delivery</option>
                            <option value="delivered" <?php if($status == "delivered") { echo "selected"; } ?>>delivered</option>
                            <option value="cancelled" <?php if($status == "cancelled") { echo "selected"; } ?>>cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;

            $new_status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            $sql2 = "UPDATE tbl_order SET 
                qty = $qty,
                total = $total,
                status = '$new_status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                // Notify when status is "delivered"
                if ($new_status == 'delivered') {
                    $sql = "SELECT * FROM tbl_order WHERE id = $id";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);

                    $email = $row['customer_email'];
                    $name = $row['customer_name'];
                    $phone = $row['customer_contact'];

                    sendOrderDeliveredEmail($email, $name, $id);
                    sendOrderDeliveredSMS($phone, $name, $id);
                }

                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

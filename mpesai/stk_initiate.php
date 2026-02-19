<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "food-fusion";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // M-Pesa credentials
    $consumerKey = 'nk16Y74eSbTaGQgc9WF8j6FigApqOMWr';
    $consumerSecret = '40fD1vRXCq90XFaU';

    $BusinessShortCode = '174379';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    // User inputs
    $PartyA = $_POST['phone'];
    $AccountReference = 'food fusion';
    $TransactionDesc = 'Test Payment';
    $Amount = $_POST['amount'];

    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $CallBackURL = 'https://morning-basin-87523.herokuapp.com/callback_url.php';

    // Generate access token
    $headers = ['Content-Type:application/json; charset=utf8'];
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);

    // Initiate STK Push
    $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);

    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $CallBackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    $response = json_decode($curl_response, true);

    // Default payment status
    $status = 'Not Paid';
    if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
        $status = 'Pending';
    }

    // Insert into database
    $sql = "INSERT INTO payments (phone, amount, status) VALUES ('$PartyA', '$Amount', '$status')";
    $conn->query($sql);

    // Simulated callback (for demo purposes)
    if ($status === 'Pending') {
        $completed = true; // Simulate success
        if ($completed) {
            $update_sql = "UPDATE payments SET status='Paid' WHERE phone='$PartyA' AND status='Pending'";
            $conn->query($update_sql);
        }
    }

    $conn->close();
}
?>

<!-- HTML with Background Design -->
<!DOCTYPE html>
<html>
<head>
    <title>MPESA Payment</title>
    <style>
        body {
            background-color: #ffe6f0; /* light pink background */
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            width: 50%;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px #ccc;
        }
        h2 {
            text-align: center;
            color: #d63384;
        }
        .status {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>M-PESA Payment Status</h2>
        <?php if (isset($status)): ?>
            <div class="status">
                <?php
                    echo "<strong>Status:</strong> $status<br>";
                    if ($status == 'Pending') {
                        echo "Check your phone to complete the payment.";
                    } elseif ($status == 'Paid') {
                        echo "Payment was completed successfully.";
                    } else {
                        echo "Payment failed or was not initiated.";
                    }
                ?>
            </div>
        <?php else: ?>
            <div class="status">
                <strong>No payment attempt made.</strong>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

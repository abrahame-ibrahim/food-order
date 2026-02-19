<?php include('partials-front/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Food Ordering System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #fff0e6, #ffe6cc); /* soft peach gradient */
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: #fffdfc;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            text-align: center;
        }
        h1 {
            background-color:rgb(0, 153, 255);
            color: white;
            padding: 20px;
            border-radius: 10px;
            font-size: 32px;
        }
        p {
            font-size: 18px;
            line-height: 1.8;
            margin: 15px 0;
        }
        ol {
            text-align: left;
            padding-left: 30px;
        }
        ol li {
            background:rgb(51, 163, 255);
            color: white;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        ol li:hover {
            background:rgb(0, 73, 230);
        }
        strong {
            color:rgb(0, 81, 230);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><b>About Us</b></h1>
        <p>Welcome to <strong>Food Fusion</strong>, your ultimate destination for delicious food delivered straight to your door!</p>
        <p>We are committed to making your food ordering experience seamless and convenient by connecting you with top restaurants and eateries in your area.</p>
        <p><b>Our platform ensures:</b></p>
        <ol>
            <li>Easy and quick online ordering</li>
            <li>Wide variety of restaurants and cuisines</li>
            <li>Fast and reliable delivery</li>
            <li>Secure payment options</li>
        </ol>
        <p>Join us today and enjoy hassle-free food ordering!</p>
        <p><strong>Contact Us:</strong></p>
        <p><b>Email: support@foodfusion.com</b></p>
        <p><b>Phone: +254728251935</b></p>
    </div>
</body>
</html>
<?php include('partials-front/footer.php'); ?>

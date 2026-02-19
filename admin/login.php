<?php include('../config/constants.php'); ?>
<html>
<head>
    <title>Login - Food Order System</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f8f8;
        }

        .login {
            border: 1px solid grey;
            width: 30%;
            margin: 8% auto;
            padding: 2%;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1.text-center {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .login input[type="text"], 
        .login input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .login input[type="submit"] {
            background-color: #1e90ff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 95%;
            margin: 0 auto;
            display: block;
        }

        .login input[type="submit"]:hover {
            background-color: #3742fa;
        }

        .login .text-center {
            font-size: 14px;
            color: #666;
        }

        .success {
            color: #2ed573;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .error {
            color: #ff4757;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .login p.text-center {
            margin-top: 20px;
            font-size: 12px;
        }

        /* Responsive for smaller screens */
        @media (max-width: 768px) {
            .login {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login">
        <h1 class="text-center"> Login</h1>
        <br><br>

        <?php
        if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION ['login']);
        }
        if(isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter username" required><br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        

<div class="text-center">
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</div>

</body>

        <p class="text-center">Created By - Ibrahim</p>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1) {
        $_SESSION['login'] = "<div class='success'>Login successful.</div>";
        $_SESSION['user'] = $username;
        header("location:".SITEURL.'admin/');
    } else {
        $_SESSION['login'] = "<div class='error'>Username or password did not match.</div>";
        header("location:".SITEURL.'admin/login.php');
    }
}
?>

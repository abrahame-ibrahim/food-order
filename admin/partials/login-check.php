<?php
if(!isset($_SESSION['user']))
{
    $_SESSION['no-login-message'] = "<div class='error'> please login to access admin pane.</div>";
    header("location:".SITEURL.'admin/login.php');
}

?>
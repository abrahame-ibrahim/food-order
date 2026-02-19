<?php include('partials/menu.php'); ?>
<div class = "main-content">
    <div class = "wrapper">
        <h1>change password</h1>
        <br><br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
    <table class="tbl-30">
<tr>
    <td>current password:</td>
    <td><input type="password" name="current_password" placeholder="current password "><td>
</tr>
<tr>
    <td>New Password:</td>
    <td><input type="password" name="new_password" placeholder="new password"><td>
</tr>
<tr>
    <td>Confirm Password:</td>
    <td><input type="password" name="Confirm_password" placeholder="confirm password "><td>
</tr>
<tr>
    <td colspan="2">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="submit" name="submit" value="change password" class = "btn-secondary">
    <td>
</tr>

    </table>

</div>
</div>

<?php
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    $sql="SELECT* FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res=mysqli_query($conn, $sql);
    if ($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //echo"user found";
            if($new_password==$confirm_password)
            {
               // echo "password match"
               $sql2="UPDATE tbl_admin SET  
               password ='$new_password' 
               WHERE id=$id
               ";
               $res2=mysqli_query($conn, $sql2);
               if ($res2==true)
               {
                $_SESSION['change-psd']="<div class ='success'>password changed successfully .</div>";
                header("location:".SITEURL.'admin/manage.admin.php');
               }
               else
               {
                $_SESSION['change-psd']="<div class ='error'>failed to chage password .</div>";
                header("location:".SITEURL.'admin/manage.admin.php');
               }
               

            }
            else
            {
                $_SESSION['psd-not-match']="<div class ='error'>password did not match .</div>";
                header("location:".SITEURL.'admin/manage.admin.php');
            }

        }
        else
        {
            $_SESSION['user-not-found']="<div class ='error'>user not found.</div>";
            header("location:".SITEURL.'admin/manage.admin.php');

        }
    }
    
}
?>
<?php include('partials/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="jquery.3.3.1.js"></script>
<?php
require_once 'Admin/header.php';

$error = $user = $pass = "";
if (isset($_POST['user']))
{
$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['pass']);
$result = queryMySQL("SELECT user,pass, type FROM users
WHERE user='$user' AND pass='$pass' AND type=1");


if ($result->num_rows == 0)
{
$error = "<script>
$(function() {

     Swal.fire(
        'Invalid Username/Password!',
'',
'error'
).then(function() {
window.location = 'index.php';
     });
     });
    </script>";
}
else
{
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
die(" <script>
      $(function() {
      
           Swal.fire(
            'Log In successful',
      '',
      'success'
      ).then(function() {
    window.location = 'admin/admin_home.php';
           });
           });
          </script>");
}
// }
}
?>

<html>
<head>
    <title> Attendance System </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='css/loginStylesheet.css'>   
</head>
    <body>
    <div class='login-box'><?php $error ?>

    

    <img src='photos\UIC Logo.png' class='avatar'>
            <form action='index.php' method='post'>
                <?php echo $error;?>

            <p>Username</p>
            <input type='text' name='user' placeholder='Enter Username' value='<?php $user?>' required>
            <p>Password</p>
            <input type='password' name='pass' placeholder='Enter Password' value='<?php $pass?>' required>
            <input type='submit' name='submit' value='Login'>
            </form>

            
        </div> 
    </body>
</html>



<?php 
$result2 = queryMySQL("SELECT user,pass, type FROM users WHERE user='$user' AND pass='$pass' AND type=2");
if ($result2->num_rows == 0)
{
$error = "<span class='error'>Username/Password
invalid</span>";
}
else
{
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
die("<script>
      $(function() {
      
           Swal.fire(
            'Log In successful',
            '',
            'success'
      ).then(function() {
    window.location = 'home.php';
           });
           });
          </script>");
}


?>




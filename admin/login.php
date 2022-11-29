<!-- Gọi file adminlogin -->

<?php
include '../classes/adminlogin.php';
?>

<?php
$class = new adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);

    $login_check = $class->login_admin($adminUser,$adminPass);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- <div id="user_login" class="box-content">
        <h1>Đăng nhập tài khoản</h1>
        <form action="login.php" method="post">
        <span>
            <?php
            if(isset($login_check)){
                echo $login_check;
            }
            ?>
        </span>
            <label>Username</label></br>
            <input type="text" name="adminUser" value="" /><br />
            <label>Password</label></br>
            <input type="password" name="adminPass" value="" /></br>
            <br>
            <input type="submit" value="Đăng nhập" />
        </form>
    </div> -->

    <div class="login-box">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <span>
                <?php
                if(isset($login_check)){
                    echo $login_check;
                }
                ?>
            </span>
            <div class="user-box">
            <input type="text" name="adminUser">
            <label>Username</label>
            </div>
            <div class="user-box">
            <input type="password" name="adminPass">
            <label>Password</label>
            </div>
            <button class="submit" type="submit" style="background-color:rgba(0, 0, 0, 0); border:none;">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Login
            </button>   
        </form>
    </div>
</body>

</html>
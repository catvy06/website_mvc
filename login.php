<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="./from/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    <link rel="stylesheet" href="./js/scripts.js">
</head>

<?php
include './inc/header-index.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check) {
   header('Location:cart.php');
} 
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insertCustomers = $cs->insert_customers($_POST);
}

?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

    $login_Customers = $cs->login_customers($_POST);
}
?>
<div class="login-content">
    <div id="register-left">
        <div class="register" id="">
        <h1>ĐĂNG KÝ</h1>
        <?php
        if (isset($insertCustomers)) {
            echo $insertCustomers;
        }
        ?>
        <form action="" method="POST">
            <table class="register-table">
                <thead>
                    <tr class="register-row">
                        <!-- <th class="register-col-1">Nhập tên : </th> -->
                        <th class="register-col-2"><input type="text" name="name" placeholder="Enter FullName..." class="input-register"></th>
                    </tr>

                    <tr class="register-row">
                        <!-- <th class="register-col-1">Nhập email : </th> -->
                        <th class="register-col-2"><input type="text" name="email" placeholder="Enter Email..." class="input-register"></th>
                    </tr>
                    <tr class="register-row">
                        <!-- <th class="register-col-1">Nhập địa chỉ : </th> -->
                        <th class="register-col-2"><input type="text" name="address" placeholder="Enter Address..." class="input-register"></th>
                    </tr>
                    <tr class="register-row">
                        <!-- <th class="register-col-1">Nhập số điện thoại : </th> -->
                        <th class="register-col-2"><input type="text" name="phone" placeholder="Enter Phone..." class="input-register"></th>
                    </tr>
                    <tr class="register-row">
                        <!-- <th class="register-col-1">Nhập mật khẩu : </th> -->
                        <th class="register-col-2"><input type="password" name="password" placeholder="Enter Password..." class="input-register"></th>
                    </tr>
                    <tr class="register-row">
                        <th colspan="2"><input type="submit" name="submit" value="Register" class="btn-register"></th>
                    </tr>
                </thead>
            </table>
        </form>
        </div>
    </div>
    <div id="register-right">
        <div class="register" id="">
            <h1>ĐĂNG NHẬP</h1>
            <form action="" method="POST">
                <?php
                if (isset($login_Customers)) {
                    echo $login_Customers;
                }
                ?>
                <table class="register-table">
                    <thead>
                        <tr class="register-row">
                        <!-- class="field" class="grey"-->
                            <!-- <th class="register-col-1">Nhập email : </th> -->
                            <th class="register-col-2"><input type="text" name="email" placeholder="Enter Email...." class="input-register"></th>
                        </tr>
                        <tr class="register-row">
                            <!-- <th class="register-col-1">Nhập password : </th> -->
                            <th class="register-col-2"><input type="password" name="password" placeholder="Enter Password...." class="input-register"></th>
                        </tr>
                        <tr class="register-row">
                            <th colspan="2">
                                <div class="buttons">
                                    <div><input type="submit" name="login" value="Login" class="btn-register"></div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include './inc/footer-index.php';
?>
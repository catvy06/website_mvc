<?php
include '../lib/session.php';
Session::checkSession(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    <link rel="stylesheet" href="../from/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    
</head>
    <div id="admin-heading-panel">
        <div class="container">
            <div class="left-panel">
                <img class="logo" src="./images/logo.png">                
            </div>
            <div class="right-panel">
                <!-- <img height="24" src="../images/logout.png" /> -->
                <h2>Admin </h2>
                <h3> <?php echo Session::get('adminName');?></h3>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                    Session::destroy();
                }
                ?>
                <div class="logout">
                    <i class="fas fa-user"></i>
                    <a href="?action=logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    
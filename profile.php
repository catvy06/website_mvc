<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="./from/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/style1.css">
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
if ($login_check == false) {
    header('Location:login.php');
}
?>
<!-- <div class="login">
    <h1>Thông tin khách hàng </h1>
    <?php
    if (isset($insertCustomers)) {
        echo $insertCustomers;
    }
    ?>
    <form action="" method="POST">
        <table class="profile">
            <?php
				$id = Session::get('customer_id');
				$get_customers = $cs->show_customers($id);
				if($get_customers){
					while($result = $get_customers->fetch_assoc()){

			?>
            <thead>
                <tr class="profile-row-1">
                    <td class="profile-col-1">Name:</td>
                    <td class="profile-col-2"><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td class="profile-col-1">Email:</td>
                    <td class="profile-col-2"><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td class="profile-col-1">Address:</td>
                    <td class="profile-col-2"><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td class="profile-col-1">Phone:</td>
                    <td class="profile-col-2"><?php echo $result['phone'] ?></td>
                </tr>
            </thead>
            <?php
					}
				}
				?>
        </table>
    </form>
</div> -->
<div class="main">
    <div class="info">
        <h1>Thông tin khách hàng </h1>
        <?php
        if (isset($insertCustomers)) {
            echo $insertCustomers;
        }
        ?>
        <form action="" method="POST" class="profile-form">
                <?php
                    $id = Session::get('customer_id');
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                ?>
                    <p class="profile">
                        <span>Name: </span>
                        <?php echo $result['name'] ?>
                    </p>
                    <p class="profile">
                        <span>Email: </span>
                        <?php echo $result['email'] ?>
                    </p>
                    <p class="profile">
                        <span>Address: </span>
                        <?php echo $result['address'] ?>
                    </p>
                    <p class="profile">
                        <span>Phone: </span>
                        <?php echo $result['phone'] ?>
                    </p>
                <?php
                        }
                    }
                ?>
                <button class="btn-orderdetail"><a href="orderdetails.php">Orderdetail</a></button>
        </form>
    </div>
</div>
<?php
include './inc/footer-index.php';
?>
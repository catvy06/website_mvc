<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
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
//  $s=0;
include './inc/header-index.php';
?>

<style type="text/css">
    h2.success_order {
        text-align: center;
        color: red;
    }

    p.success_note {
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Đặt hàng thành công</h2>
                <?php
                $customer_id = Session::get('customer_id');
                 $get_amount = $ct->getAmountPrice($customer_id);
                if ($get_amount) {
                    $amount = 0;
                    while ($result = $get_amount->fetch_assoc()) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
                ?>
                <?php
                
                if($amount<0){
                    ?>
                    <p class="success_note">Bạn chưa đặt hàng  </p>
                    
                     <?php
                }
                // }else{?>

                   <!-- <p class="success_note">  Tổng tiền đơn hàng bạn đã đặt mua: <?php  echo $amount;  ?> </p> -->
                 <?php ?>
                
                <p class="success_note">Chúng tôi sẽ liên hệ bạn sớm ,xem chi tiết đơn hàng của bạn tại đây <a href="orderdetails.php">Click Here</a></p>
            </div>

        </div>

    </div>
</form>


<?php
include './inc/footer-index.php';
?>
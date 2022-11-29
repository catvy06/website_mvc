    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OfflinePayment</title>
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

<?php
    if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
?>

<form action="">
    <div class="cart">
        <form action="">
            <?php
            if (isset($update_quantity_cart)) {
                echo $update_quantity_cart;
            }
            ?>
            <?php
            if (isset($delcart)) {
                echo $delcart;
            }
            ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>STD</th>
                        <th width="20%">Tên sản phẩm </th>
                        <th>Giá sản phẩm </th>
                        <th>Số lượng sản phẩm </th>
                        <th>Tổng giá sản phẩm </th>
                    </tr>
                </thead>
                <?php
                $id = Session::get('customer_id');
                $get_product_cart = $ct->get_product_cart();
                if ($get_product_cart) {
                    $subtotal = 0;
                    $qty = 0;
                    $i = 0;
                    while ($result = $get_product_cart->fetch_assoc()) {
                        $i++;
                ?>
                        <tbody>
                            <tr>
                                <th><?php echo $i ?></th>
                                <th><?php echo $result['productName'] ?></th>

                                <th><?php echo $result['price'] . ' ' . 'VND' ?></th>
                                <th>
                                    <?php echo $result['quantity'] ?>
                                </th>
                                <th><?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total . ' ' . 'VND';

                                    // if($result['productName']){
                                    //     $s++;
                                    // }
                                    ?></th>
                            </tr>

                        </tbody>
                <?php
                        $subtotal += $total;
                        // $qty = $s;
                        $qty = $qty + $result['quantity'];
                    }
                }
                ?>
                <?php
                $check_cart = $ct->check_cart();
                if ($check_cart) {
                ?>
                    <tr>
                        <th>
                            Tổng hóa đơn:
                        </th>
                        <th>
                            <?php
                            echo $subtotal . ' ' . 'VND';
                            Session::set('sum', $subtotal);
                            Session::set('qty', $qty);
                            ?>
                        </th>
                    </tr>
                <?php
                } else { ?>

                    <tr>
                        <th>
                            Tổng hóa đơn:
                        </th>
                        <th>
                            0 . Đ
                        </th>
                    </tr>
                <?php }
                ?>
            </table>
        </form>
    </div>
    <div class="payment">
        <h1><a class="ordernow" href="?orderid=order">Order Now</a></h1>
    </div>

</form>
<?php
include './inc/footer-index.php';
?>
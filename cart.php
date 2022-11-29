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
    <title>Cart</title>
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
include 'inc/header-index.php';
?>

<?php
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cart($cartid);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
    $cartId = $_GET['cartId'];
    $quantity = $_GET['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
    if ($quantity <= 0) {
        $delcart = $ct->del_product_cart($cartId);
    }
}
?>
<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>

<div class="cart" style=" margin: 50px 50px 50px 50px ">
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
                    <th width="20%">Product Name </th>
                    <th>Image </th>
                    <th>Price </th>
                    <th>Quantity </th>
                    <th>Total </th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php
            $get_product_cart = $ct->get_product_cart();
            if ($get_product_cart) {
                $subtotal = 0;
                $qty = 0;
                while ($result = $get_product_cart->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <th><?php echo $result['productName'] ?></th>
                    <th><img src="admin/uploads/<?php echo $result['image'] ?>" width="50" alt="" /></th>
                    <th><?php echo $result['price'] ?></th>
                    <th>
                        <form action="" method="GET">
                            <input type="hidden" name="cartId" value="<?php echo $result['cartid'] ?>" />
                            <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
                            <input type="submit" name="submit" value="Update" />
                        </form>
                    </th>
                    <th><?php
                            $total = $result['price'] * $result['quantity'];
                            echo $total;
                        ?>
                    </th>
                    <th><a href="?cartid=<?php echo $result['cartid'] ?>">Xóa</a></th>
                </tr>
            </tbody>
            <?php
                    $subtotal += $total;
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
                        echo $subtotal;
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
    <div class="payment-btn">
        <a href="payment.php"><button class="btn5-hover btn5">Payment</Button></a>
    </div>
</div>
<?php
include './inc/footer-index.php';
?>
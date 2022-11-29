<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<!-- <style>
    .clear-both {
        display: flex;
        justify-content: flex-end;
    }

    .phantrang {
        border: 1px solid #ccc;
        padding: 5px 9px;
        color: #000;
        border-radius: 10px;
    }

    .phantrang:hover {
        background: #11c516;
        border: 1px solid #ccc;
        padding: 5px 9px;
        color: #000;
        border-radius: 10px;
    }
</style> -->

<div id="wrapper-product" class="container">
    <h1 style="color: #3C4048">Products</h1>
    <div id="filter-box">
        <form id="product-search" action="search.php" method="post">
            <label>Search </label>
            <input type="text" placeholder="Search..." name="tukhoa">
            <input type="submit" name="search_product" value="Search">
        </form>
    </div>
    <div class="product-items">
        <?php
        $show_product = $product->show_productindex();
        if ($show_product) {
            while ($result = $show_product->fetch_assoc()) {

        ?>
                <div class="product-item">
                    <div class="product-img">
                        <a href="details.php?proid=<?php echo $result['productid'] ?>" title=""><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                    </div>
                    <strong><a class="product-name" href="details.php?proid=<?php echo $result['productid'] ?>" style=""><?php echo $result['productName'] ?></a></strong><br />
                    <!-- <label></label> --><span class="product-price"><?php echo $result['price'] . " đ" ?></span><br />
                    <p><?php echo $fm->textShorten($result['product_desc'], 20); ?></p>
                    <div class="buy-button">
                        <a href="details.php?proid=<?php echo $result['productid'] ?>">Details</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <div class="clear-both">
            <?php
            if (isset($_GET['trang'])) {
                $trang = $_GET['trang'];
            } else {
                $trang = 1;
            }
            $product_all = $product->get_all_product();
            $product_count = mysqli_num_rows($product_all);
            $product_button = ceil($product_count / 8);
            $i = 1;
            for ($i = 1; $i <= $product_button; $i++) {
            ?>
                <a class="phantrang" <?php if ($i == $trang) ?> href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a>
            <?php

            }
            ?>
        </div>
    </div>
</div>

<?php
include './inc/footer-index.php';
?>
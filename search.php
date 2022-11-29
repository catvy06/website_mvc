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
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tukhoa = $_POST['tukhoa'];
    $search_product = $product->search_product($tukhoa);
}
?>

<style>
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
</style>

<div id="wrapper-product" class="container">
    <h1>Danh sách sản phẩm</h1>
    <div id="filter-box">
        <form id="product-search" action="search.php" method="post">
            <label>Tìm kiếm sản phẩm</label>
            <input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
            <input type="submit" name="search_product" value="Tìm kiếm">
        </form>
    </div>
    <br>
    <div class="product-items">
        <?php

        if ($search_product) {
            while ($result = $search_product->fetch_assoc()) {
        ?>
                <div class="product-item">
                    <div class="product-img">
                        <a href="details.php?proid=<?php echo $result['productid'] ?>" title=""><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                    </div>
                    <strong><a href="details.php?proid=<?php echo $result['productid'] ?>"><?php echo $result['productName'] ?></a></strong><br />
                    <label>Giá: </label><span class="product-price"><?php echo $result['price'] . " .VND" ?></span><br />
                    <p><?php echo $fm->textShorten($result['product_desc'], 20); ?></p>
                    <div class="buy-button">
                        <a href="details.php?proid=<?php echo $result['productid'] ?>">Mua sản phẩm</a>
                    </div>
                </div>
        <?php
            }
        }else{
			echo 'Không có sản phẩm ';
        }
        ?>
        <div class="clear-both">
            
        </div>
    </div>
</div>

<?php
include './inc/footer-index.php';
?>
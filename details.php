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

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location ='404.php'</script>";
} else {
    $id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $quantity = $_POST['quantity'];
    $AddtoCart = $ct->add_to_cart($quantity, $id);
    
}
?>

<body>

        <?php

		$get_product_details = $product->get_details($id);
		if($get_product_details){
			while($result_details = $get_product_details->fetch_assoc()){
		

		?>
    <div class="container">
        <h2>Details</h2>
        <div id="product-detail">
            <div id="product-img">
                <img src="admin/uploads/<?php echo $result_details['image'] ?>" />
            </div>
            <div id="product-info">
                <h1><?php echo $result_details['productName'] ?></h1>
                <span class="product-price"><?php echo $result_details['price']." đ" ?></span><br />
                <p><?php echo $fm->textShorten($result_details['product_desc'], 20); ?></p><br>

                <form id="add-to-cart-form" action="" method="post">
                    <input type="number" value="1" name="quantity" min="1" /><br />
                    <input type="submit" name="submit" value="Add to Cart" />
                    
                </form>
                <?php
                    if(isset($AddtoCart)){
                        ?>
                        <a href="./index.php">Sản phẩm đã được thêm vào giỏ hàng</a> 
                        <?php
                    }
                    ?>
                <?php
            }
        }
                ?>

            </div>
            <div class="clear-both"></div>

        </div>
    </div>
</body>

</html>
<?php
include './inc/footer-index.php';
?>
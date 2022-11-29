<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrderDetails</title>
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
 	$login_check = Session::get('customer_login'); 
	if($login_check==false){
		header('Location:login.php');
	}
	
	
?>

<?php
	if(isset($_GET['confirmid'])){
        $id = $_GET['confirmid'];
        $shifted_confirm = $ct->shifted_confirm($id);
   }
?>


<form action="">
    <div class="cart" style=" margin: 50px 50px 50px 50px ">
        <form action="">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>STD</th>
                        <th >Tên sản phẩm </th>
                        <th width="20%">Ảnh sản phẩm  </th>
                        <th>Giá sản phẩm </th>
                        <th>Số lượng sản phẩm </th>
                        <!-- <th>Trạng thái </th> -->
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái </th>
                    </tr>
                </thead>

                <?php
							$customer_id = Session::get('customer_id');
                            // $id = Session::get('id');
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){
								$i = 0;
								$qty = 0;
								$total = 0;
								while($result = $get_cart_ordered->fetch_assoc()){
									$i++;
									$total = $result['price']*$result['quantity'];
							?>
                <tbody>
                    <tr>
                        <th><?php echo $i; ?></th>
                        <th><?php echo $result['productName'] ?></th>
                        <th><img src="admin/uploads/<?php echo $result['image'] ?>" width="50px" alt=""/></th>
                        <th><?php echo $result['price']." "."VNĐ" ?></th>
                        <th><?php echo $result['quantity'] ?></th>
                       
                        <th><?php echo $result['date_order'] ?></th>

                        <?php
                        if($result['status']=='0'){
                            ?>
                            <th>Chờ nhận hàng</th>

                            <?php
								
                            }else if($result['status']=='1'){
                            
                            ?>
                            <th><a href="?confirmid=<?php echo $result['id'] ?>">Đã Nhận</a></th>
                            <?php
                        }else if($result['status']=='2'){
                            ?>
                            <th><?php echo 'Giao thành công'; ?></th>
                            
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
                </tr>
						<?php
							
							}
						}
						?>
            </table>

        </form>
    </div>
</form>


<?php
include './inc/footer-index.php';
?>
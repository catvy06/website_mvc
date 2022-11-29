<?php
include 'inc/header.php';
include 'sidebar.php';
?>


<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');

?>


<?php
$ct = new cart();


if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $del_shifted = $ct->del_shifted($id, $time, $price);
    
}
?>

<div class="main-content">
    <h1>Liệt kê sản phẩm </h1>
    <div id="content-box">

        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($shifted)) {
                echo $shifted;
            }

            ?>
            <?php
            if (isset($del_shifted)) {
                echo $del_shifted;
            }

            ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>STĐ</th>
                        <th>Tên sản phẩm </th>
                        <th>Ảnh sản phẩm </th>
                        <th>Số lượng sản phẩm </th>
                        <th>Giá sản phẩm </th>
                        <th>Ngày đặc sản phẩm </th>
                        <th>Xét sản phảm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ct = new cart();
                    $fm = new Format();
                    $get_inbox_cart = $ct->get_inbox_cart();
                    if ($get_inbox_cart) {
                        $i = 0;
                        while ($result = $get_inbox_cart->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th><?php echo $i; ?></th>
                                <th><?php echo $result['productName'] ?></th>
                                <th><img src="./uploads/<?php echo $result['image'] ?>" width="50px" /></th>
                                <th><?php echo $result['quantity'] ?></th>
                                <th><?php echo $result['price'] . ' ' . 'VNĐ' ?></th>
                                <th><?php echo $result['date_order'] ?></th>

                                <?php
                                if ($result['status'] == '0') {
                                ?>
                                    <th><a href="test.php?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Đang chờ xử lý</a></th>
                                <?php
                            
                              } else if ($result['status'] == '1') {
                                ?>
                                <th>Đang giao</th>
                                
                                <?php
                                
                                } else if($result['status'] == '2') {
                                ?>
                                <th><a href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xóa</a></th>
                                    
                                <?php
                                }
                                ?>
                            </tr>



                </tbody>
        <?php
                        }
                    }
        ?>
            </table>
        </form>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/product.php';
include '../classes/category.php';
include_once '../helpers/format.php';
?>
<?php
$pd = new product();
$cat = new category();
$fm = new Format();
if (isset($_GET['productid'])) {
    $id = $_GET['productid'];
    $delpro = $pd->del_product($id);
}
?>
<div class="main-content">
    <h1>Liệt kê sản phẩm </h1>
    <div id="content-box">
        <?php
        if (isset($delpro)) {
            echo $delpro;
        }
        ?>
        <form action="productadd.php" method="post" enctype="multipart/form-data">
            
            <button class="btn-addpro"><a href="./productadd.php">Thêm sản phẩm</a></button>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm </th>
                        <th>Danh mục</th>
                        <th>Nội dung sản phẩm </th>
                        <th>Giá sản phẩm </th>
                        <th>Ảnh sản phẩm </th>
                        <th>Sửa sản phẩm </th>
                        <th>Xóa sản phẩm </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cat = new category();
                    $pd = new product();
                    $fm = new Format();
                    $pdlist = $pd->show_product();
                    if ($pdlist) {
                        $i = 0;
                        while ($result = $pdlist->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th><?php echo $result['productName'] ?></th>
                                <th><?php echo $result['catName'] ?></th>
                                <th><?php echo $fm->textShorten($result['product_desc'], 20); ?></td>
                                </th>
                                <th><?php echo $result['price'] ?></th>
                                <th><img src="uploads/<?php echo $result['image'] ?>" width="80"></th>
                                <th><a href="productedit.php?productid=<?php echo $result['productid'] ?>">Sửa</a></th>
                                <th><a href="?productid=<?php echo $result['productid'] ?>">Xóa</a></th>
                            </tr>

                    <?php
                        }
                    } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
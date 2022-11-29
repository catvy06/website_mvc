<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/product.php';
include '../classes/category.php'
?>
<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insertProduct = $pd->insert_product($_POST, $_FILES);
}

?>
<div class="main-content">
    <h1>Thêm sản phẩm</h1>
    <div id="content-box">
    <!-- trả thông báo thêm thành công -->
        <?php

        if (isset($insertProduct)) {
            echo $insertProduct;
        }

        ?>
        <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="styled-table">
                <tr>
                    <th>Tên sản phẩm :</th> 
                    <th><input type="text" name="productName" placeholder="Name sản phẩm"> </th>
                </tr>
                <tr>
                    <th>Danh mục :</th> 
                    <th>
                        <select name="catID">
                        <?php 
                            $cat = new category();
                            $get_category = $cat->show_category();
                            if($get_category){
                                while($result_category = $get_category->fetch_assoc()){
                        ?>
                                    <option value="<?php echo $result_category['catID']?>"><?php echo $result_category['catName'] ?></option>
                        <?php
                                }
                            }
                        ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>Nội dung :</th>
                    <th><textarea name="product_desc" id="" cols="30" rows="10"></textarea></th>
                </tr>
                <tr>
                    <th>Giá sản phẩm :</th>
                    <th><input type="text" name="price"></th>
                </tr>
                <tr>
                    <th>Thêm Ảnh :</th>
                    <th><input type="file" name="image"></th>
                </tr>
                <tr>
                    <th>Lưu sản phẩm</th>
                    <th><input type="submit" name="submit" value="Save"></th>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

include 'inc/footer.php';
?>
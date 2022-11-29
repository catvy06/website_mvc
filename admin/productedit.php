<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/product.php';
include '../classes/category.php';
?>
<?php
    $pd = new product();

    if(!isset($_GET['productid']) || $_GET['productid']==NULL){
       echo "<script>window.location ='productlist.php'</script>";
    }else{
         $id = $_GET['productid']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $updateProduct = $pd->update_product($_POST,$_FILES, $id);
        
    }
?>
<div class="main-content">
    <h1>Sửa sản phẩm</h1>
    <div id="content-box">
    <!-- trả thông báo thêm thành công -->
        <?php

        if (isset($updateProduct)) {
            echo $updateProduct;
        }

        ?>
        <?php
         $get_product_by_id = $pd->getproductbyid($id);
            if($get_product_by_id){
                while($result_product = $get_product_by_id->fetch_assoc()){
        ?> 
        <form action="" method="post" enctype="multipart/form-data">
            <table class="styled-table">
                <tr>
                    <th>Tên sản phẩm :</th>
                    <th><input type="text" name="productName" value="<?php echo  $result_product['productName']?>" /> </th> 
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
                    <th><textarea name="product_desc" ><?php echo $result_product['product_desc'] ?></textarea></th>
                </tr>
                <tr>
                    <th>Giá sản phẩm :</th>
                    <th><input type="text" value="<?php echo $result_product['price'] ?>" name="price"></th>
                </tr>
                <tr>
                    <th>Thêm Ảnh :</th>
                    <th><input type="file" name="image"></th>
                    <th><img src="uploads/<?php echo $result_product['image'] ?>" width="50" > <br></th>
                </tr>
                <tr>
                    <th>Lưu sản phẩm</th>
                    <th><input type="submit" name="submit" value="Update"></th>
                </tr>
            </table>
        </form>
        <?php
        }

    }
            ?>
    </div>
</div>

<?php

include 'inc/footer.php';
?>
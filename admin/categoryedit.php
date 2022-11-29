<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/category.php';
?>
<?php
    $pd = new category();

    if(!isset($_GET['catID']) || $_GET['catID']==NULL){
       echo "<script>window.location ='categorylist.php'</script>";
    }else{
        $id = $_GET['catID']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateCategory = $pd->update_category($_POST, $id);
    }
?>
<div class="main-content">
    <h1>Sửa danh mục</h1>
    <div id="content-box">
    <!-- trả thông báo thêm thành công -->
        <?php

        if (isset($updateCategory)) {
            echo $updateCategory;
        }

        ?>
        <?php
         $get_category_by_id = $pd->getcatbyid($id);
            if($get_category_by_id){
                while($result_category = $get_category_by_id->fetch_assoc()){
        ?> 
        <form action="" method="post" enctype="multipart/form-data">
            <table class="styled-table">
                <tr>
                    <th>Tên danh mục :</th>
                    <th><input type="text" name="catName" value="<?php echo  $result_category['catName']?>"/></th> 
                </tr>
                <tr>
                    <th>Lưu danh mục</th>
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
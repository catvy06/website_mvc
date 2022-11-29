<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/category.php';
?>
<?php
$pd = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insertProduct = $pd->insert_category($_POST);
}
?>
<div class="main-content">
    <h1>Thêm danh mục</h1>
    <div id="content-box">
    <!-- trả thông báo thêm thành công -->
        <?php
        if (isset($insertCategory)) {
            echo $insertCategory;
        }

        ?>
        <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="styled-table">
                <tr>
                    <th>Tên sản phẩm :</th> 
                    <th><input type="text" name="catName" placeholder="Name sản phẩm"> </th>
                </tr>
                <tr>
                    <th>Lưu danh mục</th>
                    <th><input type="submit" name="submit" value="Save"></th>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
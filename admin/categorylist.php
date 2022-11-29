<?php
include 'inc/header.php';
include 'sidebar.php';
include '../classes/category.php';
include_once '../helpers/format.php';
?>
<?php
$pd = new category();
$fm = new Format();
if (isset($_GET['catID'])) {
    $id = $_GET['catID'];
    // $delpro = $pd->del_product($id);
}
?>
<div class="main-content">
    <h1>Liệt kê danh mục </h1>
    <div id="content-box">
        <?php
        // if (isset($delpro)) {
        //     echo $delpro;
        // }
        ?>
        <form action="categoryadd.php" method="post" enctype="multipart/form-data">
            
            <button class="btn-addpro"><a href="./categoryadd.php">Thêm danh mục</a></button>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Tên danh mục </th>
                        <th>Sửa sản phẩm </th>
                        <th>Xóa sản phẩm </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $pd = new category();
                    $fm = new Format();
                    $pdlist = $pd->show_category();
                    if ($pdlist) {
                        $i = 0;
                        while ($result = $pdlist->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th><?php echo $result['catName'] ?></th>
                                </th>
                                <th><a href="categoryedit.php?catID=<?php echo $result['catID'] ?>">Sửa</a></th>
                                <th><a href="?catid=<?php echo $result['catID'] ?>">Xóa</a></th>
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
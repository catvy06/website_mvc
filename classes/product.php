<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php

class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    // Thêm sản phẩm 
    public function insert_product($data, $files)
    {


        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['catID']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;



        if ($productName == "" || $category == "" || $product_desc == "" || $price == "" || $file_name == "") {
            $alert = "Bạn không được để trống các trường";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product (productName, product_desc, price, image, catID)
             VALUES ('$productName', '$product_desc', '$price', '$unique_image', '$category')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "Thêm sản phẩm thành công";
                return $alert;
            } else {
                $alert = "Thêm thất bại";
                return $alert;
            }
        }
    }


    //Hiển thị sản phẩm 
    public function show_product()
    {
        $query = 
			"SELECT tbl_product.*, tbl_category.catName
			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID
			 order by tbl_product.productId desc ";
        // $query = "SELECT * FROM tbl_product order by productid desc";
        $result = $this->db->select($query);
        return $result;
    }

    //sửa sản phẩm 
    public function update_product($data, $files, $id)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['catID']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $category == "" || $product_desc == "" || $price == "") {
            $alert = "Bạn không được để trống các trường";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //Nếu người dùng chọn ảnh
                if ($file_size > 1000000000) {
                    $alert = "Bạn phải chọn ảnh nhỏ hơn 2MB!";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-" . implode(', ', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
					productName = '$productName',
					product_desc = '$product_desc',
					price = '$price', 
                    catID = '$category',
					image = '$unique_image'
					WHERE productid = '$id'";
            } else {
                //Nếu người dùng không chọn ảnh
                $query = "UPDATE tbl_product SET
					productName = '$productName',
                    catID = '$category',
					product_desc = '$product_desc',
					price = '$price'
					WHERE productid = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "Đã cập nhật sản phẩm thành công";
                return $alert;
            } else {
                $alert = "Sản phẩm được cập nhật không thành công";
                return $alert;
            }
        }
    }
    //lấy id sản phẩm 
    public function getproductbyid($id)
    {
        $query = "SELECT * FROM tbl_product where productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //xóa sản phẩm 
    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product where productid = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Sản phẩm đã được xóa thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Sản phẩm bị xóa không thành công</span>";
            return $alert;
        }
    }

    // hiển thị sản phẩm trang index;
    public function show_productindex()
    {
        $sp_tungtrang = 8;
        if (!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }

    //lấy ra sản phẩm dựa vào id sản phầm từ trang index
    public function get_details($id)
    {
        $query = "SELECT * FROM tbl_product where productid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    

    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }
    public function search_product($tukhoa)
	{
		$tukhoa = $this->fm->validation($tukhoa);
		$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
		$result = $this->db->select($query);
		return $result;
	}
}

?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class category{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($data){
        $catName = mysqli_real_escape_string($this->db->link, $data['catName']);
        if($catName == ""){
            return "Không được để trống";
        }else{
            $query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
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

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category order by catID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($data, $id)
    {
        $catName = mysqli_real_escape_string($this->db->link, $data['catName']);

        if ($catName == "") {
            $alert = "Bạn không được để trống các trường";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catID = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "Đã cập nhật danh mục thành công";
                return $alert;
            } else {
                $alert = "danh mục được cập nhật không thành công";
                return $alert;
            }
        }
    }
    //lấy id sản phẩm 
    public function getcatbyid($id)
    {
        $query = "SELECT * FROM tbl_category where catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //xóa sản phẩm 
    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category where catID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Danh mục đã được xóa thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Danh mục bị xóa không thành công</span>";
            return $alert;
        }
    }
}
?>
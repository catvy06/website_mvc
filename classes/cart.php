<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    // thêm sản phẩm vào giỏ hàng
    public function add_to_cart($quantity, $id)
    {

        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM tbl_product WHERE productid = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result["image"];
        $price = $result["price"];
        $productName = $result["productName"];

        $check_cart = "SELECT * FROM tbl_cart WHERE productid = '$id' ";
        $result_check_cart = $this->db->select($check_cart);
        if ($result_check_cart) {
            $msg = "Sản phẩm đã được thêm vào";
            return $msg;
        } else {
            $query_insert = "INSERT INTO tbl_cart(productid,quantity,image,price,productName)
                 VALUES('$id','$quantity','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                $msg = "<span class='error'>Thêm sản phẩm thành công</span>";
                return $msg;
            } else {
                header('Location:404.php');
            }
        }
    }

    // cập nhật giỏ hàng
    public function update_quantity_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE `tbl_cart` SET `quantity` = '$quantity' WHERE `tbl_cart`.`cartid` =$cartId;";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='error'>
            Số lượng sản phẩm được cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>
            Số lượng sản phẩm được cập nhật không thành công</span>";
            return $msg;
        }
    }
    // xóa hàng khỏi giỏ
    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartid = '$cartid'";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = "<span class='error'>Xóa sản phẩm không thành công</span>";
            return $msg;
        }
    }
    // hiển thị hàng lên giỏ
    public function get_product_cart()
    {
        // $sId = session_id();
        $query = "SELECT * FROM tbl_cart order by cartid desc";
        $result = $this->db->select($query);
        return $result;
    }
    // hiển thi số lượng đơn hàng
    public function check_cart()
    {
        // $sId = session_id();
        $query = "SELECT * FROM tbl_cart order by cartid ";
        $result = $this->db->select($query);
        return $result;
    }

    //xóa tất cả giỏ hàng dữ liệu
    public function del_all_data_cart()
    {
        // $sId = session_id();
        $query = "DELETE FROM tbl_cart  order by cartid";
        $result = $this->db->delete($query);
        return $result;
    }

    //chèn đơn hàng
    public function insertOrder($customer_id)
    {
        // $sId = session_id();
        $query = "SELECT * FROM tbl_cart order by cartid desc";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productid'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;
                $query_order = "INSERT INTO tbl_order(productid,productName,quantity,price,image,customer_id)
                 VALUES('$productid','$productName','$quantity','$price','$image','$customer_id')";
                $insert_order = $this->db->insert($query_order);
            }
        }
    }

    //nhận được Số tiền
    public function getAmountPrice($customer_id)
    {
        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    //nhận đặt hàng từ giỏ hàng
    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
    }

    //nhận hộp thư đến
    public function get_inbox_cart(){
        $query = "SELECT * FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }


    public function shifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET

                status = '1'

                WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span class='success'>Cập nhật đơn hàng thành công</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>
            Cập nhật đơn hàng không thành công</span>";
            return $msg;
        }
    }

    

    public function shifted_confirm($id){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_order SET

                status = '2'

                WHERE id = '$id' ";  
        $result = $this->db->update($query);
        return $result;
    }

    public function del_shifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order 
                WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span class='success'>
            Xóa đơn hàng thành công</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>
            Xóa đơn hàng không thành công</span>";
            return $msg;
        }
    }

    
}




?>
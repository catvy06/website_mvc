<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/** 
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
        public function insert_customers($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($name==""  || $email=="" || $address=="" || $phone =="" || $password ==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email đã tồn tại! Vui lòng nhập một email khác</span>";
					return $alert;
				}else{
					$query = "INSERT INTO tbl_customer(name,email,address,phone,password) VALUES('$name','$email','$address','$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Khách hàng được tạo thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Khách hàng được tạo không thành công</span>";
						return $alert;
					}
				}
			}
        }

        public function login_customers($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email=='' || $password==''){
				$alert = "<span class='error'>Mật khẩu và Email không được để trống</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
				$result_check = $this->db->select($check_login);
				if($result_check){

					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
					header("Location: home.php");
					// $alert = "<span class='success'>Đăng nhập thành công <a href='index.php'>Đến trang chủ</a></span>";
					// 	return $alert;
				}else{
					$alert = "<span class='error'>
                    Email hoặc mật khẩu không khớp</span>";
					return $alert;
				}
			}
		}
		public function show_customers($id){
			$query = "SELECT * FROM tbl_customer WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>
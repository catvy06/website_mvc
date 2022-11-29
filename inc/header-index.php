    <?php
    include 'lib/session.php';
    Session::init();
    ?>

    <?php
    include 'lib/database.php';
    include 'helpers/format.php';
    spl_autoload_register(function ($class) {
        include_once "classes/" . $class . ".php";
    });
    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cs = new customer();
    $product = new product();
    ?>
    
    <body>
        <header>
            <div class="logo">
                <h1 class="logo-text"> <span>SHOP</span> BURGER</h1>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="index.php">Shop</a></li>
                <?php
                    $login_check = Session::get('customer_login'); 
			        if($login_check==false){
				        echo '';
			        }else{
				        echo '<li><a href="profile.php">Khách hàng</a></li>';
			        }
                ?>
                <li>
                    <a href="./cart.php"><i class="fas fa-shopping-cart"></i> Cart
                        <?php
                        $check_cart = $ct->check_cart();
                        if ($check_cart) {
                            $qty = Session::get("qty");
                            echo $qty;
                        }
                        ?>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- <i class="fas fa-user"></i>Login -->
                        <i class="fas fa-bars"></i>
                        <!-- <i class="fa fa-chevron-down" style="font-size: .8em;"></i> -->
                    </a>
                    <?php 
				        if(isset($_GET['customer_id'])){
					        $customer_id = $_GET['customer_id'];
					        $delCart = $ct->del_all_data_cart();
					        Session::destroy();
				        }
			        ?>
                    <ul>
                        <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '<li><a href="login.php">Đăng nhập</a></li></ul>';
                            } else {
                                echo '<li><a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a></li></ul>';  
                            }
                        ?>                   
                </li>
            </ul>
        </header>


        
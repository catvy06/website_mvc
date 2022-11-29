<?php

?>


<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');

?>


<?php
$ct = new cart();
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted = $ct->shifted($id, $time, $price);
    header("Location: inbox.php");
}
?>
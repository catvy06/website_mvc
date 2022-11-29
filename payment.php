<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" href="./from/fontawesome-free-5.15.3-web/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<link rel="stylesheet" href="./css/style1.css">
	<link rel="stylesheet" href="./css/style3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
	<link rel="stylesheet" href="./js/scripts.js">
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<?php
include './inc/header-index.php';
?>


<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('Location:login.php');
}

?>

<?php
$money = round((Session::get('sum')) / 23080, 2);
?>

<script>
	paypal.Button.render({
		// Configure environment
		env: 'sandbox',
		client: {
			sandbox: 'Af16QpJVK0zxHgWvM2gtLWD3O_55FoXSsRfsl-PQ1dAUX_MmF3OJ6IcSeIWXTqpzP0scdd_A7sasJ4Kj',
			production: 'demo_production_client_id'
		},
		// Customize button (optional)

		locale: 'en_US',
		style: {
			size: 'small',
			color: 'gold',
			shape: 'pill',
		},

		// Enable Pay Now checkout flow (optional)
		commit: true,

		// Set up a payment
		payment: function(data, actions) {
			return actions.payment.create({
				transactions: [{
					amount: {
						total: '<?php echo $money; ?>',
						currency: 'USD'
					}
				}]
			});
		},
		// Execute the payment
		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function() {
				// Show a confirmation message to the buyer
				window.alert('Thank you for your purchase!');
			});
		}
	}, '#paypal-button');
</script>
<div class="main">
	<div class="content">
		<div class="wrapper_method">
			<h3 class="payment">Chọn phương thức thanh toán của bạn</h3>
			<a href="offlinepayment.php">Offline Payment</a>
			<a href="404.php">Online Payment</a>
			<div id="paypal-button"></div>
			<br>
			<a style="background:grey" href="cart.php">
				<< Quay về</a>
		</div>
	</div>
	<?php
	include './inc/footer-index.php';
	?>
</div>
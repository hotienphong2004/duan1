<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php require_once 'inc/nav.php'; ?>


<?php
if (!isset($_SESSION['EMAIL_USER_LOGIN'])) {
	header("location: index.php");
}
?>
<!-- Page info -->
<div class="page-top-info">
	<div class="container">
		<h4>Your cart</h4>
		<div class="site-pagination">
			<a href="">Home</a> /
			<a href="">Your cart</a>
		</div>
	</div>
</div>
<!-- Page info end -->


<!-- checkout section  -->
<section class="checkout-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 order-2 order-lg-1">
				<form class="checkout-form" action="order.php" method="post">
					<div class="cf-title">Billing Address</div>
					<div class="row">
						<div class="col-md-7">
							<p>*Billing Information</p>
						</div>
						<!-- <div class="col-md-5">
							<div class="cf-radio-btns address-rb">
								<div class="cfr-item">
									<input type="radio" name="pm" id="one">
									<label for="one">Use my regular address</label>
								</div>
								<div class="cfr-item">
									<input type="radio" name="pm" id="two">
									<label for="two">Use a different address</label>
								</div>
							</div>
						</div> -->
					</div>




					<div class="row address-inputs">
						<div class="col-md-12">
							<input type="text" placeholder="Name" name="name">
							<input type="text" placeholder="Address" name="address">
							<!-- <input type="text" placeholder="Address line 2"> -->
							<input type="text" placeholder="Country" name="country">
						</div>
						<div class="col-md-6">
							<input type="text" placeholder="Zip code" name="zipcode">
						</div>
						<div class="col-md-6">
							<input type="text" placeholder="Phone no." name="phone">
						</div>
					</div>
					<div class="cf-title">Delievery Info</div>
					<div class="row shipping-btns">
						<div class="col-6">
							<h4>Standard</h4>
						</div>
						<div class="col-6">
							<div class="cf-radio-btns">
								<div class="cfr-item">
									<input checked type="radio" value="free" name="fee_shipping" id="ship-1">
									<label for="ship-1">Free</label>
								</div>
							</div>
						</div>
						<!-- <div class="col-6">
							<h4>Next day delievery </h4>
						</div>
						<div class="col-6">
							<div class="cf-radio-btns">
								<div class="cfr-item">
									<input type="radio" name="shipping" id="ship-2">
									<label for="ship-2">$3.45</label>
								</div>
							</div>
						</div> -->
					</div>
					<div class="cf-title">Payment</div>
					<ul class="payment-list">
						<!-- <li>Paypal<a href="#"><img src="assets/img/paypal.png" alt=""></a></li>
						<li>Credit / Debit card<a href="#"><img src="assets/img/mastercart.png" alt=""></a></li> -->
						<li>Pay when you get the package</li>
					</ul>

					<?php
					if ($_SESSION['EMAIL_USER_LOGIN'] != 0) {
					?>
						<?php
						if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] != null) {
						?>
							<button type="submit" class="site-btn submit-order-btn">Place Order</button>
						<?php
						} else {
						?>
							<button type="button" class="site-btn submit-order-btn">Cart is empty</button>
						<?php
						}
						?>
					<?php
					}
					?>

				</form>
			</div>
			<div class="col-lg-4 order-1 order-lg-2">
				<div class="checkout-cart">
					<h3>Your Cart</h3>
					<ul class="product-list">
						<?php $total = 0; ?>
						<?php

						if (isset($_SESSION['EMAIL_USER_LOGIN'])) {

							if (isset($_SESSION['shopping_cart'])) {
								
								$subtotal = 0;
								foreach ($_SESSION['shopping_cart'] as $key => $value) {
									if ($value['qty'] == 0)
										continue;
									$subtotal = $value['product_price'] * $value['qty'];
									$total += $subtotal;

						?>

									<li>
										<div class="pl-thumb"><img src="admin/img/<?php echo $value['product_image']; ?>" alt=""></div>
										<h6><?php echo $value['product_title']; ?></h6>
										<p>Price: <?php echo number_format($value['product_price']); ?> VNĐ</p>
										<p>Quantity: <?php echo $value['qty']; ?></p>
									</li>
									
									<?php
								}
							}
						}
		?>
					</ul>


		<ul class="price-list">
			<li>Total<span><?php echo number_format($total); ?> VNĐ</span></li>
			<li>Shipping<span>free</span></li>
			<li class="total">Total<span><?php echo number_format($total); ?> VNĐ</span></li>
		</ul>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- checkout section end -->

<?php require_once 'inc/footer.php'; ?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>


<?php
if (!isset($_SESSION['EMAIL_USER_LOGIN'])) {
	header("location: index.php");
}
?>



<div class="page-top-info">
	<div class="container">
		<h4>Giỏ Hàng Của Bạn </h4>
		<div class="site-pagination">
			<a href="">Trang Chủ</a> /
			<a href="">Giỏ Hàng Của Bạn</a>
		</div>
	</div>
</div>

<section class="checkout-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 order-2 order-lg-1">
				<form class="checkout-form" action="order.php" method="post">
					<div class="cf-title">Địa chỉ thanh toán</div>
					<div class="row">
						<div class="col-md-7">
							<p>*Thông tin thanh toán</p>
						</div>
						
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
					<div class="cf-title">Thông tin giao hàng</div>
					<div class="row shipping-btns">
						<div class="col-6">
							<h4>Tiêu chuẩn</h4>
						</div>
						<div class="col-6">
							<div class="cf-radio-btns">
								<div class="cfr-item">
									<input checked type="radio" value="free" name="fee_shipping" id="ship-1">
									<label for="ship-1">Miễn Phí</label>
								</div>
							</div>
						</div>
					
					</div>
					<div class="cf-title">Thanh toán</div>
					<ul class="payment-list">
						
						<li>Thanh toán khi bạn nhận được  hàng</li>
					</ul>

					<?php
					if ($_SESSION['EMAIL_USER_LOGIN'] != 0) {
					?>
						<?php
						if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] != null) {
						?>
							
							<button type="submit" name="cash_payment" value="cash_payment" class="site-btn submit-order-btn" style="display: inline-block; width: 350px; margin-right: 10px;">Đặt hàng</button>
							<button type="submit" name="redirect" value="online_payment" class="site-btn submit-order-btn" style="display: inline-block; width: 350px;">Thanh Toán Qua VNPAY</button>
						<?php
						} else {
						?>
							<button type="button" class="site-btn submit-order-btn">Giỏ hàng trống</button>
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
					<h3>giỏ hàng của bạn</h3>
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
										<p>Giá: <?php echo number_format($value['product_price']); ?> VNĐ</p>
										<p>Số lượng: <?php echo $value['qty']; ?></p>
									</li>

						<?php
								}
							}
						}
						?>
					</ul>


					<ul class="price-list">
						<li>Tổng cộng<span><?php echo number_format($total); ?> VNĐ</span></li>
						<li>vận chuyển<span>miễn phí</span></li>
						<li class="total">Tổng<span><?php echo number_format($total); ?> VNĐ</span></li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>


<?php require_once 'inc/footer.php'; ?>
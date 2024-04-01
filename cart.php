<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php require_once 'inc/nav.php'; ?>


<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$cart = show_giohang($_SESSION['user_id']);
// print_r($_SESSION["shopping_cart"]);
?>

<pre>
	<?php
	// print_r($_SESSION["shopping_cart"]);
	?>
</pre>
<!-- Page info -->
<div class="page-top-info">
	<div class="container">
		<?php
		// echo $_SESSION['user_id'];
		?>

		<h4>Your cart </h4>
		<div class="site-pagination">
			<a href="">Home</a> /
			<a href="">Your cart</a>
		</div>
	</div>
</div>
<!-- Page info end -->

<!-- cart section end -->
<!-- <section class="cart-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="cart-table">
					<h3>Your Cart</h3>
					<?php
					$total = 0;
					?>
					<div class="cart-table-warp">
						<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="total-th">Price</th>
									<th class="total-th">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!isset($_SESSION['EMAIL_USER_LOGIN'])) {

									if (isset($_SESSION['shopping_cart'])) {
										$total = 0;
										foreach ($_SESSION['shopping_cart'] as $key => $value) {
											if ($value['qty'] == 0)
												continue;
											$subtotal = $value['product_price'] * $value['qty'];
											$total += $subtotal;
								?>

											<form action="update_cart.php" method="post">
												<tr>
													<td class="product-col">
														<img src="admin/img/<?php echo $value['product_image']; ?>" alt="">
														<div class="pc-title">
															<h4><?php echo $value['product_title']; ?></h4>
															<p><?php echo number_format($value['product_price']); ?></p>
														</div>
													</td>
													<td class="quy-col">
														<div class="quantity">
															<div class="">
																<input type="text" id="product_quantity_cart" name="qty[<?php echo $value['product_id']; ?>]" value="<?php echo $value['qty']; ?>" style="width: 50px;">
																<button type="submit" class="btn btn-sm btn-warning" name="update_qty_cart" style="width: 80px;">Update</button>
															</div>
														</div>
													</td>

													<td class="total-col">
														<h4><?php echo number_format($subtotal); ?> VNĐ</h4>
													</td>
													<td>
														<button type="submit" class="btn btn-sm btn-warning" value="<?php echo $value['product_id']; ?>" name="delete_cart" style="width: 90px;">Delete</button>
													</td>
												</tr>
											</form>

								<?php
										}
									} else {
										// Hiển thị thông báo khi giỏ hàng trống
										echo 'Cart is empty';
									}
								}
								?>

								<!-- hien thi gio hang cho khach hang da dang nhap -->
								<?php

								if (isset($_SESSION['EMAIL_USER_LOGIN'])) {

									if (isset($_SESSION['shopping_cart'])) {
										$total = 0;
										foreach ($_SESSION['shopping_cart'] as $key => $value) {
											if ($value['qty'] == 0)
												continue;
											$subtotal = $value['product_price'] * $value['qty'];
											$total += $subtotal;

								?>
											<!-- <form action="" method="post">
												<tr>
													<td class="product-col">
														<img src="assets/img/cart/1.jpg" alt="">
														<div class="pc-title">
															<h4><?php echo $value['product_title']; ?></h4>
															<p><?php echo number_format($value['product_price']); ?></p>
														</div>
													</td>
													<td class="quy-col">
														<div class="quantity">
															<div class="pro-qty">
																<input type="text" value="<?php echo $value['product_quantity']; ?>">
																<button type="submit" class="btn btn-sm btn-warning" name="update_qty_cart" style="width: 90px;">Update</button>
															</div>
														</div>
													</td>
													<td class="total-col">
														<h4><?php echo number_format($subtotal); ?> VNĐ</h4> -->
													</td>
													<td>
														<button type="submit" class="btn btn-sm btn-warning" value="<?php echo $value['product_id']; ?>" name="delete_cart" style="width: 90px;">Delete</button>
													</td>
												</tr>
											</form> -->

											<form action="update_cart.php" method="post">
												<tr>
													<td class="product-col">
														<img src="admin/img/<?php echo $value['product_image']; ?>" alt="">
														<div class="pc-title">
															<h4><?php echo $value['product_title']; ?></h4>
															<p><?php echo number_format($value['product_price']); ?></p>
														</div>
													</td>
													<td class="quy-col">
														<div class="quantity">
															<div class="">
																<input type="text" id="product_quantity_cart" name="qty[<?php echo $value['product_id']; ?>]" value="<?php echo $value['qty']; ?>" style="width: 50px;">
																<button type="submit" class="btn btn-sm btn-warning" name="update_qty_cart" style="width: 80px;">Update</button>
															</div>
														</div>
													</td>
													<td class="total-col">
														<h4><?php echo number_format($subtotal); ?> VNĐ</h4>
													</td>
													<td>
														<button type="submit" class="btn btn-sm btn-warning" value="<?php echo $value['product_id']; ?>" name="delete_cart" style="width: 90px;">Delete</button>
													</td>
												</tr>
											</form>
								<?php
										}
									} else {
										// Hiển thị thông báo khi giỏ hàng trống
										echo 'Cart is empty';
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="total-cost">
						<h6>Total <span><?php echo number_format($total) . ' VNĐ'; ?></span></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-4 card-right">
				<form class="promo-code-form">
					<input type="text" placeholder="Enter promo code">
					<button>Submit</button>
				</form>


				<?php
				if ($_SESSION['user_id'] != 0) {
				?>
					<?php

					if ($total == 0) {
					?>
						<a href="#" class="site-btn">Cart is Empty</a>
					<?php
					} else {
					?>
						<a href="checkout.php" class="site-btn">Proceed to checkout</a>
					<?php
					}
					?>

				<?php
				} else {
				?>
					<a href="login.php" class="site-btn">Please Login to checkout</a>
				<?php
				}
				?>

				<a href="index.php" class="site-btn sb-dark">Continue shopping</a>
			</div>
		</div>
	</div>
</section>
<!-- cart section end -->

<!-- Related product section -->
<!-- <section class="related-product-section">
		<div class="container">
			<div class="section-title text-uppercase">
				<h2>Continue Shopping</h2>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<div class="tag-new">New</div>
							<img src="assets/img/product/2.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Black and White Stripes Dress</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="assets/img/product/5.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="assets/img/product/9.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="assets/img/product/1.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
<!-- Related product section end -->

<?php require_once 'inc/footer.php'; ?>
<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php
require_once 'inc/nav.php';

$product_id = "";
if (isset($_GET['p_id'])) {
	$product_id = $_GET['p_id'];
}
$products = get_products('', $product_id);
$result = mysqli_fetch_assoc($products);


$related_product = get_related_products($result['category_name']);

?>

<!-- Page info -->
<div class="page-top-info">
	<div class="container">
		<h4>Category PAge</h4>
		<div class="site-pagination">
			<a href="index.php">Home</a> /
			<a href="">Product</a>
		</div>
	</div>
</div>
<!-- Page info end -->

<!-- product section -->
<section class="product-section">
	<div class="container">
		<div class="back-link">
			<a href="./category.php"> &lt;&lt; Back to Category </a>
		</div>

		<form action="add_cart.php" id="add_to_cart_form" method="post" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $result['p_id'] ?>" name="product_id">
			<input type="hidden" value="<?php echo $result['product_name'] ?>" name="product_title">
			<input type="hidden" value="<?php echo $result['img'] ?>" name="product_image">
			<input type="hidden" value="<?php echo $result['price'] ?>" name="product_price">


			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="admin/img/<?php echo $result['img']; ?>" alt="">
					</div>

				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php echo $result['product_name']; ?></h2>
					<h3 class="p-price"></h3>
					<h4 class="p-stock">Available: <span><?php echo $result['qty']; ?></span></h4>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					<div class="p-review">
						<h4><span>Price : </span>
							<?php echo number_format($result['price']) . ' VNĐ'; ?>
						</h4>
					</div>
					<div class="p-review">
						<a href="">3 reviews</a>|<a href="">Add your review</a>
					</div>
					<div class="quantity">
						<p>Quantity</p>
						<div class="pro-qty">
							<!-- <form action="" method="post"> -->
							<input type="text" value="1" id="qty" name="qty" value="<?php echo $result['qty'] ?>">
						</div>
					</div>

					<script>
						document.addEventListener("DOMContentLoaded", function() {
							document.getElementById("add_to_cart_form").addEventListener("submit", function(event) {
								var quantity = document.getElementById("qty").value;
								if (quantity <= 0) {
									event.preventDefault(); // Ngăn chặn gửi form đi
									alert("Vui lòng chọn số lượng sản phẩm ít nhất là 1!");
									document.getElementById("qty").value = 1; // Set lại giá trị nhỏ nhất là 1
								}
							});
						});
					</script>
					<script>
						document.addEventListener("DOMContentLoaded", function() {
							document.getElementById("qty").addEventListener("change", function() {
								var qtyInput = parseInt(this.value);
								var max_qty = <?php echo $result['qty']; ?>;

								if (qtyInput > max_qty) {
									var confirmMessage = 'Số lượng sản phẩm vượt quá số lượng có sẵn ' + max_qty + '. Bạn có muốn đặt theo số lượng có sẵn không?';
									if (confirm(confirmMessage)) {
										this.value = max_qty; // Gán lại giá trị tối đa vào trường nhập liệu
									} else {
										// Nếu người dùng không đồng ý, đặt lại giá trị thành giá trị trước đó của qty (trong trường hợp số lượng không hợp lệ)
										this.value = max_qty;
									}
								}
							});
						});
					</script>


					<button type="submit" id="p_id" value="<?php echo $result['p_id'] ?>" class="site-btn">Add to Cart</button>
					<!-- </form> -->
		</form>
		<div id="accordion" class="accordion-area">
			<div class="panel">
				<div class="panel-header" id="headingOne">
					<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
				</div>
				<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="panel-body">
						<p>
							<?php echo $result['description']; ?>
						</p>

					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-header" id="headingTwo">
					<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
				</div>
				<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="panel-body">
						<img src="./assets/img/cards.png" alt="">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-header" id="headingThree">
					<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
				</div>
				<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="panel-body">
						<h4>7 Days Returns</h4>
						<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="social-sharing">
			<a href=""><i class="fa fa-google-plus"></i></a>
			<a href=""><i class="fa fa-pinterest"></i></a>
			<a href=""><i class="fa fa-facebook"></i></a>
			<a href=""><i class="fa fa-twitter"></i></a>
			<a href=""><i class="fa fa-youtube"></i></a>
		</div>
	</div>
	</div>




	</div>
</section>
<!-- product section end -->


<!-- RELATED PRODUCTS section -->
<section class="related-product-section">
	<div class="container">
		<div class="section-title">
			<h2>RELATED PRODUCTS</h2>
		</div>
		<div class="product-slider owl-carousel">
			<?php
			while ($row = mysqli_fetch_assoc($related_product)) {
			?>


				<div class="product-item">
					<div class="pi-pic">
						<a href="product.php?p_id=<?php echo $row['p_id'] ?>">
							<img src="./admin/img/<?php echo $row['img'] ?>" alt="">
						</a>
						<div class="pi-links">
							<!-- <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a> -->
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6><?php echo number_format($row['price']) . ' VNĐ'; ?></h6>
						<a href="product.php?p_id=<?php echo $row['p_id'] ?>">
							<p><?php echo $row['product_name'] ?></p>
						</a>

					</div>
				</div>


			<?php
			}
			?>
		</div>
	</div>
</section>
<!-- RELATED PRODUCTS section end -->

<?php require_once 'inc/footer.php'; ?>
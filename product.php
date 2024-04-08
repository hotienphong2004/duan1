<?php require_once 'inc/header.php'; ?>

<?php
require_once 'inc/nav.php';

$product_id = "";
if (isset($_GET['p_id'])) {
	$product_id = $_GET['p_id'];
}
$products = get_products('', $product_id);
$result = mysqli_fetch_assoc($products);
$related_product = get_related_products($result['category_name']);

$comments = get_comments_by_product_id($product_id);
?>


<div class="page-top-info">
	<div class="container">
		<h4>Trang danh mục</h4>
		<div class="site-pagination">
			<a href="index.php">Trang Chủ</a> /
			<a href="">Sản phẩm</a>
		</div>
	</div>
</div>

<section class="product-section">
	<div class="container">
		<div class="back-link">
			<a href="./category.php"> &lt;&lt; Quay lại danh mục</a>
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
					<h4 class="p-stock">Có sẵn: <span><?php echo $result['qty']; ?></span></h4>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					<div class="p-review">
						<h4><span>Giá : </span>
							<?php echo number_format($result['price']) . ' VNĐ'; ?>
						</h4>
					</div>
					<div class="p-review">
						<a href="">3 đánh giá</a>|<a href="">Thêm đánh giá </a>
					</div>
					<div class="quantity">
						<p>Số Lượng</p>
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


					<button type="submit" id="p_id" value="<?php echo $result['p_id'] ?>" class="site-btn">Thêm vào giỏ hàng</button>
					
		</form>
		<div id="accordion" class="accordion-area">
			<div class="panel">
				<div class="panel-header" id="headingOne">
					<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">thông tin</button>
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
					<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Dịch vụ hỗ trợ </button>
				</div>
				<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="panel-body">
						<img src="./assets/img/cards.png" alt="">
						<p>Tại cửa hàng sneaker của chúng tôi, chúng tôi cam kết mang đến cho bạn không chỉ những đôi giày chất lượng mà còn là trải nghiệm chăm sóc khách hàng tuyệt vời nhất. Chúng tôi hiểu rằng, để bạn tự tin và phong cách hơn trong từng bước chân, việc lựa chọn đúng sản phẩm và nhận được sự hỗ trợ tận tình là vô cùng quan trọng..</p>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-header" id="headingThree">
					<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
				</div>
				<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="panel-body">
						<h4>Trả hàng trong 7 ngày</h4>
						<p>Trả tiền mặt khi nhận hàng<br>Giao hàng tận nhà <span>3 - 4 ngày</span></p>
						<p>Hãy đến với chúng tôi và trải nghiệm sự chuyên nghiệp, tận tâm trong từng dịch vụ và sản phẩm mà chúng tôi mang lại. Chúng tôi tin rằng, niềm đam mê của bạn cùng với sự hỗ trợ của chúng tôi sẽ tạo nên những bước đi tự tin và phong cách nhất trên mỗi nẻo đường..</p>
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

<section class="related-product-section">
	<div class="container">
		<div class="section-title">
			<h2>NHỮNG SẢM PHẨM TƯƠNG TỰ</h2>
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

<div class="book-description">
	<?php if (isset($_SESSION['USERNAME_USER_LOGIN'])) {
	?>
		<h1 class="heading-tertiary">Đánh giá của bạn</h1>
		<div class="comment-form">
			
			<form action="submit_comment.php" method="POST">
				<input type="hidden" class="comment_product_id" name="comment_product_id" value="<?php echo $product_id; ?>">
				<input type="hidden" class="comment_name" name="comment_name" value="<?php echo $_SESSION['USERNAME_USER_LOGIN']; ?>">
				
				<div class="form-group">
					<label for="comment-content" class="comment-label">Nội dung bình luận:</label>
					<textarea id="comment-content" name="comment" cols="" rows="10" name="comment-content" class="comment-textarea" required></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="comment-btn">Gửi bình luận</button>
				</div>
			</form>
		</div>	
	<?php
	} ?>


	<div class="comment-list">
		
		<h2 class="comment-heading">Các bình luận</h2>
		<ul>
			<?php if ($comments) {
				foreach ($comments as $comment) { ?>

					<li class="comment-item">
						<div class="comment-avatar">
							<img src="<?php echo 'admin/img/user.png' ?>" alt="Avatar" class="avatar">
						</div>
						<div class="comment-content">
							<form action="edit_comment.php" method="post">
								<p class="comment-meta"><span class="comment-author"><?php echo $comment['comment_name']; ?></span></p>
								<?php if (isset($_SESSION['USERNAME_USER_LOGIN']) == $comment['comment_name']) {
								?>
									<textarea name="comment" id="" cols="50" rows="3"><?php echo $comment['comment'] ?></textarea>
								<?php
								} else {
								?>
									<textarea readonly name="" id="" cols="50" rows="3"><?php echo $comment['comment'] ?></textarea>
								<?php
								} ?>

								<?php if (isset($_SESSION['USERNAME_USER_LOGIN']) == $comment['comment_name']) {
								?>
									<div class="comment-actions">
										<input type="hidden" class="comment_id" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
										<input type="hidden" class="comment_product_id" name="comment_product_id" value="<?php echo $comment['comment_product_id']; ?>">
										<!-- Nút chỉnh sửa -->
										<button class="edit-comment-btn" name="button_name" value="btn_edit">Chỉnh sửa</button>
										<!-- Nút xóa -->
										<button class="delete-comment-btn" name="button_name" value="btn_delete">Xóa</button>
									</div>
								<?php
								} ?>
							</form>
					<?php }
			} ?>

						</div>
					</li>


		</ul>
	</div>
</div>


<style>
	.book-description {
		margin: 10px;
		padding: 10px;
		border: 1px solid #ccc;
	}

	.heading-tertiary {
		font-size: 20px;
		margin-bottom: 5px;
	}

	.comment-form {
		margin-bottom: 10px;
	}

	.comment-label {
		display: block;
		font-weight: bold;
		font-size: 16px;
	}

	.comment-textarea {
		width: calc(100% - 20px);
		padding: 8px;
		border: 1px solid #ccc;
		border-radius: 5px;
		resize: vertical;
		font-size: 14px;
	}

	.comment-btn {
		background-color: #007bff;
		color: #fff;
		border: none;
		padding: 8px 16px;
		border-radius: 5px;
		cursor: pointer;
		font-size: 14px;
	}

	.comment-btn:hover {
		background-color: #0056b3;
	}

	.comment-list {
		/* border-top: 1px solid #ccc; */
		padding-top: 10px;
	}

	.comment-heading {
		font-size: 18px;
		margin-bottom: 5px;
	}

	.comment-item {
		margin-bottom: 10px;
		list-style: none;
	}

	.comment-avatar {
		float: left;
		margin-right: 5px;
	}

	.avatar {
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}

	.comment-content {
		overflow: hidden;
	}

	.comment-meta {
		margin-bottom: 5px;
	}

	.comment-actions button {
		background-color: #dc3545;
		color: #fff;
		border: none;
		padding: 4px 8px;
		border-radius: 5px;
		cursor: pointer;
		margin-right: 3px;
		font-size: 12px;
	}

	.comment-actions button:hover {
		background-color: #c82333;
	}
</style>

<?php require_once 'inc/footer.php'; ?>
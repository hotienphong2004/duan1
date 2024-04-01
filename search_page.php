<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php
require_once 'inc/nav.php';

$keyword = !empty($_GET["keyword"]) ? $_GET["keyword"] : '';
$result_find = search_product($keyword);

?>

<?php
$cat_id = "";
if (isset($_GET['id'])) {
	$cat_id = mysqli_real_escape_string($con, $_GET['id']);
}
$particular_product = get_products($cat_id);
$display_cat_links = display_cat_links($cat_id);
$result = mysqli_fetch_assoc($display_cat_links);


// phan trang
$limit = 6; // Số đơn hàng trên mỗi trang
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Lấy số trang hiện tại
$start = ($page - 1) * $limit; // Tính vị trí bắt đầu

// $sql = "SELECT * FROM `order` LIMIT $start, $limit where customer_id = '$_SESSION['user_id']'"; // Lấy đơn hàng cho trang hiện tại
$sql = "SELECT * FROM `products` WHERE product_name like '%$keyword%' and products.status = 1 LIMIT $start, $limit";

$query = mysqli_query($con, $sql);

$sql_total = "SELECT COUNT(*) AS total FROM `products` WHERE product_name and products.status = 1 like '%$keyword%'"; // Tính tổng số đơn hàng
$query_total = mysqli_query($con, $sql_total);
$result_total = mysqli_fetch_assoc($query_total);
$total_pages = ceil($result_total['total'] / $limit); // Tính tổng số trang
?>

<!-- Page info -->
<div class="page-top-info">
	<div class="container">
		<h4>Search for: <?php echo $keyword; ?></h4>
		<div class="site-pagination">
			<a href="index.php">Home</a>
			<a href="">
				<?php
				if ($result == null) {
					echo '';
				} else {
					echo $result['cat_name'];
				}
				?>
			</a>
		</div>

	</div>
</div>
<!-- Page info end -->


<!-- Category section -->
<section class="category-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12  order-1 order-lg-2 mb-5 mb-lg-0">
				<div class="row">

					<?php
					$flag = true;
					if (mysqli_num_rows($query)) {

						while ($row = mysqli_fetch_assoc($query)) {
					?>
							<div class="col-lg-4 col-sm-6">
								<div class="product-item">
									<div class="pi-pic">
										<a href="product.php?p_id=<?php echo $row['p_id'] ?>">
											<img src="./admin/img/<?php echo $row['img'] ?>" alt="">
										</a>

										<div class="pi-links">
											<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
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
							</div>
					<?php
						}
					} else {
						$flag = false;
						echo ' Record Not Found ';
					}
					?>


				</div>
			</div>
		</div>
	</div>


	<?php
	if ($flag == true) {
	?>

		<div style="margin-top: 50px;"></div>
		<div class="d-flex justify-content-center">
			<div class="clearfix">

				<div class="hint-text"><b><?php echo $page; ?></b> trên tổng <b> <?php echo $total_pages; ?> </b> trang</div>
				<ul class="pagination">

					<!-- <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-left"></i></a></li> -->

					<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
						<!-- <a class="pagination-button special" href="?page=
                                    <?php
									// echo $i; 
									?>">
                                    <?php
									// echo $i; 
									?></a> -->
						<li class="page-item"><a href="?keyword=<?php echo $_GET["keyword"]; ?>&page=<?php echo $i; ?>" class="page-link" style="z-index: 3;"><?php echo $i; ?></a></li>



					<?php endfor; ?>
					<!-- <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li> -->
				</ul>
			</div>
		</div>

	<?php
	}
	?>



</section>
<!-- Category section end -->
<?php require_once 'inc/footer.php'; ?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>

<?php
$products = get_products("");
$all_product = get_all_products();
?>


<section class="hero-section">
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="assets/img/bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">
                        <span>Sản Phẩm mới</span>
                        <h2>Sneaker Shop</h2>
                        <p>Cùng bước đi với phong cách - Sneaker cho mọi chặng đường của bạn!</p>
                        <a href="#" class="site-btn sb-line">Khám Phá</a>
                        <a href="#" class="site-btn sb-white">Thêm vào Giỏ Hàng</a>
                    </div>
                </div>
                <div class="offer-card text-white">
                    <span></span>
                    <h2>$29</h2>
                    <p>Mua Ngay bây giờ</p>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="assets/img/bg-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">
                        <span>Sản Phẩm mới</span>
                        <h2>Sneaker Shop</h2>
                        <p>Cùng bước đi với phong cách - Sneaker cho mọi chặng đường của bạn!</p>
                        <a href="#" class="site-btn sb-line">Khám Phá</a>
                        <a href="#" class="site-btn sb-white">Thêm vào Giỏ Hàng</a>
                    </div>
                </div>
                <div class="offer-card text-white">
                    <span></span>
                    <h2>$29</h2>
                    <p>Mua Ngay bây giờ</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="slide-num-holder" id="snh-1"></div>
    </div>
</section>

<section class="features-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="assets/img/icons/1.png" alt="#">
                    </div>
                    <h2>Thanh toán nhanh chóng an toàn</h2>
                </div>
            </div>
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="assets/img/icons/2.png" alt="#">
                    </div>
                    <h2>Sản phẩm cao cấp</h2>
                </div>
            </div>
            <div class="col-md-4 p-0 feature">
                <div class="feature-inner">
                    <div class="feature-icon">
                        <img src="assets/img/icons/3.png" alt="#">
                    </div>
                    <h2>Giao hàng miễn phí và nhanh chóng</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>SẢN PHẨM MỚI NHẤT</h2>
        </div>
        <div class="product-slider owl-carousel">
            <?php
            while ($row = mysqli_fetch_assoc($products)) {
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

<section class="product-filter-section">
    <div class="container">
        <div class="section-title">
            <h2>TÌM KIẾM SẢN PHẨM BÁN HÀNG HÀNG ĐẦU</h2>
        </div>
        <ul class="product-filter-menu">
            <li><a href="#">THỊNH HÀNH</a></li>
          
        </ul>
        <div class="row">
            <?php
            while ($result = mysqli_fetch_assoc($all_product)) {
            ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <a href="product.php?p_id=<?php echo $result['p_id'] ?>">
                                <img src="./admin/img/<?php echo $result['img'] ?>" alt="">
                            </a>
                            <div class="pi-links">
                                <!-- <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a> -->
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6><?php echo number_format($result['price']) . ' VNĐ'; ?></h6>
                            <a href="product.php?p_id=<?php echo $result['p_id'] ?>">
                                <p><?php echo $result['product_name'] ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- <div class="text-center pt-5">
            <button class="site-btn sb-line sb-dark">LOAD MORE</button>
        </div> -->
    </div>
</section>
<!-- Product filter section end -->


<!-- Banner section -->
<!-- <section class="banner-section">
    <div class="container">
        <div class="banner set-bg" data-setbg="assets/img/banner-bg.jpg">
            <div class="tag-new">NEW</div>
            <span>New Arrivals</span>
            <h2>STRIPED SHIRTS</h2>
            <a href="#" class="site-btn">SHOP NOW</a>
        </div>
    </div>
</section> -->
<!-- Banner section end  -->

<!-- Footer  -->

<?php require_once 'inc/footer.php'; ?>
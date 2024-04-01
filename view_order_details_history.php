<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php require_once 'inc/nav.php'; ?>

<?php
if (!isset($_SESSION['EMAIL_USER_LOGIN'])) {
    header("location: index.php");
}
?>
<?php 
if (isset($_GET['order_code'])) {
    $order_details = xem_chitiet_donhang($_GET['order_code']);
} 
?>
<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$allDonHang = tatca_donhang($_SESSION['user_id']);
?>
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Your Order History </h4>
        <div class="site-pagination">
            <a href="index.php">Home</a>/
            <a href="">Details Order</a>
        </div>
    </div>
</div>
<!-- Page info end -->
<!-- cart section end -->
<section class="cart-section spad" style="padding-top: 0;">
    <div class="container order">
        <div class="row">
        </div>
        <div class="container-xl order_customer">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">

                        <div class="row">
                            <div class="col-12 text-left">
                                <h7 class="tm-block-title d-inline-block" style="color: red;">

                                </h7>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_price = 0;
                                $i = 0;
                                ?>

                                <!-- @foreach($order_details as $key => $details) -->
                                <?php foreach ($order_details as $sp) : ?>
                                    <?php
                                    extract($sp)
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $i++;
                                            echo $i;
                                            ?>
                                        </td>
                                        <td><?php echo $product_name ?></td>
                                        <td>
                                            <img src="admin/img/<?php echo $img; ?>" height="100" width="100" alt="">
                                        </td>
                                        <td>
                                            <input type="text" disabled value="<?= $product_quantity ?>" name="product_quantity">
                                        </td>

                                        <td><?php echo number_format($product_price) . ' VNĐ'; ?></td>
                                        <td><?php echo number_format($product_quantity * $product_price) . ' VNĐ'; ?></td>
                                    </tr>
                                    <?php
                                    $total_price += $product_quantity * $product_price;
                                    ?>
                                <?php endforeach ?>

                            <tfoot>
                                <tr>
                                    <td colspan="5"><strong>Tổng đơn hàng:</strong></td>
                                    <td><strong><?php echo number_format($total_price) . ' VNĐ'; ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<?php require_once 'inc/footer.php'; ?>
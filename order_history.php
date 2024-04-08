<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>

<?php
if (!isset($_SESSION['EMAIL_USER_LOGIN'])) {
    header("location: index.php");
}
?>

<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$allDonHang = tatca_donhang($_SESSION['user_id']);



// phan trang
$limit = 2; // Số đơn hàng trên mỗi trang
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Lấy số trang hiện tại
$start = ($page - 1) * $limit; // Tính vị trí bắt đầu

// $sql = "SELECT * FROM `order` LIMIT $start, $limit where customer_id = '$_SESSION['user_id']'"; // Lấy đơn hàng cho trang hiện tại
$sql = "SELECT * FROM `order` WHERE customer_id = '{$_SESSION['user_id']}' LIMIT $start, $limit";

$query = mysqli_query($con, $sql);

$sql_total = "SELECT COUNT(*) AS total FROM `order`"; // Tính tổng số đơn hàng
$query_total = mysqli_query($con, $sql_total);
$result_total = mysqli_fetch_assoc($query_total);
$total_pages = ceil($result_total['total'] / $limit); // Tính tổng số trang
?>

<div class="page-top-info">
    <div class="container">


        <h4>Lịch Sử Đặt Hàng </h4>
        <div class="site-pagination">
            <a href="index.php">Trang chủ</a> /
            <a href="">Lịch Sử Đặt Hàng</a>
        </div>
    </div>
</div>

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
                                    <th>Mã hóa đơn</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Xem đơn</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $ord) : ?>
                                    <?php extract($ord) ?>
                                    <tr>
                                        <td><?php echo $order_code; ?></td>

                                        <td>
                                            <?php
                                            if ($order_status == 1) echo "Đang xử lí";

                                            else echo 'Giao hàng thành công';
                                            ?>
                                        </td>

                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <a href="view_order_details_history.php?order_code=<?php echo $order_code; ?>" class="edit" title="View" data-toggle="tooltip"><i class="flaticon-file"></i> Xem chi tiết</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>


                        <br>


                        <div class="clearfix">

                            <?php
                            if ($total_pages != 0) {
                            ?>
                                <div class="hint-text"><b><?php echo $page; ?></b> trên tổng <b> <?php echo $total_pages; ?> </b> trang</div>
                            <?php
                            }
                            ?>

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
                                    <li class="page-item"><a href="?page=<?php echo $i; ?>" class="page-link" style="z-index: 3;"><?php echo $i; ?></a></li>

                                <?php endfor; ?>
                                <!-- <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
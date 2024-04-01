<?php
require_once 'inc/header.php';


$value = view_product();
$allDonHang = tatca_donhang();

?>
<?php

if (!isset($_SESSION['ADMIN'])) {
    header("location: index.php");
}

?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}
?>

<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Order Master</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Order</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tình trạng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Xem đơn</th>

                        </tr>
                    </thead>


                    <tbody>
                                <?php foreach ($allDonHang as $ord) : ?>
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
                                            <a href="order_details_master.php?order_code=<?php echo $order_code; ?>" class="edit" title="View" data-toggle="tooltip"><i class="flaticon-file"></i> Xem chi tiết</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<?php require_once 'inc/footer.php'; ?>
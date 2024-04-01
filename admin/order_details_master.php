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

<?php
if (isset($_GET['order_code'])) {
    $order_details = xem_chitiet_donhang_admin($_GET['order_code']);
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
                <h4>Customer information</h4>
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name Account</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $row) : ?>
                            <?php
                            extract($row)
                            ?>
                            <tr>
                                <td><?php echo $row['user_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                            <?php break; ?>
                        <?php endforeach ?>
                </table>
                <br>

                <h4>Shipping information</h4>
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Country</th>
                            <th>Zipcode</th>
                            <th>Phone</th>
                            <th>Fee Shipping</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $row) : ?>
                            <?php
                            extract($row)
                            ?>
                            <tr>
                                <td><?php echo $row['name_shipping'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['country'] ?></td>
                                <td><?php echo $row['zipcode'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['fee_shipping'] ?></td>
                            </tr>
                            <?php break; ?>
                        <?php endforeach ?>
                </table>
                <br>
                <h4>Details Order</h4>
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity-Inventory</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
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
                                <td><?= $p_name ?></td>
                                <td>
                                    <img src="./img/<?php echo $img; ?>" height="100" width="100" alt="">
                                </td>
                                <td>
                                    <input type="hidden" name="order_qty_storage" class="order_qty_storage_<?php echo $p_id; ?>" value="<?php echo $qty; ?>">
                                    <input type="text" readonly  value="<?php echo $qty ?>" name="product_quantity">
                                    <input type="hidden" name="order_code" class="order_code_input" value="<?php echo $order_code ?>">
                                    <input type="hidden" name="order_product_id" class="order_product_id" value="<?php echo $p_id; ?>">
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $product_quantity ?>" name="product_sales_quantity" class="input_qty order_qty_<?php echo $p_id; ?>">
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

                    <tr>
                        <td colspan="9" class="color_qty_{{$details->product_id}}">
                            <?php
                            if ($order_status == 1) {
                            ?>
                                <form >
                                    <select class="order_details">
                                        <option value="">----Chọn hình thức đơn hàng----</option>
                                        <option id="<?php echo $order_id; ?>" value="1" selected>Chưa xử lý</option>
                                        <option id="<?php echo $order_id; ?>" value="2">Đã xử lý - Đã giao hàng</option>
                                        <!-- <option value="3">Hủy đơn hàng - Tạm giữ</option> -->
                                    </select>
                                </form>
                            <?php
                            } elseif ($order_status == 2) {
                            ?>
                                <form>
                                    <select class="order_details">
                                        <option value="">----Chọn hình thức đơn hàng----</option>
                                        <option id="<?php echo $order_id; ?>" value="1">Chưa xử lý</option>
                                        <option id="<?php echo $order_id; ?>" value="2" selected>Đã xử lý - Đã giao hàng</option>
                                        <!-- <option value="3">Hủy đơn hàng - Tạm giữ</option> -->
                                    </select>
                                </form>
                            <?php
                            }
                            ?>

                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</div>

<?php require_once 'inc/footer.php'; ?>
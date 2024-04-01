<?php
require_once 'inc/header.php'; 
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
require_once 'inc/nav.php';
?>

<?php
$order_id = $_POST['order_id'];
$order_status = $_POST['order_status'];

$sqlUpdateOrder = "UPDATE `order` SET order_status = '$order_status' WHERE order_id = '$order_id'";
mysqli_query($con, $sqlUpdateOrder);

if ($order_status == 2) {
    $total_order      = 0;
    $quantity         = 0;
    $sales            = 0;
    $profit           = 0;
    foreach ($_POST['order_product_id'] as $key => $product_id) {
        $sqlSelectProduct = "SELECT * FROM products WHERE p_id = '$product_id'";
        $resultSelectProduct = mysqli_query($con, $sqlSelectProduct);
        $product = mysqli_fetch_assoc($resultSelectProduct);

        $product_quantity = $product['qty'];
        $product_sold = $product['product_sold'];

        foreach ($_POST['qty'] as $key2 => $qty) {
            if ($key == $key2) {
                $pro_remain = $product_quantity - $qty;
                $sqlUpdateProduct = "UPDATE products SET qty = '$pro_remain', product_sold = '" . ($product_sold + $qty) . "' WHERE p_id = '$product_id'";
                mysqli_query($con, $sqlUpdateProduct);
            }
        }
    }

    echo "Success";
} elseif ($order_status != 2 && $order_status != 3) {

    foreach ($_POST['order_product_id'] as $key => $product_id) {
        $sqlSelectProduct = "SELECT * FROM products WHERE p_id = '$product_id'";
        $resultSelectProduct = mysqli_query($con, $sqlSelectProduct);
        $product = mysqli_fetch_assoc($resultSelectProduct);

        $product_quantity = $product['qty'];
        $product_sold = $product['product_sold'];

        foreach ($_POST['qty'] as $key2 => $qty) {
            if ($key == $key2) {
                $pro_remain = $product_quantity + $qty;
                $sqlUpdateProduct = "UPDATE products SET qty = '$pro_remain', product_sold = '" . ($product_sold - $qty) . "' WHERE p_id = '$product_id'";
                mysqli_query($con, $sqlUpdateProduct);
            }
        }
    }
    echo "Success";

}
?>

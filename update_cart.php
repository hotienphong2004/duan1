<?php require_once './functions/db.php'; ?>
<?php require_once './functions/functions.php'; ?>
<?php session_start(); ?>
<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$customer_id = $_SESSION['user_id'];
$cart = show_giohang($customer_id);
if ($customer_id == null) {

    if (isset($_POST['delete_cart'])) {
        if (isset($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $key => $value) {
                if ($_SESSION["shopping_cart"][$key]['product_id'] == $_POST['delete_cart']) {
                    unset($_SESSION["shopping_cart"][$key]);
                }
                // include 'view/cart.php';
            }
        } else {
            // include 'view/cart.php';
        }
    } else {
        foreach ($_POST["qty"] as $key => $qty) {
            foreach ($_SESSION["shopping_cart"] as $session => $value) {
                if ($value['product_id'] == $key && $qty >= 1) {
                    $_SESSION["shopping_cart"][$session]['qty'] = $qty;
                } elseif ($value['product_id'] == $key && $qty <= 0) {
                    unset($_SESSION["shopping_cart"][$session]);
                }
            }
        }
    }
} else {

    if (isset($_POST['delete_cart'])) {
        if (isset($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $key => $value) {
                if ($_SESSION["shopping_cart"][$key]['product_id'] == $_POST['delete_cart']) {
                    unset($_SESSION["shopping_cart"][$key]);
                    // delete_sanpham_giohang($_POST['delete_cart'], $customer_id);
                }
                // include 'view/cart.php';
            }
        } else {
            // include 'view/cart.php';
        }
    } else {
        foreach ($_POST["qty"] as $key => $qty) {
            foreach ($_SESSION["shopping_cart"] as $session => $value) {
                if ($value['product_id'] == $key && $qty >= 1) {
                    $_SESSION["shopping_cart"][$session]['qty'] = $qty;
                    // thaydoisoluong_sanpham_giohang($key, $customer_id, $qty);
                } elseif ($value['product_id'] == $key && $qty <= 0) {
                    unset($_SESSION["shopping_cart"][$session]);
                    // delete_sanpham_giohang($value['product_id'], $customer_id);
                }
            }
        }
    }
}

header("location: cart.php");

?>

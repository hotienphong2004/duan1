<?php require_once './functions/db.php'; ?>
<?php require_once './functions/functions.php'; ?>
<?php session_start(); ?>
<?php
// $customer_id_for_nologin = rand(0, 10000);
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$customer_id = $_SESSION['user_id'];

if($customer_id == 0){
    if (isset($_POST['product_id'], $_POST['qty'] ) && ($_POST['qty'] > 0)) {
        if (isset($_SESSION["shopping_cart"])) {
            $avaiable = 0;
            foreach ($_SESSION["shopping_cart"] as $key => $value) {
                if ($_SESSION["shopping_cart"][$key]['product_id'] == $_POST['product_id']) {
                    $avaiable++;
                    $_SESSION["shopping_cart"][$key]['qty'] = $_SESSION["shopping_cart"][$key]['qty'] + $_POST['qty'];
                }
                
                $item = array(
                    'product_id'    => $_POST["product_id"],
                    'product_title' => $_POST["product_title"],
                    'product_price' => $_POST["product_price"],
                    'product_image' => $_POST["product_image"],
                    'qty' => $_POST["qty"],
                    'customer_id' => $customer_id,
                );
            }
            if ($avaiable == 0) {
                $item = array(
                    'product_id'    => $_POST["product_id"],
                    'product_title' => $_POST["product_title"],
                    'product_price' => $_POST["product_price"],
                    'product_image' => $_POST["product_image"],
                    'qty' => $_POST["qty"],
                    'customer_id' => $customer_id,
                );
                $_SESSION["shopping_cart"][] = $item;
            }
        } else {
            // $_SESSION["shopping_cart"] = array_filter($_SESSION["shopping_cart"], function ($item) {
            //     return !empty($item['product_id']) && !empty($item['product_title']) && !empty($item['product_price']) && !empty($item['product_image']) && !empty($item['product_quantity']);
            // });
            $item = array(
                'product_id'    => $_POST["product_id"],
                'product_title' => $_POST["product_title"],
                'product_price' => $_POST["product_price"],
                'product_image' => $_POST["product_image"],
                'qty' => $_POST["qty"],
                'customer_id' => $customer_id,
            );
            $_SESSION["shopping_cart"][] = $item;
        }
        
    }
}else{
    if (isset($_POST['product_id'], $_POST['qty']) && ($_POST['qty'] > 0)) {
        if (isset($_SESSION["shopping_cart"])) {
            $avaiable = 0;
            foreach ($_SESSION["shopping_cart"] as $key => $value) {
                if ($_SESSION["shopping_cart"][$key]['product_id'] == $_POST['product_id']) {
                    $avaiable++;
                    $_SESSION["shopping_cart"][$key]['qty'] =  $_SESSION["shopping_cart"][$key]['qty'] + $_POST['qty'];
                }
            }
            if ($avaiable == 0) {
                $item = array(
                    'product_id'    => $_POST["product_id"],
                    'product_title' => $_POST["product_title"],
                    'product_price' => $_POST["product_price"],
                    'product_image' => $_POST["product_image"],
                    'qty' => $_POST["qty"],
                    'customer_id' => $customer_id,
                );
                $_SESSION["shopping_cart"][] = $item;
            }
        } else {
            // $_SESSION["shopping_cart"] = array_filter($_SESSION["shopping_cart"], function ($item) {
            //     return !empty($item['product_id']) && !empty($item['product_title']) && !empty($item['product_price']) && !empty($item['product_image']) && !empty($item['product_quantity']);
            // });
            $item = array(
                'product_id'    => $_POST["product_id"],
                'product_title' => $_POST["product_title"],
                'product_price' => $_POST["product_price"],
                'product_image' => $_POST["product_image"],
                'qty' => $_POST["qty"],
                'customer_id' => $customer_id,
            );
            $_SESSION["shopping_cart"][] = $item;
        }
    }
}
header("location: cart.php");
?>

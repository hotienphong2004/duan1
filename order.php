<?php require_once './functions/db.php'; ?>
<?php require_once './functions/functions.php'; ?>
<?php session_start(); ?>

<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$customer_id = $_SESSION['user_id'];
// $cart = show_giohang($customer_id);

?>

<?php


if (
    !empty($_POST["name"]) &&
    !empty($_POST["address"]) &&
    !empty($_POST["country"]) &&
    !empty($_POST["zipcode"]) &&
    !empty($_POST["phone"]) &&
    !empty($_POST["fee_shipping"])
) {
    $table_order = "order";
    $table_order_details = "order_detail";
    $name = $_POST["name"];
    $address = $_POST["address"];
    $country = $_POST["country"];
    $zipcode = $_POST["zipcode"];
    $phone = $_POST["phone"];
    $fee_shipping = $_POST["fee_shipping"];

    $customer_id = $_SESSION['user_id'];

    // $cart = show_giohang($customer_id);

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $order_code = rand(0, 9999);
    $date = date("d/m/Y");
    $hour = date("h:i:sa");
    // $order_date = $date.$hour;

    $data_order = array(
        'order_status' => '1',
        'order_code' => $order_code,
        'order_date' => $date . ' ' . $hour,
        'customer_id' => $customer_id,
    );

    insert_donhang($data_order);

    if (isset($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
            $data_order_detail = array(
                'order_code' => $order_code,
                'product_id' => $value['product_id'],
                'product_quantity' => $value['qty'],
                'product_price' => $value['product_price'],
                'name' => $name,
                'address' => $address,
                'country' => $country,
                'zipcode' => $zipcode,
                'phone' => $phone,
                'fee_shipping' => $fee_shipping,
            );

            $success = insert_chitiet_donhang($data_order_detail);
        }
        unset($_SESSION["shopping_cart"]);
        // delete_giohang($customer_id);
    }
} else {
    echo '<script>alert("Vui lòng nhập đầy đủ thông tin đặt hàng!"); window.location.href="checkout.php";</script>';
}


?>
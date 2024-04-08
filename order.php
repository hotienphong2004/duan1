<?php require_once './functions/db.php'; ?>
<?php require_once './functions/functions.php'; ?>
<?php require_once './config_vnpay.php'; ?>
<?php session_start(); ?>

<?php
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$customer_id = $_SESSION['user_id'];
// $cart = show_giohang($customer_id);

?>

<?php
$fee_shipping = $_POST["fee_shipping"];
$customer_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$order_code = rand(0, 999999);
$date = date("d/m/Y");
$hour = date("h:i:sa");

$order_total = 0;

if (isset($_SESSION['shopping_cart'])) {
    foreach ($_SESSION['shopping_cart'] as $key => $value) {
        $data_order_detail = array(
            'product_quantity' => $value['qty'],
            'product_price' => $value['product_price'],
        );
        $order_total += $value['product_price'] * $value['qty'];
    }
}

if (isset($_POST['cash_payment']) && !empty($_POST['cash_payment'])) {
    if (!empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["country"]) && !empty($_POST["zipcode"]) && !empty($_POST["phone"]) && !empty($_POST["fee_shipping"])) {

        $table_order = "order";
        $table_order_details = "order_detail";
        $name = $_POST["name"];
        $address = $_POST["address"];
        $country = $_POST["country"];
        $zipcode = $_POST["zipcode"];
        $phone = $_POST["phone"];

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

    }else {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin đặt hàng!"); window.location.href="checkout.php";</script>';
    }

} elseif (isset($_POST['redirect']) && !empty($_POST['redirect'])) {
    if (!empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["country"]) && !empty($_POST["zipcode"]) && !empty($_POST["phone"]) && !empty($_POST["fee_shipping"])) {
        // Xử lý khi phương thức thanh toán là "Pay by ATM/Visa/Master" được chọn
        // echo "Online payment selected";
        // $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

        $vnp_TxnRef = $order_code;
        $vnp_OrderInfo = 'Thanh toán đơn hàng đặt tại Website Sneaker Store.';
        $vnp_OrderType = 'billpayment';
        // $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Amount = $order_total * 100;

        $vnp_Locale = 'en';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
       
        $vnp_ExpireDate = $expire;


        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {

            $_SESSION['order_code'] = $order_code;
            $_SESSION['name'] = $_POST["name"];
            $_SESSION['address'] = $_POST["address"];
            $_SESSION['country'] = $_POST["country"];
            $_SESSION['zipcode'] = $_POST["zipcode"];
            $_SESSION['phone'] = $_POST["phone"];
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    } else {
        echo '<script>alert("Vui lòng điền đầy đủ thông tin đặt hàng!"); window.location.href="checkout.php";</script>';
    }
}


?>
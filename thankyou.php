<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php';
if (!isset($_SESSION['EMAIL_USER_LOGIN']) || !isset($_GET['vnp_TransactionNo'])) {
  echo "<script>window.location.href = 'index.php';</script>";
  exit;
}
?>

<?php

//////////////// truy van pdo

if (!check_vnp_banktranno_exist($_GET['vnp_TransactionNo']) && isset($_GET['vnp_BankTranNo'])) {
  // Lấy dữ liệu từ query string
  $vnp_amount = $_GET['vnp_Amount'];
  $vnp_bankcode = $_GET['vnp_BankCode'];
  $vnp_banktranno = $_GET['vnp_BankTranNo'];
  $vnp_cardtype = $_GET['vnp_CardType'];
  $vnp_orderinfo = $_GET['vnp_OrderInfo'];
  $vnp_paydate = $_GET['vnp_PayDate'];
  $vnp_responsecode = $_GET['vnp_ResponseCode'];
  $vnp_tmncode = $_GET['vnp_TmnCode'];
  $vnp_transactionno = $_GET['vnp_TransactionNo'];
  $order_code = $_SESSION['order_code'];

  //insert don hang va chi tiet don hang
  $table_order = "order";
  $table_order_details = "order_detail";

  $name = $_SESSION['name'];
  $address = $_SESSION['address'];
  $country = $_SESSION['country'];
  $zipcode = $_SESSION['zipcode'];
  $phone = $_SESSION['phone'];
  $fee_shipping = 'free';

  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $order_code = rand(0, 999999);
  $date = date("Y-m-d");
  $hour = date("h:i:sa");

  // Thực hiện kết nối đến CSDL bằng PDO
  require_once 'functions/funtions_pdo.php';
  $pdo = connect_to_database('localhost', 'ecommerce', 'root', '');

  try {
    // Bắt đầu giao dịch
    $pdo->beginTransaction();

    // Thêm đơn hàng
    $sql = "INSERT INTO `order` (order_status, order_code, order_date, customer_id) VALUES (:order_status, :order_code, :order_date, :customer_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':order_status' => '1',
      ':order_code' => $order_code,
      ':order_date' => $date . ' ' . $hour,
      ':customer_id' => $_SESSION['user_id']
    ));

    // Lấy ID của đơn hàng vừa thêm vào
    $order_id = $pdo->lastInsertId();

    // Thêm chi tiết đơn hàng
    if (isset($_SESSION['shopping_cart'])) {
      foreach ($_SESSION['shopping_cart'] as $key => $value) {
        $sql = "INSERT INTO order_detail (order_code, product_id, product_quantity, product_price, name, address, country, zipcode, phone, fee_shipping) VALUES (:order_code, :product_id, :product_quantity, :product_price, :name, :address, :country, :zipcode, :phone, :fee_shipping)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':order_code' => $order_code,
          ':product_id' => $value['product_id'],
          ':product_quantity' => $value['qty'],
          ':product_price' => $value['product_price'],
          ':name' => $name,
          ':address' => $address,
          ':country' => $country,
          ':zipcode' => $zipcode,
          ':phone' => $phone,
          ':fee_shipping' => $fee_shipping
        ));
      }
      unset($_SESSION["shopping_cart"]);
    }

    // Thêm thông tin thanh toán vào bảng vnpay
    $sql = "INSERT INTO vnpay (vnp_amount, vnp_bankcode, vnp_banktranno, vnp_cardtype, vnp_orderinfo, vnp_paydate, vnp_responsecode, vnp_tmncode, vnp_transactionno, order_code) VALUES (:vnp_amount, :vnp_bankcode, :vnp_banktranno, :vnp_cardtype, :vnp_orderinfo, :vnp_paydate, :vnp_responsecode, :vnp_tmncode, :vnp_transactionno, :order_code)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':vnp_amount' => $vnp_amount,
      ':vnp_bankcode' => $vnp_bankcode,
      ':vnp_banktranno' => $vnp_banktranno,
      ':vnp_cardtype' => $vnp_cardtype,
      ':vnp_orderinfo' => $vnp_orderinfo,
      ':vnp_paydate' => $vnp_paydate,
      ':vnp_responsecode' => $vnp_responsecode,
      ':vnp_tmncode' => $vnp_tmncode,
      ':vnp_transactionno' => $vnp_transactionno,
      ':order_code' => $order_code
    ));
    // Commit giao dịch
    $pdo->commit();
    echo '<script>alert("Đặt hàng thành công!"); window.location.href="index.php";</script>';
  } catch (Exception $e) {
    
    $pdo->rollBack();
    echo 'Giao dịch thất bại!';
  }
} else {
  echo '<script>alert("Thanh toán không thành công!"); window.location.href="checkout.php";</script>';
}
?>

<?php
unset($_SESSION['order_code']);
unset($_SESSION["name"]);
unset($_SESSION["address"]);
unset($_SESSION["country"]);
unset($_SESSION["zipcode"]);

?>
<?php require_once 'inc/footer.php'; ?>
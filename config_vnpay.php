<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_TmnCode = "FMT9941N"; 
$vnp_HashSecret = "JMOHGFIEICSEJMGAWQGXQIZNWSLJCPTN"; 
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

$vnp_Returnurl = "http://localhost/duan1/thankyou.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

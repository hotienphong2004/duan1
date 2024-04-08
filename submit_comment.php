<?php
require_once 'functions/funtions_pdo.php';

if (isset($_POST['comment'], $_POST['comment_name'], $_POST['comment_product_id'])) {
    // Lấy dữ liệu từ biến POST
    $comment = $_POST['comment'];
    $comment_name = $_POST['comment_name'];
    $comment_date = date('Y-m-d H:i:s');
    $comment_product_id = $_POST['comment_product_id'];

    // Thay thế tên cơ sở dữ liệu, tên bảng và tên cột bằng tên thực của bạn
    $host = 'localhost';
    $dbname = 'ecommerce';
    $username = 'root';
    $password = '';

    try {
        // Kết nối đến cơ sở dữ liệu
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
        $query = "INSERT INTO comment (comment, comment_name, comment_date, comment_product_id) VALUES (:comment, :comment_name, :comment_date, :comment_product_id)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':comment', $comment);
        $statement->bindValue(':comment_name', $comment_name);
        $statement->bindValue(':comment_date', $comment_date);
        $statement->bindValue(':comment_product_id', $comment_product_id);
        $statement->execute();

        // Redirect đến trang chi tiết sản phẩm sau khi lưu trữ bình luận
        header("Location: product.php?p_id=$comment_product_id");

        exit();
    } catch (PDOException $e) {
        // Nếu có lỗi xảy ra, bạn có thể xử lý lỗi ở đây
        // Ví dụ: hiển thị thông báo lỗi hoặc ghi log lỗi
        echo '<script>alert("Lỗi bình luận!"); window.location.href="product.php?p_id=$comment_product_id";</script>';
        exit();
    }
} else {
    // Nếu có lỗi trong quá trình nhận dữ liệu từ form, redirect về trang chi tiết sản phẩm và hiển thị thông báo lỗi
    $product_id = $_POST['comment_product_id'];
    echo '<script>alert("Lỗi bình luận!"); window.location.href="product.php?$product_id";</script>';

    exit();
}

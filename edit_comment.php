<?php
// Lấy dữ liệu từ biến GET hoặc POST
$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
$buttonName = isset($_POST['button_name']) ? $_POST['button_name'] : null;
$comment = $_POST['comment'];
$comment_product_id = isset($_POST['comment_product_id']) ? $_POST['comment_product_id'] : null;

$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
// Kiểm tra nút mà người dùng đã click

if ($comment_id != null && $buttonName != null && $comment != null) {
    if ($buttonName == 'btn_edit') {
        // Cập nhật bình luận
        // Thực hiện truy vấn SQL để cập nhật bình luận với ID đã cho
        $query = "UPDATE comment SET comment = :comment WHERE comment_id = :comment_id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':comment', $comment);
        $statement->bindValue(':comment_id', $comment_id);
        $statement->execute();

        // Chuyển hướng người dùng đến trang chi tiết sản phẩm và hiển thị thông báo cập nhật thành công
        $product_id = isset($_POST['comment_product_id']) ? $_POST['comment_product_id'] : null;
        echo '<script>alert("Cập nhật thành công!"); window.location.href="product.php?p_id=' . $product_id . '";</script>';
        exit();
    } elseif ($buttonName == 'btn_delete') {
        // Xóa bình luận
        // Thực hiện truy vấn SQL để xóa bình luận với ID đã cho
        $query = "DELETE FROM comment WHERE comment_id = :comment_id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':comment_id', $comment_id);
        $statement->execute();

        // Chuyển hướng người dùng đến trang chi tiết sản phẩm và hiển thị thông báo xóa thành công
        $product_id = isset($_POST['comment_product_id']) ? $_POST['comment_product_id'] : null;
        echo '<script>alert("Xóa bình luận thành công!"); window.location.href="product.php?p_id=' . $product_id . '";</script>';

        exit();
    }
} else {
    echo '<script>alert("Lỗi cập nhật bình luận!"); window.location.href="product.php?p_id=' . $comment_product_id . '";</script>';
}

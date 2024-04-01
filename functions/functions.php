<?php
require_once 'db.php';

// display categories
function display_cat()
{
    global $con;
    $query = "select * from categories where status = 1";
    return $result = mysqli_query($con, $query);
}

// get products
function get_products($cat_id = '', $product_id = '')
{
    global $con;
    $query = "select * from products where status = 1 order by p_id desc";
    if ($cat_id != '') {
        $query = "select * from products where category_name = '$cat_id'";
    }

    if ($product_id != '') {
        $query = "select * from products where p_id = '$product_id' and status = 1";
    }
    return $result = mysqli_query($con, $query);
}

// display cat links
function display_cat_links($category_id = '')
{
    global $con;


    $query = "SELECT products.p_id, products.category_name, categories.cat_name 
              FROM products 
              INNER JOIN categories ON products.category_name = categories.id 
              where products.category_name = '$category_id'";

    return mysqli_query($con, $query);
}

// get safe value
function safe_value($con, $value)
{
    return mysqli_real_escape_string($con, $value);
}

// Add to cart fun
function add_cart($pid, $qty)
{
    $_SESSION['CART'][$pid]['QTY'] = $qty;
}


// total cart value
function total_cart_value()
{
    if (isset($_SESSION['CART'])) {
        return count($_SESSION['CART']);
    } else {
        return 0;
    }
}

// get all products
function get_all_products()
{
    global $con;
    $query = "select * from products where status = 1 order by p_id desc";
    return $result = mysqli_query($con, $query);
}


// get related products
function get_related_products($cat_id)
{
    global $con;
    $query = "select * from products where status = 1 and category_name = '$cat_id' order by p_id desc";
    return $result = mysqli_query($con, $query);
}

///////////////////// cart /////////////////////////

function insert_giohang($data_cart)
{
    global $con;

    if (
        isset($data_cart['product_id']) &&
        isset($data_cart['product_title']) &&
        isset($data_cart['product_price']) &&
        isset($data_cart['product_image']) &&
        isset($data_cart['product_quantity']) &&
        isset($data_cart['customer_id'])
    ) {
        $product_id = $data_cart['product_id'];
        $product_title = $data_cart['product_title'];
        $product_price = $data_cart['product_price'];
        $product_image = $data_cart['product_image'];
        $product_quantity = $data_cart['product_quantity'];
        $customer_id = $data_cart['customer_id'];

        // Chuẩn bị câu lệnh SQL và thực thi
        $sql = "INSERT INTO `cart` (product_id, product_title, product_price, product_image, product_quantity, customer_id) 
                VALUES ('$product_id', '$product_title', '$product_price', '$product_image', '$product_quantity', '$customer_id')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Lỗi: " . mysqli_error($con);
        }
    } else {
        echo "Lỗi: Dữ liệu không đủ.";
    }
}


function update_quantity_soluong_giohang($product_id, $customer_id)
{
    global $con;
    $sql = "UPDATE `cart`
        SET product_quantity = product_quantity + 1
        WHERE product_id = $product_id AND customer_id = $customer_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Lỗi: " . mysqli_error($con);
    }
}

function delete_sanpham_giohang($product_id, $customer_id)
{
    global $con;

    $sql = "DELETE FROM `cart`
        WHERE product_id = $product_id AND customer_id = $customer_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Lỗi: " . mysqli_error($con);
    }
}

function delete_giohang($customer_id)
{
    global $con;

    $sql = "DELETE FROM `cart`
        WHERE customer_id = $customer_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Lỗi: " . mysqli_error($con);
    }
}

function thaydoisoluong_sanpham_giohang($product_id, $customer_id, $qty)
{
    global $con;
    $sql = "UPDATE `cart`
        SET product_quantity = $qty;
        WHERE product_id = $product_id AND customer_id = $customer_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Lỗi: " . mysqli_error($con);
    }
}

function show_giohang($customer_id)
{
    global $con;

    $sql = "SELECT * FROM cart WHERE customer_id = $customer_id";
    $listAll = mysqli_query($con, $sql);
    return $listAll;
}

////////////////// order ////////////////////////

function insert_donhang($data_order)
{


    global $con;

    if (
        isset($data_order['order_status']) && isset($data_order['order_code']) &&
        isset($data_order['order_date'])
    ) {
        $order_status = $data_order['order_status'];
        $order_code = $data_order['order_code'];
        $order_date = $data_order['order_date'];
        $customer_id = $data_order['customer_id'];

        $sql = "INSERT INTO `order` (order_code, order_date, order_status, customer_id) 
        VALUES ('$order_code', '$order_date', '$order_status', '$customer_id')";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo "Lỗi: " . mysqli_error($con);
        }
    } else {
        echo "Lỗi: Dữ liệu không đủ.";
    }
}

function insert_chitiet_donhang($data_order_detail)
{
    global $con;
    if (isset($data_order_detail['order_code']) &&
        isset($data_order_detail['product_id']) &&
        isset($data_order_detail['product_quantity']) &&
        isset($data_order_detail['product_price']) &&
        isset($data_order_detail['name']) &&
        isset($data_order_detail['address']) &&
        isset($data_order_detail['country']) &&
        isset($data_order_detail['zipcode']) &&
        isset($data_order_detail['phone']) &&
        isset($data_order_detail['fee_shipping'])
    ) {
        $order_code = $data_order_detail['order_code'];
        $product_id = $data_order_detail['product_id'];
        $product_quantity = $data_order_detail['product_quantity'];
        $product_price = $data_order_detail['product_price'];
        $name = $data_order_detail['name'];
        $address = $data_order_detail['address'];
        $country = $data_order_detail['country'];
        $phone = $data_order_detail['phone'];
        $zipcode = $data_order_detail['zipcode'];
        $fee_shipping = $data_order_detail['fee_shipping'];

        // Assuming you have a database connection ($pdo), you can use prepared statements
        $sql = "INSERT INTO order_detail (order_code, product_id, product_quantity, name, address, country, phone, zipcode, fee_shipping, product_price)
                VALUES ('$order_code', '$product_id', '$product_quantity','$name', '$address', '$country', '$phone', '$zipcode', '$fee_shipping', '$product_price')";

        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo "Lỗi: " . mysqli_error($con);
        }else{
            echo '<script>alert("Đặt hàng thành công!"); window.location.href="index.php";</script>';

        }
    } else {
        echo "Lỗi: Dữ liệu không đủ."; 
    }
}

function tatca_donhang($customer_id)
{
    global $con;
    $sql = "SELECT * FROM `order` WHERE customer_id = $customer_id";
    $listAll = mysqli_query($con, $sql);
    if (!$listAll) {
        echo "Lỗi: " . mysqli_error($con);
    }
    return $listAll;
}

function xem_chitiet_donhang($order_code)
{
    global $con;

    $sql = " SELECT order_detail.*, products.*
    FROM order_detail
    JOIN products ON order_detail.product_id = products.p_id
    WHERE order_detail.order_code = $order_code;
    ";
    $listAll = mysqli_query($con, $sql);

    if (!$listAll) {
        echo "Lỗi: " . mysqli_error($con);
    }
    return $listAll;
}

////////////// search product by name /////////////////
function search_product($keyword){
    global $con;
    $sql = "SELECT * FROM `products` WHERE product_name like '%$keyword%' and status = 1";
    $result = mysqli_query($con, $sql);
    return $result;
}

////////////// display value cart ////////////////////
function total_cart_num()
{
    if (isset($_SESSION['shopping_cart'])) {
        return count($_SESSION['shopping_cart']);
    } else {
        return 0;
    }
}
?>
<?php

// Set Session Message
function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['MESSAGE'] = $msg;
    } else {
        $msg = "";
    }
}


// Display Message
function display_message()
{
    if (isset($_SESSION['MESSAGE'])) {
        echo $_SESSION['MESSAGE'];
        unset($_SESSION['MESSAGE']);
    }
}

// Error Message
function display_error($error)
{
    return "<p class='alert alert-danger text-center'>$error</p>";
}


// $error = display_error("Please Fill in the Blank");

// set_message(display_error("Please Fill in the Blank"));

// Sucess Message
function display_success($success)
{
    return "<p class='alert alert-success text-center'>$success</p>";
}

// get safe value
function safe_value($con, $value)
{
    return mysqli_real_escape_string($con, $value);
}

// login checking

function login_system()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bth_login'])) {
        global $con;
        $username = safe_value($con, $_POST['username']);
        $password = safe_value($con, $_POST['password']);
        // echo $username." ".$password;
        if (empty($username) || empty($password)) {
            set_message(display_error("Please Fill in the Blanks"));
        } else {
            // query
            // $query = "select * from users where username='$username' or email='$username' and password = '$password'";
            $query = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
            $result = mysqli_query($con, $query);
            $userData = mysqli_fetch_assoc($result);
            if ($userData) {
                $_SESSION['ADMIN'] = $userData['username'];
                $_SESSION['ADMIN_ROLE'] = $userData['role'];
                $_SESSION['ADMIN_ID'] = $userData['id'];
                header("location: ./dashboard.php");
            } else {
                set_message(display_error("You Have Entered Wrong Password or UserName"));
            }
        }
    }
}



// login checking
function signup_system()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_signup'])) {

        global $con;
        $username = safe_value($con, $_POST['username']);
        $email = safe_value($con, $_POST['email']);
        $password = safe_value($con, $_POST['password']);
        $cpassword = safe_value($con, $_POST['cpassword']);

        // echo $username." ".$password;

        if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
            set_message(display_error("Please Fill in the Blanks"));
        } elseif ($password != $cpassword) {
            set_message(display_error("Password Not Matched"));
        } else {
            $query = "select * from users where email='$email'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result)) {
                set_message(display_error("Email Already Exits"));
            } else {
                $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '2')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    set_message(display_success("You have successfully Registed"));
                }
            }
        }
    }
}



// add category function
function add_category()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_btn'])) {
        // echo "Working";
        global $con;
        $category = safe_value($con, $_POST['category']);

        if (empty($category)) {
            set_message(display_error("Please Enter Category Name"));
        } else {
            $sql = "select * from categories where cat_name='$category'";
            $check = mysqli_query($con, $sql);
            if (mysqli_fetch_assoc($check)) {
                set_message(display_success(" Category Already Exists "));
            } else {
                $query = "insert into categories(cat_name, status) values('$category', '1')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    set_message(display_success(" Category Has Been Saved in the Database "));
                    echo "<a href='manage_category.php'>View Category</a>";
                }
            }
        }
    }
}


// view category
function view_cat()
{
    global $con;
    $sql = "select * from categories";
    return mysqli_query($con, $sql);
}

// Active & Deactive
function active_status()
{
    global $con;

    if (isset($_GET['opr']) && $_GET['opr'] != "") {
        $operation = safe_value($con, $_GET['opr']);
        $id = safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        if($_SESSION['ADMIN_ROLE'] != 1){
            header("location: manage_category.php");
        }else{
            $query = "update categories set status='$status' where id = '$id'";
            $result = mysqli_query($con, $query);
    
            if ($result) {
                header("location: manage_category.php");
            }
        }
    }
}


// update category
function update_cat()
{
    global $con;
    if (isset($_POST['cat_btn_up'])) {
        $category_name = safe_value($con, $_POST['category_up']);
        $id = safe_value($con, $_POST['cat_id']);
        if (!empty($category_name)) {

            $sql = "update categories set cat_name='$category_name' where id='$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("location: manage_category.php");
            }
        }
    }
}

// --------------------------------------- Product page --------------------------------------
function save_products()
{
    global $con;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn'])) {

        $cat_id = safe_value($con, $_POST['cat_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $mrp = null;
        $price = safe_value($con, $_POST['price']);
        $qty = safe_value($con, $_POST['qty']);
        $desc = safe_value($con, $_POST['desc']);

        // var_dump($_FILES['img']);

        $img = $_FILES['img']['name'];
        // var_dump($img);
        $type = $_FILES['img']['type'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $size = $_FILES['img']['size'];

        $img_ext = explode('.', $img);
        $img_correct_ext = strtolower(end($img_ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/" . $img;

        if (empty($product_name) || empty($price) || empty($qty) || empty($desc) || empty($img)) {
            set_message(display_error(" Please Fill in the Blanks "));
        } else {
            if (in_array($img_correct_ext, $allow)) {
                if ($size < 500000) {
                    if ($cat_id == null) {
                        set_message(display_error(" Please Select Category "));
                    } else {
                        $exit = "select * from products where product_name = '$product_name'";
                        $sql  = mysqli_query($con, $exit);
                        if (mysqli_fetch_assoc($sql)) {
                            set_message(display_error(" Product Already Exits "));
                        } else {
                            $query = "insert into products (category_name, product_name, MRP, price, qty, img, description, status) values('$cat_id', '$product_name', '$mrp', '$price', '$qty', '$img', '$desc', '1')";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                set_message(display_success(" Product Has Been Saved in the Database "));
                                move_uploaded_file($tmp_name, $path);
                            }
                        }
                    }
                } else {
                    set_message(display_error("Your Image Size Too Large"));
                }
            } else {
                set_message(display_error("You Can't Store this file"));
            }
        }
    }
}


// view products
function view_product()
{
    global $con;
    $query = "SELECT products.p_id, categories.cat_name, products.product_name, products.MRP, products.price, products.qty, products.img, products.description, products.status FROM products INNER JOIN categories ON products.category_name = categories.id";

    return $result = mysqli_query($con, $query);
}


//Status Active & Deactive Product
function active_status_product()
{
    global $con;
    if (isset($_GET['opr']) && $_GET['opr'] != "") {
        $operation = safe_value($con, $_GET['opr']);
        $id = safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        if($_SESSION['ADMIN_ROLE'] != 1){
            header("location: dashboard.php");
        }else{
            $query = "update products set status='$status' where p_id = '$id'";
            $result = mysqli_query($con, $query);
    
            if ($result) {
                header("location: manage_product.php");
            }
        }
    }
}

// edit product function
function edit_record()
{
    global $con;
    if (isset($_GET['id'])) {
        $edit_id = safe_value($con, $_GET['id']);
        $sql = "select * from products where p_id = '$edit_id'";
        $res = mysqli_query($con, $sql);
        return $res;
    }
}

// update record
function update_record()
{
    global $con;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn_edit'])) {

        $cat_id = safe_value($con, $_POST['cat_id']);
        $product_id = safe_value($con, $_POST['product_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $mrp = null;
        $price = safe_value($con, $_POST['price']);
        $qty = safe_value($con, $_POST['qty']);
        $desc = safe_value($con, $_POST['desc']);


        $img = $_FILES['img']['name'];
        $type = $_FILES['img']['type'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $size = $_FILES['img']['size'];

        $img_ext = explode('.', $img);
        $img_correct_ext = strtolower(end($img_ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/" . $img;

        if (empty($product_name) || empty($price) || empty($qty) || empty($desc)) {
            set_message(display_error(" Please Fill in the Blanks "));
        } else {
            if (empty($img)) {
                if ($cat_id == null) {
                    set_message(display_error(" Please Select Category "));
                } else {
                    $query = "update products set category_name='$cat_id', product_name='$product_name', MRP ='$mrp', price='$price', qty='$qty', description='$desc' where p_id = '$product_id'";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        set_message(display_success(" Record Has Been Updated "));
                        move_uploaded_file($tmp_name, $path);
                    }
                }
            } else {
                if ($size < 500000) {
                    if (in_array($img_correct_ext, $allow)) {
                        $query = "update products set category_name='$cat_id', product_name='$product_name', MRP ='$mrp', price='$price', qty='$qty', img='$img', description='$desc' where p_id = '$product_id'";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            set_message(display_success(" Record Has Been Updated "));
                            move_uploaded_file($tmp_name, $path);
                        }
                    } else {
                        set_message(display_error("You Can't Store this file"));
                    }
                } else {
                    set_message(display_error("Your Image Size Too Large"));
                }
            }
        }
    }
}

/////////////////////////////// Contact ///////////////////////////////
function contact()
{
    global $con;
    $sql = "select * from contact";
    $query = mysqli_query($con, $sql);
    return $query;
}


///////////////////////////// Order Master //////////////////////////////
function tatca_donhang()
{
    global $con;
    $sql = "SELECT * FROM `order`";
    $listAll = mysqli_query($con, $sql);
    if (!$listAll) {
        echo "Lỗi: " . mysqli_error($con);
    }
    return $listAll;
}

function xem_chitiet_donhang_admin($order_code)
{
    global $con;
    $sql = "SELECT `order`.*, products.*, order_detail.*, user_registers.* ,order_detail.name AS name_shipping, user_registers.name AS user_name, products.product_name AS p_name
    FROM order_detail
    JOIN products ON order_detail.product_id = products.p_id
    JOIN `order` ON order_detail.order_code = `order`.order_code
    JOIN user_registers ON `order`.customer_id = user_registers.id
    WHERE order_detail.order_code = '$order_code'";
    $listAll = mysqli_query($con, $sql);
    if (!$listAll) {
        echo "Lỗi: " . mysqli_error($con);
    }
    return $listAll;
}

//////////////// user /////////////////////
// view category
function view_user()
{
    global $con;
    $sql = "select * from users";
    return mysqli_query($con, $sql);
}


///////////// role //////////////////////
function check_role($user_id)
{
    global $con;
    $sql = "SELECT role FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        // Log the error or print it for debugging
        echo 'MySQL Error: ' . mysqli_error($con);
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return isset($row['role']) && $row['role'] == 1;
    }

    return false;
}


function total_order() {
    global $con;
    $sql = "SELECT COUNT(*) AS total_orders FROM `order`";

    $query = mysqli_query($con, $sql);

    if ($query) {
        $result = mysqli_fetch_assoc($query);
        return isset($result['total_orders']) ? $result['total_orders'] : 0;
    } else {
        return 0;
    }
}

function total_order_amount() {
    global $con;

    $sql = "SELECT SUM(od.product_price * od.product_quantity) AS total_amount
            FROM order_detail od
            INNER JOIN `order` o ON od.order_code = o.order_code
            WHERE o.order_status = 2";

    $query = mysqli_query($con, $sql);

    if ($query) {
        $result = mysqli_fetch_assoc($query);
        return isset($result['total_amount']) ? $result['total_amount'] : 0;
    } else {
        return 0;
    }
}

function total_orders_with_status_1() {
    global $con;

    $sql = "SELECT COUNT(*) AS total_orders
            FROM `order`
            WHERE order_status = 1";

    $query = mysqli_query($con, $sql);

    if ($query) {
        $result = mysqli_fetch_assoc($query);
        return isset($result['total_orders']) ? $result['total_orders'] : 0;
    } else {
        return 0;
    }
}


?>
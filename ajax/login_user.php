<?php
session_start();
require_once '../functions/db.php';
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = safe_value($con, $_POST['Email']);
    $password = safe_value($con, $_POST['Password']);
    $query = "select * from user_registers where email='$email'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $desh = password_verify($password, $row['password']);
        if ($desh == false) {
            echo 'Invalid';
        }
        if ($desh == true) {
            echo 'Valid';
            $_SESSION['EMAIL_USER_LOGIN'] = $row['email'];
            $_SESSION['USERNAME_USER_LOGIN'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
        }
    } else {
        echo 'Invalid';
    }
}

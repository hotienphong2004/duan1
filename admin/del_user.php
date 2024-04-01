<?php
require_once 'inc/header.php'; 
?>

<?php
if (!isset($_SESSION['ADMIN']) || !isset($_GET['id'])) {
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}

if (isset($_GET['id'])) {
    $del_id = $_GET['id'];
    if($_SESSION['ADMIN_ID'] == $del_id){
        echo '<script>alert("Active accounts cannot be deleted!"); window.location.href="user_list.php";</script>';
    }else{
        $query = "delete from users where id = '$del_id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo '<script>alert("Deleted successfully!"); window.location.href="user_list.php";</script>';
        }
    }
}
?>
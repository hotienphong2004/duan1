<?php
require_once 'inc/header.php'; 
?>

<?php
if(!isset($_SESSION['ADMIN']) || !isset($_GET['id'])){
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}

if(isset($_GET['id'])){
    $del_id = $_GET['id'];

    if ($_SESSION['ADMIN_ROLE'] == 1) {
        $query = "delete from products where p_id = '$del_id'";
        $result = mysqli_query($con, $query);
    
        if($result){
            header("location: manage_product.php");
        }
    } else {
        header("location: dashboard.php");
    } 
}

?>
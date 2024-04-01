<?php
require_once 'inc/header.php'; 

?>


<?php
if(!isset($_SESSION['ADMIN']) || !isset($_GET['id'])){
    header("location: index.php");
}

if(isset($_GET['id'])){
    echo 'hi';
    $del_id = $_GET['id'];

    if ($_SESSION['ADMIN_ROLE'] == 1) {
        $query = "delete from categories where id = '$del_id'";
        $result = mysqli_query($con, $query);
    
        if($result){
            header("location: manage_category.php");
        }
    } else {
        header("location: dashboard.php");
    }
}

?>
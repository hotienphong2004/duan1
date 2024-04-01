<?php
if(!isset($_SESSION['ADMIN'])){
    header("location: index.php");
}
?>

<?php

session_start();
unset($_SESSION['ADMIN']);
unset($_SESSION['ADMIN_ROLE']);
unset($_SESSION['ADMIN_ID']);

header("location: index.php");
exit();

?>
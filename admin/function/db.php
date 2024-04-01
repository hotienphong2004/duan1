<?php
    $con = mysqli_connect("localhost", "root", "", "ecommerce");

    if(!$con){
        echo 'Connection Failed';
        exit();
    }

?>
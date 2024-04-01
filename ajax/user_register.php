<?php
    require_once '../functions/db.php';
    require_once '../functions/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = safe_value($con, $_POST['Name']);
        $email = safe_value($con, $_POST['Email']);
        $password = safe_value($con, $_POST['Password']);
        
        $query = "select * from user_registers where email='$email'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result)){
            echo 'Email Already Exits ';
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user_registers (name, email, password) VALUES ('$name', '$email', '$hash')";
            $result = mysqli_query($con, $query);
        
            if ($result) {
                echo " You have successfully Registed <a href='login.php'>Login</a>";
            }
        }
    
        
    }
?>
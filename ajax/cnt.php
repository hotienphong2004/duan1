<?php
    require_once '../functions/db.php';
    require_once '../functions/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = safe_value($con, $_POST['Name']);
        $email = safe_value($con, $_POST['Email']);
        $subject = safe_value($con, $_POST['Subject']);
        $msg = safe_value($con, $_POST['Msg']);
    
        $query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$msg')";
        $result = mysqli_query($con, $query);
    
        if ($result) {
            echo "Thank For Contact Me.";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
?>
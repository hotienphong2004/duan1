
<?php
require_once 'inc/header.php';
?>

<?php
if (!isset($_SESSION['ADMIN'])) {
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}
?>

<?php require_once 'inc/nav.php'; ?>

<?php
if (isset($_POST['assign_role_btn_up'])) {

    $adminEmail = isset($_POST['admin_email']) ? $_POST['admin_email'] : 'a';
    $adminId = isset($_POST['admin_id']) ? $_POST['admin_id'] : 'a';
    $adminRole = isset($_POST['role_' . $adminId]) ? $_POST['role_' . $adminId] : 'a';

    // echo 'Admin Email: ' . $adminEmail . '<br>';
    // echo 'Admin ID: ' . $adminId . '<br>';
    // echo 'Admin Role: ' . $adminRole . '<br>';

    // var_dump($adminEmail);

    if ($_SESSION['ADMIN_ID'] == $adminId) {
        set_message(display_error("Permissions cannot be assigned to an active account!"));
        // echo '<script>alert("Permissions cannot be assigned to an active account!");</script>';
    } else {
        $sql = "UPDATE users SET role = '$adminRole' WHERE id = '$adminId'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            set_message(display_success("Permission assigned successfully!"));

            // echo '<script>alert("Permission assigned successfully!");</script>';
        } else {
        set_message(display_error("Error updating role!"));
            // echo '<script>alert("Error updating role!");</script>';
        }
    }

    header("location: user_list.php");
}






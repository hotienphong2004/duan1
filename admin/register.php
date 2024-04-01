<?php
require_once('inc/header.php');
if (isset($_SESSION['ADMIN'])) {
    echo '<script>alert("Vui lòng đăng xuất trước khi đăng ký tài khoản mới!");</script>';
    // header("location: dashboard.php");
    echo '<script>window.location.href = "dashboard.php";</script>';
    exit();
}
?>

<div style="margin-top: 40px;"></div>

<body class="row">
    <div class="col-lg-4 m-auto">
        <!-- <div class="brand">
            <a class="link" href="index.html">AdminCAST</a>
        </div> -->
        <form id="register-form" action="" method="post">
            <h2 class="login-title">Sign Up</h2>
            <?php
            signup_system();
            display_message();
            ?>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="User Name" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password">
            </div>
            <!-- <div class="form-group text-left">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox" name="agree">
                    <span class="input-span"></span>I agree the terms and policy</label>
            </div> -->
            <div class="form-group">
                <button class="btn btn-info btn-block" name="btn_signup" type="submit">Sign up</button>
            </div>
            <!-- <div class="social-auth-hr">
                <span>Or Sign up with</span>
            </div>
            <div class="text-center social-auth m-b-20">
                <a class="btn btn-social-icon btn-twitter m-r-5" href="javascript:;"><i class="fa fa-twitter"></i></a>
                <a class="btn btn-social-icon btn-facebook m-r-5" href="javascript:;"><i class="fa fa-facebook"></i></a>
                <a class="btn btn-social-icon btn-google m-r-5" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                <a class="btn btn-social-icon btn-linkedin m-r-5" href="javascript:;"><i class="fa fa-linkedin"></i></a>
                <a class="btn btn-social-icon btn-vk" href="javascript:;"><i class="fa fa-vk"></i></a>
            </div> -->
            <div class="text-center">Already a member?
                <a class="color-blue" href="index.php">Login here</a>
            </div>
        </form>
    </div>


    <?php require_once('inc/footer.php'); ?>
<?php 
require_once('inc/header.php'); 

if(isset($_SESSION['ADMIN'])){
    header("location: dashboard.php");
}
?>


<div style="margin-top: 40px;"></div>
<div class="row">
    <div class="col-lg-4 m-auto">


        <form id="login-form" action="" method="post">
            <h2 class="login-title">Log in</h2>
            <?php 
                login_system();
                display_message(); 
            ?>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="username" placeholder="User Name or Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit" name="bth_login">Login</button>
            </div>
        </form>
    </div>
</div>

<div class="text-center">Not a member?
    <a class="color-blue" href="register.php">Create account</a>
</div>


<?php require_once('inc/footer.php'); ?>
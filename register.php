

<?php require_once 'inc/header.php'; ?>
<!-- Navigation -->
<?php require_once 'inc/nav.php'; ?>

<?php

if(isset($_SESSION['EMAIL_USER_LOGIN'])){
	echo '<script>alert("Vui lòng đăng xuất trước khi đăng ký tài khoản mới!");</script>'; 
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Register</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="register.php">Register</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info mx-auto">
					<h2 class="mb-3">Registeration</h2>

                    <div id="error"></div>
					<div id="success"></div>
					<form class="contact-form" method="post">
						<input type="text" placeholder="Your name" id="name">
						<input type="text" placeholder="Your e-mail" id="email">
						
						<input type="password" placeholder="Password" id="password">
						
                        <input type="password" placeholder="Confirm Password" id="cpassword">


						<button type="button" class="site-btn mb-3" id="btn_register" >SEND NOW</button>
					</form>
				</div>
			</div>
		</div>
        <div style="margin-bottom: 20px;"></div>
	</section>
	<!-- Contact section end -->



	<?php require_once 'inc/footer.php'; ?>

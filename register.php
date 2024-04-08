

<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/nav.php'; ?>

<?php

if(isset($_SESSION['EMAIL_USER_LOGIN'])){
	echo '<script>alert("Vui lòng đăng xuất trước khi đăng ký tài khoản mới!");</script>'; 
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>
	
	<div class="page-top-info">
		<div class="container">
			<h4>Đăng ký</h4>
			<div class="site-pagination">
				<a href="index.php">Trang Chủ</a> /
				<a href="register.php">Đăng ký</a>
			</div>
		</div>
	</div>
	
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info mx-auto">
					<h2 class="mb-3">Đăng Kí Tài Khoản</h2>

                    <div id="error"></div>
					<div id="success"></div>
					<form class="contact-form" method="post">
						<input type="text" placeholder="Your name" id="name">
						<input type="text" placeholder="Your e-mail" id="email">
						
						<input type="password" placeholder="Password" id="password">
						
                        <input type="password" placeholder="Confirm Password" id="cpassword">


						<button type="button" class="site-btn mb-3" id="btn_register" >Gửi Ngay</button>
					</form>
				</div>
			</div>
		</div>
        <div style="margin-bottom: 20px;"></div>
	</section>
	



	<?php require_once 'inc/footer.php'; ?>

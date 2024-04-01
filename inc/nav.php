<?php
session_start();
require_once 'functions/functions.php';
$cat = display_cat();
$cart_value = total_cart_num();
?>


<!-- Page Preloder -->
<!-- <div id="preloder">
    <div class="loader"></div>
</div> -->

<!-- Header section -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="./index.php" class="site-logo">
                        <img src="assets/img/logo.png" style="width: 30%;" alt="">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <form class="header-search-form" action="search_page.php" method="get">
                        <input type="text" placeholder="Search on watch store ...." name="keyword">
                        <button type="submit"><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">
                        <div class="up-item">
                            <?php
                            if (isset($_SESSION['EMAIL_USER_LOGIN'])) {
                            ?>
                                <i class="flaticon-profile"></i>
                                <a href="#" id="userDropdownToggle">
                                    <?php

                                    $fullUsername = $_SESSION['USERNAME_USER_LOGIN'];
                                    $maxLength = 12;

                                    if (strlen($fullUsername) > $maxLength) {
                                        $shortenedUsername = substr($fullUsername, 0, $maxLength) . '...';
                                        echo $shortenedUsername;
                                    } else {
                                        echo $fullUsername;
                                    }
                                    // echo $_SESSION['USERNAME_USER_LOGIN']; 
                                    ?>

                                </a>
                                <div id="userDropdown" style="display: none;">
                                    <a href="logout.php">Logout</a>
                                </div>

                            <?php
                            } else {
                            ?>
                                <i class="flaticon-profile"></i>
                                <a href="login.php">Sign</a> In or <a href="register.php">Create Account</a>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="up-item">
                            <?php
                            if (isset($_SESSION['EMAIL_USER_LOGIN'])) {
                            ?>
                                <i class="flaticon-file"></i>
                                <a href="order_history.php" style="margin-right: 15px;">Order History</a>
                            <?php
                            } else {
                            ?>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                            </div>
                            <a href="cart.php">Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <!-- menu -->
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <?php
                while ($row = mysqli_fetch_assoc($cat)) {
                ?>
                    <li><a href="category.php?id=<?php echo $row['id']; ?>"><?php echo $row['cat_name'] ?></a></li>
                <?php
                }
                ?>
                <li><a href="contact.php">Contact</a></li>

            </ul>
        </div>
    </nav>
</header>
<!-- Header section end -->

<style>
    #userDropdown {
        position: absolute;
        top: 100%;
        left: 0;
        display: none;
        z-index: 1;
    }

    .up-item {
        position: relative;
        display: inline-block;
    }
</style>
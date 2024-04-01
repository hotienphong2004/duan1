<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="./assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">
                    <?php
                    if (isset($_SESSION['ADMIN'])) {
                    ?>
                        <?php echo $_SESSION['ADMIN']; ?>
                    <?php
                    } else {
                    ?>

                    <?php
                    }
                    ?>

                </div><small>Administrator</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="dashboard.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-list-alt"></i>
                    <span class="nav-label">Category</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <?php
                    if ($_SESSION['ADMIN_ROLE'] == 1) {
                    ?>
                        <li>
                            <a href="add_category.php">Add Category</a>
                        </li>
                    <?php
                    } else {
                    ?>

                    <?php
                    }

                    ?>

                    <li>
                        <a href="manage_category.php">Manage Category</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cart-arrow-down"></i>
                    <span class="nav-label">Product</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <?php
                    if ($_SESSION['ADMIN_ROLE'] == 1) {
                    ?>
                        <li>
                            <a href="add_product.php">Add Product</a>
                        </li>
                    <?php
                    } else {
                    ?>
                    <?php
                    }

                    ?>



                    <li>
                        <a href="manage_product.php">Manage Product</a>
                    </li>


                </ul>
            </li>

            <li>
                <a class="active" href="contact.php"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">Contact</span>
                </a>
            </li>


            <?php
            if ($_SESSION['ADMIN_ROLE'] == 1) {
            ?>
                <li>
                    <a class="active" href="order_master.php"><i class="sidebar-item-icon fa fa-file"></i>
                        <span class="nav-label">Order Master</span>
                    </a>
                </li>
            <?php
            } else {
            ?>
            <?php
            }
            ?>



            <?php
            if ($_SESSION['ADMIN_ROLE'] == 1) {
            ?>
                <li>
                    <a class="active" href="user_list.php"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">User List</span>
                    </a>
                </li>
            <?php
            } else {
            ?>
            <?php
            }
            ?>







            <!-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="#">Basic Forms</a>
                    </li>

                </ul>
            </li> -->

        </ul>
    </div>
</nav>


<header class="header">
    <div class="page-brand">
        <a class="link" href="index.html">
            <span class="brand">Admin
                <span class="brand-tip">CAST</span>
            </span>
            <span class="brand-mini">AC</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <!-- <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li>
                <form class="navbar-search" action="javascript:;">
                    <div class="rel">
                        <span class="search-icon"><i class="ti-search"></i></span>
                        <input class="form-control" placeholder="Search here...">
                    </div>
                </form>
            </li> -->
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">


            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="./assets/img/admin-avatar.png" />
                    <span></span>

                    <?php
                    if (isset($_SESSION['ADMIN'])) {
                    ?>
                        <?php echo $_SESSION['ADMIN']; ?>
                    <?php
                    } else {
                    ?>
                        Admin
                    <?php
                    }
                    ?>

                    <i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.order_details').change(function() {
            var order_id = $(this).children(":selected").attr("id");
            var order_status = $(this).val();
            var _token = $('input[name="_token"]').val();
            var qty = [];
            $("input[name='product_sales_quantity']").each(function() {
                qty.push($(this).val());
            });
            var order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });

            // alert(order_id);
            // alert(order_status);
            // alert(order_product_id);
            // alert(qty);

            number = 0;
            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                //so luong khach dat
                number++;
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //so luong ton kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                // alert(order_qty);
                // alert(order_qty_storage);
                // console.log(order_qty);
                // console.log(order_qty_storage);

                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Sản phẩm thứ ' + number + ' - Số lượng trong kho không đủ!');
                        $('.color_qty_' + order_product_id[i]).css('background', '#000');
                    }
                }
            }
            if (j == 0) {
                $.ajax({
                    url: "update_order_quantity.php",
                    type: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        qty: qty,
                        order_product_id: order_product_id,
                    },
                    success: function(data) {
                        // console.log(data);
                        alert('Thay đổi tình trạng đơn hàng thành công!');
                        location.reload();

                        // if (data === "Success") {
                        //     alert('Thay đổi tình trạng đơn hàng thành công!');
                        //     location.reload();
                        // } else {
                        //     alert('Có lỗi xảy ra khi xử lý đơn hàng.');
                        // }
                    }
                });
            }
        });
    });
</script>
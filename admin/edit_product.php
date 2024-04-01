<?php
require_once 'inc/header.php'; 
?>

<?php
if (!isset($_SESSION['ADMIN']) || !isset($_GET['id'])) {
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}

require_once 'inc/nav.php'; 
$cat = view_cat();
$edit_product = edit_record();

while($row = mysqli_fetch_assoc($edit_product)){
    $product_id = $row['p_id'];
    $categpry_id = $row['category_name'];
    $product_name = $row['product_name'];
    $mrp = $row['MRP'];
    $price = $row['price'];
    $qty = $row['qty'];
    $img = $row['img'];
    $description = $row['description'];
}
?>


<div class="content-wrapper">
    <!-- START PAGE CONTENT-->



    <div class="page-content fade-in-up">

        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Product</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">

                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Edit Product</label>

                    </div>
                    <?php 
                    update_record(); 
                    display_message();
                    ?>
                    <div class="form-group row">

                        <div class="col-sm-10">
                            <select name="cat_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                <?php
                                    while ($row = mysqli_fetch_assoc($cat)) {
                                        if ($categpry_id == $row['id']) {
                                           ?>
                                            <option selected value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                                           <?php
                                            
                                        } else {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="hidden" name="product_id" placeholder="Product Name" value="<?php echo $product_id ?>">
                            <input class="form-control" type="text" name="product_name" placeholder="Product Name" value="<?php echo $product_name ?>">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="mrp" placeholder="MRP" value="<?php echo $mrp ?>">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="price" placeholder="Price" value="<?php echo $price ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="qty" placeholder="Qty" value="<?php echo $qty ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="file" name="img" value="<?php echo $img ?>">
                            
                            <img src="img/<?php echo $img;?>" width="50px" height="50px" alt="" class="img-circle">

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <textarea name="desc" id="" cols="30" rows="10" class="form-control" placeholder="Product Description"><?php echo $description ?></textarea>
                        </div>
                    </div>

                    <button class="btn btn-info" type="submit" name="pro_btn_edit">Submit</button>

                   
                </form>
            </div>
        </div>
    </div>

                                    

    <!-- END PAGE CONTENT-->
    <!-- <footer class="page-footer">
        <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
        <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer> -->
</div>

<?php require_once 'inc/footer.php'; ?>
<?php
require_once 'inc/header.php'; 
?>

<?php
if(!isset($_SESSION['ADMIN']) || !isset($_GET['id'])){
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}

 
if(isset($_GET['id']) && $_GET['id']!= ""){
    $id = safe_value($con, $_GET['id']);
    $sql = "select * from categories where id='$id'";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $cat_name = $row['cat_name'];
        $status = $row['status'];
    }
    update_cat();
}

?>
<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
 
            <div class="page-content fade-in-up">
                
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Category</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">

                        <?php 
                            display_message(); 
                        ?>
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                            <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="category_up" value="<?php echo $cat_name; ?>">
                                    <input type="hidden" name="cat_id" value="<?php echo $id; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button class="btn btn-info" type="submit" name="cat_btn_up">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <!-- <footer class="page-footer">
                <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
                <a class="px-4"
                    href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589"
                    target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer> -->
        </div>

<?php require_once 'inc/footer.php'; ?>


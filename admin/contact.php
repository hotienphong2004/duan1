<?php 
require_once 'inc/header.php'; 
    $value = contact();
?>
<?php

if(!isset($_SESSION['ADMIN'])){
    header("location: index.php");
}
?>

<?php
if ($_SESSION['ADMIN_ROLE'] != 1) {
    header("location: dashboard.php");
}
?>


<?php require_once 'inc/nav.php'; ?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Manage Contact</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>

        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Contact</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Contact ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th colspan="4">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php

                            while($row = mysqli_fetch_assoc($value)){
                                
                                
                            ?>
                            <td><?php echo $row['contact_id']  ?></td>
                            <td><?php echo $row['name']  ?></td>
                            <td><?php echo $row['email']  ?></td>
                            <td><?php echo $row['subject']  ?></td>
                            <td><?php echo $row['message']  ?></td>
                            
                            <td>
                            <a href="del_contact.php?id=<?php echo $row['contact_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                            <?php
                            }
                            ?>

                    </tbody>
                </table>
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
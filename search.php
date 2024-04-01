<?php require_once './functions/db.php'; ?>
<?php require_once './functions/functions.php'; ?>
<?php

$keyword = !empty($_POST["keyword"]) ? $_POST["keyword"] : '';
$result_find = search_product($keyword);
header("location: search_page.php");
?>

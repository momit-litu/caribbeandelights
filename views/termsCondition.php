<?php
session_start();
include("../includes/dbConnect.php");
include("../includes/dbClass.php");
$dbClass = new dbClass;

if(!isset($_SESSION['customer_id']) && $_SESSION['customer_id']!=""){
ob_start(); header("Location:error.php"); exit();
}
//echo $_SESSION['customer_id']; die;
//var_dump($_SESSION);

$termCondition = $dbClass->getSingleRow("select * from web_menu where id=43");


?>

<section class="container">
    <?php echo $termCondition['description'];?>
</section>

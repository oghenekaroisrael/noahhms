<?php
session_start();
require_once("../inc/config.php");
include_once '../inc/db.php';
if(isset($_GET["q"]) AND isset($_GET['dispenser'])){
$q = tclean($_GET["q"]);
$dis = $_GET['dispenser'];
$select = "SELECT Stock_number,id,s_usage FROM pharm_stock WHERE Stock_number='$q' LIMIT 1";
$sales_id = $_SESSION['sale'];
if($read = mysqli_query($con,$select)){
	while ($row = mysqli_fetch_assoc($read)) {
		$drug = $row['id'];
		$barcode = $row['Stock_number'];
		$use = $row['s_usage'];
		$ins = "INSERT INTO `in_sales`(`sales_id`,`drug`, `s_usage`,`dispenser`,`date`) VALUES ($sales_id,$drug,$use,$dis,NOW())";
		$insert = mysqli_query($con,$ins);
		if ($insert) {
			echo "<td colspan='8'><div class='alert alert-success'>
				Stock Added To Sale
			</div></td>";
		}else{
			echo "<div class='alert alert-warning'>
				Stock Could Not Be Added To Sale
			</div>";
			unset($_SESSION['sale']);	
		}
	}
}else{
	echo "<div class='alert alert-danger'>
				Contact Green House Multimedia ::DB Error
			</div>";
	unset($_SESSION['sale']);
}
}else{
	header("Location: index.html");
	unset($_SESSION['sale']);
}
?>

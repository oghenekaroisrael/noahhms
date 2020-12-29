<?php 
include_once '../inc/db.php';
$db = mysqli_connect("localhost", "root", "", "noahhms");
$cash = $_POST['cash'];
$bank = $_POST['bank'];
$bank_used = $_POST['bank_used'];

$sql = mysqli_query($db, "UPDATE accounts SET cash = ".$cash.",bank = ".$bank.",payment_status = 1,bank_used = '".$bank_used."', amount = ".($cash+$bank).",date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND order_id LIKE '".$_GET['link']."'");
$sql2 = mysqli_query($db,"SELECT item FROM accounts WHERE patient_id = ".$_GET['pid']." AND order_id LIKE '".$_GET['link']."'");
$get_item = mysqli_fetch_assoc($sql2);
$itm = intval($get_item['item']);

	if ($sql) {
		header("Location: index.php?full_pay=paid");
		if ($itm == "3" || $itm == 3) {
			database::getInstance()->notify_lab2($_GET['pid']);
		}
		exit();
	}else{
		header("Location: index.php?full_pay=error");
		exit();
	}
 ?>
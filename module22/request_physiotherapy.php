<?php 
$db = mysqli_connect("localhost","root","","noahhms");
$pid=$_GET['pid'];
$staff = $_GET['staff'];
$check = mysqli_query($db, "SELECT id FROM patient_appointment WHERE patient_id = ".$pid."");
$get_check = mysqli_fetch_assoc($check);
if (mysqli_num_rows($get_check) >= 1) {
	$app = $get_check['id'];
}else{
	$app = 0;
}
$front_desk = $_GET['front'];
$link = uniqid();
$insert = mysqli_query($db, "INSERT INTO `physiotherapy_requests` (`patient_id`, `staff_id`, `link_ref`, `front_desk`, `patient_appointment_id`, `status`, `date_added`) VALUES (".$pid.",".$staff.",'".$link."','".$front_desk."',".$app.",0,NOW())");
if ($insert) {
	$card_get = mysqli_query($db,"SELECT * FROM `patients` WHERE `id` = ".$pid."");
	$card_type = mysqli_fetch_assoc($card_get);
	$type = $card_type['card_type'];
	$test = 7;
	$cost = 2500;

	//Charge
	$charger_query = mysqli_query($db,"INSERT INTO `accounts` (`front_desk`,`item`,`patient_id`, `card_type`, `app_id`, `to_pay`, `order_id`, `date_added`) 
		VALUES ('".$front_desk."',".$test.",".$pid.",".$type.",".$app.",".$cost.",'".$link."',NOW())");
	if ($charger_query) {
		header("location: patients?res=Done#anyres");
	}
}

?>
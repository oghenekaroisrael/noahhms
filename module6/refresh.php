<?php 
$db = mysqli_connect("localhost","root","","coastal");
$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = ".$_GET['id']." AND status = 0 ORDER BY id DESC");
$noti2 = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id= 'pharm' AND status = 0  ORDER BY id DESC");

if (mysqli_num_rows($noti) > 0){
	session_start();
	$here = mysqli_fetch_assoc($noti);
	$_SESSION['noti_show'] = 1;
	$_SESSION['noti_msg'] = $here['message'];
	$_SESSION['noti_pid'] = $here['patient_id'];
	$_SESSION['noti_msg'] = $here['message'];
	$_SESSION['noti_link'] = $here['link'];
	$_SESSION['noti_id'] = $here['id'];
}elseif (mysqli_num_rows($noti2) > 0) {
	session_start();
	$here2 = mysqli_fetch_assoc($noti2);
	$_SESSION['noti_show'] = 1;
	$_SESSION['noti_msg'] = $here2['message'];
	$_SESSION['noti_pid'] = $here2['patient_id'];
	$_SESSION['noti_msg'] = $here2['message'];
	$_SESSION['noti_link'] = $here2['link'];
	$_SESSION['noti_id'] = $here2['id'];
}
?>
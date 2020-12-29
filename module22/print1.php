<?php
session_start();
include_once '../inc/db.php';
unset($_SESSION['sale']);
$db = mysqli_connect('localhost','root','','noahhms');
$sql = mysqli_query($db, "SELECT name,address,phone,email FROM hospital_info WHERE id = 1");
$data = mysqli_fetch_assoc($sql);
$hospital_name = $data['name'];
$hospital_address = $data['address'];
$hospital_phone = $data['phone'];

$fname = $_GET['id'];
$cust = mysqli_query($db, "SELECT first_name, surname,title,middle_name FROM patients WHERE id = ".$fname."");
$cust2 = mysqli_fetch_assoc($cust);
$customer = $cust2['title']." ".$cust2['surname']." ".$cust2['middle_name']." ".$cust2['first_name'];

?>
<!DOCTYPE html>
<html>
<title>NOAH HMS Waiting List</title>
<head>
	<style type="text/css">
		h2{
			font-size: 25px;
			font-family: segoe ui;
			font-weight: 1000;
		}
		font,h4,td,th{
			font-size: 30px;
		}
		b,p{
			font-size: 20px;
		}
	</style>
</head>
<body  onload="window.print()">
<table width="100%">
	<tbody>
		<tr>
			<td colspan="3">
				<center>
					<h2><?php echo ucwords($hospital_name); ?></h2>
					<h2><?php echo ucwords($hospital_address); ?></h2>
					<h2><?php echo ucwords($hospital_phone); ?></h2>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<h4>DATE</h4>
					<?php echo date('Y-m-d'); ?>
				</center>
			</td>
			<td>
				<center>
					<h4>TIME</h4>
					<?php  echo date('h:iA')?>
				</center>
			</td>
		</tr>
	</tbody>
</table>
<div style="width: 100%;border-top: dashed 1px #000;border-bottom: dashed 1px #000;">
	<div style="padding:20px;margin-bottom: 20px;">
		<font style="float: left;">PATIENT'S NAME: </font>
	<font><?php echo $customer; ?></font>
				<br>
	</div>
</div>

<div style="width: 100%;border-top: dashed 1px #000;border-bottom: dashed 1px #000;">
	<div style="padding:20px;margin-bottom: 20px;">
		<font style="float: left;">APPOINTMENT NUMBER: </font>
	<font><?php echo $_GET['app']; ?></font>
				<br>
	</div>
</div>
<div>
	<center>
		<b>Thank you.Please Wait for your number to be called out.</b>
		<p>NOAH HMS Software By Horseman Technologies</p>
		<!--Developed By Ogehenkaro Brume Israel-->
	</center>
</div>
</body>
</html>
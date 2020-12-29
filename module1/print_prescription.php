<?php
session_start();
include_once '../inc/db.php';
$db = mysqli_connect('localhost','root','','noahhms');
$sql = mysqli_query($db, "SELECT name,address,phone,email FROM hospital_info WHERE id = 1");
$data = mysqli_fetch_assoc($sql);
$hospital_name = $data['name'];
$hospital_address = $data['address'];
$hospital_phone = $data['phone'];

$fname = database::getInstance()->get_name_from_id("patient_id","patient_appointment",'id',$_GET['ref']);
$name = "";

$cust = mysqli_query($db, "SELECT first_name, surname,title,middle_name FROM patients WHERE id = ".$fname."");
$cust2 = mysqli_fetch_assoc($cust);
$customer = $cust2['title']." ".$cust2['surname']." ".$cust2['middle_name']." ".$cust2['first_name'];
?>
<!DOCTYPE html>
<html>
<title>Print Reciept</title>
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
<body onload="window.print()">
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
		<font style="float: left;">Patient Name: </font>
	<font><?php 
					echo $customer; 
				?></font>
				<br>
				
	<table width="100%">
		<thead>
			<tr>
				<th><center>Drug Name</center></th>
				<th><center>Tab(s)</center></th>
				<th><center>Frequency</center></th>
				<th><center>Duration</center></th>
				<th><center>Instruction</center></th>

			</tr>
		</thead>
	<tbody>
		<?php 
			$presc =database::getInstance()->select_from_where("prescription","appointment_id",$_GET['ref']);
			foreach ($presc as $row) {
				if ($row['tabs'] > 0) {
					$tabs = $row['tabs'];
				}else if ($row['stabs'] > 0) {
					$tabs = $row['tabs'];
				}

				if ($row['dosage'] == 1) {
																																				$dosage = "DLY";
																																			}elseif ($row['dosage'] == 2) {
																																				$dosage = "B.D";
																																			}elseif ($row['dosage'] == 3) {
																																				$dosage = "T.D.S";
																																			}elseif ($row['dosage'] == 4) {
																																				$dosage = "Q.D.S";
																																			}elseif ($row['dosage'] == 5) {
																																				$dosage = "STAT";
																																			}elseif ($row['dosage'] == 6) {
																																				$dosage = "NOCT";
																																			}

																																			if ($row['sdosage'] == 1) {
																																				$sdosage = "DLY";
																																			}elseif ($row['sdosage'] == 2) {
																																				$sdosage = "B.D";
																																			}elseif ($row['sdosage'] == 3) {
																																				$sdosage = "T.D.S";
																																			}elseif ($row['sdosage'] == 4) {
																																				$sdosage = "Q.D.S";
																																			}elseif ($row['sdosage'] == 5) {
																																				$sdosage = "STAT";
																																			}elseif ($row['sdosage'] == 6) {
																																				$sdosage = "NOCT";
																																			}
																																			if ($dosage > 0) {
																																					$dos = $dosage;
																																			}else if ($sdosage > 0) {
																																					$dos = $sdosage;
																																			}

				if ($row['duration'] > 0) {
					$dur = $row['duration'];
				}else if ($row['sduration'] > 0) {
					$dur = $row['sduration'];
				}

				$ins = $row['instruction'];
			 	?>
			 		<tr>
						<td><center><?php echo database::getInstance()->get_name_from_id("name","pharm_stock","id",$row['pharm_stock_id']); ?></center></td>
						<td><center><?php echo $tabs; ?></center></td>
						<td><center><?php echo $dos; ?></center></td>
						<td><center><?php echo $dur; ?></center></td>
						<td><?php echo $ins; ?></td>
					</tr>
			 	<?php
			 } 
			?>	
	</tbody>
</table>
	</div>
</div>
<div>
	<center>
		<b>Thank you.Please come again.</b>
		<p>NOAH HMS Software By Horseman Technologies</p>
	</center>
</div>
</body>
</html>
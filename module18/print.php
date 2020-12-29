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

//var_dump($_POST['pri']);
foreach ($_POST['pri'] as $key) {
	$sales_id =database::getInstance()->get_name_from_id("order_id","accounts","id",$key);
}
$fname = $_GET['id'];
$name = "";
if (is_numeric($fname) && $fname != 0) {
	$cust = mysqli_query($db, "SELECT first_name, surname,title,middle_name FROM patients WHERE id = ".$fname."");
$cust2 = mysqli_fetch_assoc($cust);
$customer = $cust2['title']." ".$cust2['surname']." ".$cust2['middle_name']." ".$cust2['first_name'];

}else{
	$cust1 = mysqli_query($db, "SELECT full_name FROM in_sales WHERE sales_id LIKE '".$sales_id."'");
$cust3 = mysqli_fetch_assoc($cust1);
$customer = $cust3['full_name'];
}
 
$total = 0;

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
		<font style="float: left;">CUSTOMER NAME: </font>
	<font><?php 
				if (isset($_GET['pat'])) {
					echo $_GET['pat'];
				}else{
					echo $customer; 
				}
				?></font>
				<br>
				<font style="font-size: 14px;">BALANCE: <?php echo $_GET['balance']; ?></font>
				<br>
				<font style="font-size: 14px;">Cashier: <?php 

				$sql1 = database::getInstance()->select_from_where("staff","user_id",$_GET['cashier']);
				foreach ($sql1 as $keyValues) {
				 	echo $keyValues['last_name']." ".$keyValues['first_name'];
				 } ?></font>
	<table width="100%">
		<thead>
			<tr>
				<th><center>Description</center></th>
				<th><center>Quantity</center></th>
				<th><center>Amount</center></th>
			</tr>
		</thead>
	<tbody>
		<?php 
		foreach ($_POST['pri'] as $key) {
			$sell = mysqli_query($db,"SELECT * FROM accounts WHERE id = $key");
			$sales = mysqli_fetch_assoc($sell);
			$sales_id =database::getInstance()->get_name_from_id("order_id","accounts","id",$key);
				?>
							<?php 
								if ($sales['item'] == 3) {
											$dnam1 = mysqli_query($db,"SELECT description,quantity,amount FROM in_sales WHERE sales_id LIKE '".$sales_id."'");
										while ($dname1 = mysqli_fetch_assoc($dnam1)) {
								
											$dnam = mysqli_query($db,"SELECT name FROM pharm_stock WHERE id = ".$dname1['description']."");
											$dname = mysqli_fetch_assoc($dnam);
											?>
											<tr>
												<td><center>Drug</center></td>
												<td><center><?php echo $drug_qty += $dname1['quantity'];; ?></center></td>
												<td><center><?php echo $drug_total += $dname1['amount']; $total += $dname1['amount']; ?></center></td>
											</tr>
											<?php
										}
								}else if ($sales['item'] == 2) {
									$dnam1 = mysqli_query($db,"SELECT test_num FROM patient_test_group WHERE link_ref LIKE '".$sales_id."'");
									$dname1 = mysqli_fetch_assoc($dnam1);

									$dnam2 = mysqli_query($db,"SELECT lab_test_id FROM patient_test WHERE link_ref LIKE '".$sales_id."'");
									while ($dname2 = mysqli_fetch_assoc($dnam2)) {
										$dnam = mysqli_query($db,"SELECT lab_test,fee FROM lab_test WHERE lab_test_id = ".$dname2['lab_test_id']."");
										$dname = mysqli_fetch_assoc($dnam);
										?>
										<tr>
											<td>
												<center>
												Lab Test
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $dname['fee']; $total +=$dname['fee']; ?>
											</center>
										</td>
										</tr>
										<?php
									}
									
								}else if ($sales['item'] == 5) {
									$dnam = mysqli_query($db,"SELECT name,cost FROM card_types WHERE id = ".$sales['card_type']."");
									$dname = mysqli_fetch_assoc($dnam);
									?>
										<tr>
											<td>
												<center>
												<?php echo $dname['name'].",<br>";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $dname['cost']; $total +=$dname['cost']; ?>
											</center>
										</td>
										</tr>
										<?php
								}else if ($sales['item'] == 6) {
									$dnam1 = mysqli_query($db,"SELECT xray_num FROM patient_xray_group WHERE link_ref LIKE '".$sales_id."'");
									$dname1 = mysqli_fetch_assoc($dnam1);

									$dnam2 = mysqli_query($db,"SELECT name FROM xray_requests WHERE link LIKE '".$sales_id."'");
									while ($dname2 = mysqli_fetch_assoc($dnam2)) {
										$dnam = mysqli_query($db,"SELECT name,fee FROM xray WHERE id = ".$dname2['name']."");
										$dname = mysqli_fetch_assoc($dnam);
										?>
										<tr>
											<td>
												<center>
												Xray
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $dname['fee']; $total +=$dname['fee']; ?>
											</center>
										</td>
										</tr>
										<?php
									}
								}else if ($sales['item'] == 7) {
									?>
										<tr>
											<td>
												<center>
												<?php echo "Physiotherapy Session";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $sales['amount']; $total +=$sales['amount']; ?>
											</center>
										</td>
										</tr>
										<?php
								}else if ($sales['item'] == 8) {
									?>
										<tr>
											<td>
												<center>
												<?php echo "Consultation";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $sales['amount']; $total +=$sales['amount']; ?>
											</center>
										</td>
										</tr>
										<?php
								}else if ($sales['item'] == 9) {
									?>
										<tr>
											<td>
												<center>
												<?php echo "In Patient Bill";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $sales['amount']; $total +=$sales['amount']; ?>
											</center>
										</td>
										</tr>
										<?php
								}else if ($sales['item'] == 10) {
									?>
										<tr>
											<td>
												<center>
												<?php echo "HMO Bill";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $sales['amount']; $total +=$sales['amount']; ?>
											</center>
										</td>
										</tr>
										<?php
								}else if ($sales['item'] == 7) {
									?>
										<tr>
											<td>
												<center>
												<?php echo "Immunization Bill";?>
											</center>	
										</td>
										<td>
											<center>
												1
											</center>	
										</td>
										<td>
											<center>
												<?php echo $sales['amount']; $total +=$sales['amount']; ?>
											</center>
										</td>
										</tr>
										<?php
								}
							?>
				<?php
		}
		 ?>
		 <tr>
		 	<td colspan="2"></td>
		 	<td style="font-weight: bolder;font-family: "><center>Total: <?php echo $total; ?></center></td>
		 </tr>	
	</tbody>
</table>
	</div>
</div>
<div>
	<center>
		<b>Thank you.Please come again.</b>
		<p>Med Assistant Software By Greenhouse Multimedia www.greenhousem.com</p>
		<!--Improved By Ogehenkaro Brume Israel-->
	</center>
</div>
</body>
</html>
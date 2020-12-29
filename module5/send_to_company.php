<?php
$db = mysqli_connect("localhost", "root", "", "noahhms");
if (isset($_GET['id']) AND !empty($_GET['id'])) {
		
		if (isset($_GET['pid']) AND !empty($_GET['pid'])) {

			$chk = mysqli_query($db, "SELECT to_pay  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 0");

			$chk2 = mysqli_query($db, "SELECT to_pay FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 3");

		$get_chk = mysqli_fetch_assoc($chk);

		$get_chk2 = mysqli_fetch_assoc($chk2);

		$pay = intval($get_chk['to_pay']);

		$pay2 = intval($get_chk2['to_pay']);

		if (mysqli_num_rows($chk) > 0) {
				$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 3 WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
					if ($sql) {
						$pat = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$_GET['pid']."");
						$pat_data = mysqli_fetch_assoc($pat);
							$inse = mysqli_query($db,"INSERT INTO company_bill (company_name,staff_name, staff_position, amount, date_time_added, payment_for, link_ref, patient_id) VALUES ('".$_POST['company']."','".$pat_data['surname']." ".$pat_data['first_name']."', '".$_POST['position']."', '".$pat_data['SUM(amount)']."', '".NOW()."', 'lab', ".$_GET['id'].", ".$_GET['id'].")");
							 header("Location: index.php?company_bill=paid");
							 exit();	
							}	
		}elseif (mysqli_num_rows($chk2) > 0){
				//send to company bills
							 header("Location: index.php?company_bill=already");
							 exit();
		}else{
			header("Location: index.php?company_bill?error");
						exit();
		}
	}
}
?>

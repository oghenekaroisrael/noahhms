<?php
	ob_start();
	session_start();
	$pageTitle = "Payments";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	include_once '../inc/header-index.php'; //for addding header
	$ref = $_GET['pid'];
	$amo =  $_GET['amount'];
	$oid = $_GET['oid'];
	$j = explode(",", $ref);

?> 
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
    	 <?php include 'inc/main_header.php';?>

		<div class="content">
            <div class="container-fluid">
			
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"></h4>
                                <h4>Total: <b>
                                	<?php echo $amo; ?>
                                </b></h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount Expected</th>
                                    	<th>Amount Paid</th>
                                    	<th>Status</th>
                                    	<th>Date Of Transaction</th>
                                    </thead>
                                    <tbody>
									 <?php 
									 				$count = 1; 
													$notarray = database::getInstance()->select_from_where60('accounts','order_id', $oid,'id');
													foreach($notarray as $rowa):
														$type = $rowa['item'];
														$to_pay = $rowa['to_pay'];
														$amount = $rowa['amount'];
														$balance = intval($to_pay) - intval($amount);
														$patient_id = $rowa['patient_id'];
														$appointment_id = $rowa['app_id'];
														$status = $rowa['payment_status']; 
														$date = $rowa['date_paid'];
														$oid = $rowa['order_id'];	
														if ($appointment_id != 0) {
															$frnt =$oid;
														}else{
															$frnt = $ref;
														}										
														if($type == 2) {
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];								
														$notarray2 = database::getInstance()->select_from_where60('patient_test', 'link_ref',$oid,'patient_test_id');
														foreach ($notarray2 as $row => $vali) {
															$lab_test_id = $vali['lab_test_id'];
															$notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
															foreach ($notarray3 as $row2 => $a) {
																$lab_test .= $a['lab_test'].",<br>";
																$fee += intval($a['fee']); 
															}
														}
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo substr(trim($lab_test), 0,-5); ?></td>
																<td>&#x20A6;<?php echo $fee;?></td>
																<td>&#x20A6;<?php echo $amount;?></td>
																<td>&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
															</tr>
													<?php
													}elseif ($type == 3) {
														$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
															foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
															$status = $row['status'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['price']; 
																	?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo $to_pay;?></td>
																		<td>&#x20A6;<?php echo $amount;?></td>
																		<td>&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																	</tr>
															<?php endforeach;
															endforeach;
													}elseif ($type == 5) {
														$notarray = database::getInstance()->select_from_where2('patients', 'id',$patient_id );
															foreach($notarray as $row):
															$card_type = $row['card_type'];

																$notarray = database::getInstance()->select_from_where2('card_types', 'id',$card_type );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['cost']; ?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo $price;?></td>
																		<td>&#x20A6;<?php echo $amount;?></td>
																		<td>&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																</tr>
															<?php endforeach;
															endforeach;
													}elseif ($type == 6) {
														$notarray = database::getInstance()->select_from_where2("xray_requests","link",$frnt);
																	?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php
																			foreach ($notarray as $ky) {
																				$get_xray = database::getInstance()->select_from_where2("xray","id",$ky['name']);
																				foreach ($get_xray as $ke) {			
																				$xname .= $ke['name'].",<br>";
																				}
																			}
																			echo substr(trim($xname), 0, -5);
																		?></td>
																		<td>&#x20A6;<?php echo $to_pay;?></td>

																<td>&#x20A6;<?php echo $amount;?></td>
																<td>&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																	</tr>												
															<?php
													}elseif($type == 7) {
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];								
														$fee = 2500;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td>Physiotherapy Session</td>
																<td>&#x20A6;<?php echo $fee;?></td>
																<td>&#x20A6;<?php echo $amount;?></td>
																<td>&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
															</tr>
													<?php
													}
												endforeach;
									 		
									 		?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount Expected</th>
                                    	<th>Amount Paid</th>
                                    	<th>Status</th>
                                    	<th>Date Of Transaction</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>



            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>

<?php include 'pay.php'; ?>
<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function update(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to accept payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='accept("+ID+")'>Accept</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
		function accept(ID,test){ 
		var val = ID;
		var test = test;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&test=' + test + '&ins=acceptPayment'+'&status=1',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function cancel(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to cancel payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='canc("+ID+")'>Accept</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
		function canc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=0',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'payment_daily';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

function defer_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=deferPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}


function accept_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=acceptPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}

function cancel_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=cancelPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}

function company_bill_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=company_bill_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data === 'Done') {
				console.log(data);
				document.getElementById("load").style.display = "none";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}
function show_comp_all() {
	document.getElementById("company_bill").style.display = "block";
}
</script>

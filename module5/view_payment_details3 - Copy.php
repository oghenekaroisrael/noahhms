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
	$ref = $_GET['id'];
	$amo =  $_GET['amount'];

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
                                <h4 class="title">View Details Of Payment <?php
                                	if (is_array($j)) {?></h4>
                                <h4>Total: <b>
                                	<?php echo $amo; ?>
                                </b></h4>
                            </div>
                            <div class="row">
                            	<div class="col-lg-8"></div>
                            	<div class="col-lg-4">
                            				<div class="btn-group right" style="margin-right: 20px;">
												<button type="button" class="btn btn-info">Payment Action For All</button>
												<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a onclick="defer_all(<?php echo $_GET['pid']; ?>)">Defer Payment</a></li>
													<li><a onclick="show_comp_all()">Company Billing</a></li>
													<li><a onclick="accept_all(<?php echo $_GET['pid']; ?>)">Full Payment</a></li>
													<li><a onclick="cancel_all(<?php echo $_GET['pid']; ?>)">Cancel Payment</a></li>
												</ul>
											</div>
                            	</div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
									  foreach ($j as $id):									  	
											$count = 1; 
											$notarray = database::getInstance()->select_from_where6('accounts','order_id', $id);
											foreach($notarray as $row):

											$type = $row['item'];
											$amount = $row['to_pay'];
											$patient_id = $row['patient_id'];
											$appointment_id = $row['app_id'];
											$status = $row['payment_status'];
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
										?>

                                        	<?php 
												if($type == 2){
													$notarray = database::getInstance()->select_from_where2('patient_test', 'link_ref',$id );
													foreach($notarray as $row):
													$lab_test_id = $row['lab_test_id'];
														$notarray = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
														foreach($notarray as $row):
															$lab_test = $row['lab_test'];
															$fee = $row['fee']; ?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $lab_test;?></td>
																<td>&#x20A6;<?php echo $fee;?></td>
																<td><?php echo $stat; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
																		<button type="button" class="btn btn-info">Make Payment</button>
																		<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																		</button>
																		<ul class="dropdown-menu" role="menu">
																		<?php if($status == 0 || $status == 2){ ?>
																		<li><a onclick="update(<?php echo $appointment_id; ?>,<?php echo $row['patient_test_id'] ?>)">Wave Payment</a></li>
																		<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
																		<li><a onclick="update(<?php echo $appointment_id; ?>,<?php echo $row['patient_test_id'] ?>)">Defer Payment</a></li>
																		<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
																			<li><a href="<?php echo $id; ?>">Full Payment</a></li>
																			
																		<?php }elseif($status == 1){ ?>
																			<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
																		<?php } ?>
																		</ul>
																	</div>
																</td>
															</tr>
													<?php endforeach;
													endforeach;
												}	else if($type == 3){
															$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$id);
															foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['price']; ?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo $price;?></td>
																		<td><?php echo $stat; ?></td>
																		<td>
																			<div class="btn-group right" style="margin-right: 20px;">
																		<button type="button" class="btn btn-info">Make Payment</button>
																		<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																		</button>
																		<ul class="dropdown-menu" role="menu">
																		<?php if($status == 0 || $status == 2){ ?>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Wave Payment</a></li>
																		<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Defer Payment</a></li>
																		<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
																			<li><a href="<?php echo $id; ?>">Full Payment</a></li>
																			
																		<?php }elseif($status == 1){ ?>
																			<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
																		<?php } ?>
																		</ul>
																	</div>
																		</td>
																	</tr>
															<?php endforeach;
															endforeach;
												}	else if($type == 5){
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
																		<td><?php echo $stat; ?></td>
																		<td>
																			<div class="btn-group right" style="margin-right: 20px;">
																		<button type="button" class="btn btn-info">Make Payment</button>
																		<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																		</button>
																		<ul class="dropdown-menu" role="menu">
																		<?php if($status == 0 || $status == 2){ ?>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Wave Payment</a></li>
																		<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Defer Payment</a></li>
																		<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
																			<li><a href="<?php echo $id; ?>">Full Payment</a></li>
																			
																		<?php }elseif($status == 1){ ?>
																			<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
																		<?php } ?>
																		</ul>
																	</div>
																		</td>
																	</tr>
															<?php endforeach;
															endforeach;
												}	 
											?>
                                        	
										
										
					 
										<?php endforeach;

									endforeach;?>
                                    </tbody>
                                    <?php

                                		}else{ 
                                		$count = 1; 
											$notarray = database::getInstance()->select_from_where6('accounts','order_id', $j);
											foreach($notarray as $row):

											$type = $row['item'];
											$amount = $row['to_pay'];
											$patient_id = $row['patient_id'];
											$appointment_id = $row['app_id'];
										?>

                                        	<?php 
												if($type == 2){
													$notarray = database::getInstance()->select_from_where2('patient_test', 'link_ref',$j );
													foreach($notarray as $row):
													$lab_test_id = $row['lab_test_id'];
														$notarray = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
														foreach($notarray as $row):
															$lab_test = $row['lab_test'];
															$fee = $row['fee']; ?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $lab_test;?></td>
																<td>&#x20A6;<?php echo $fee;?></td>
																<td><?php echo $stat; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0 || $status == 2){ ?>
													<li><a onclick="update(<?php echo $appointment_id; ?>)">Wave Payment</a></li>
													<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
													<li><a onclick="update(<?php echo $appointment_id; ?>)">Defer Payment</a></li>
													<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
														<li><a href="<?php echo $j; ?>">Full Payment</a></li>
														
													<?php }elseif($status == 1){ ?>
														<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
													<?php } ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php endforeach;
													endforeach;
												}	else if($type == 3){
															$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$j);
															foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['price']; ?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo $price;?></td>
																		<td><?php echo $stat; ?></td>
																		<td>
																			<div class="btn-group right" style="margin-right: 20px;">
																		<button type="button" class="btn btn-info">Make Payment</button>
																		<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																		</button>
																		<ul class="dropdown-menu" role="menu">
																		<?php if($status == 0 || $status == 2){ ?>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Wave Payment</a></li>
																		<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Defer Payment</a></li>
																		<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
																			<li><a href="<?php echo $j; ?>">Full Payment</a></li>
																			
																		<?php }elseif($status == 1){ ?>
																			<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
																		<?php } ?>
																		</ul>
																	</div>
																		</td>
																	</tr>
															<?php endforeach;
															endforeach;
												}	else if($type == 5){
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
																		<td><?php echo $stat; ?></td>
																		<td><div class="btn-group right" style="margin-right: 20px;">
																		<button type="button" class="btn btn-info">Make Payment</button>
																		<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																		</button>
																		<ul class="dropdown-menu" role="menu">
																		<?php if($status == 0 || $status == 2){ ?>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Wave Payment</a></li>
																		<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
																		<li><a onclick="update(<?php echo $appointment_id; ?>)">Defer Payment</a></li>
																		<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
																			<li><a href="<?php echo $j; ?>">Full Payment</a></li>
																			
																		<?php }elseif($status == 1){ ?>
																			<li><a onclick="cancel(<?php echo $appointment_id; ?>)">Cancel Payment</a></li>
																		<?php } ?>
																		</ul>
																	</div></td>
																	</tr>
															<?php endforeach;
															endforeach;
												}	 
											?>
                                        	
										
										
					 
										<?php endforeach;
                                    	}
                                    ?>
                                 <thead>
                                        <th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
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
    </script>}

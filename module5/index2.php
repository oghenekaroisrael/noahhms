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
	if (isset($_GET['part_pay']) AND $_GET['part_pay'] == 1) {
		?>
		<style type="text/css">
			#Part_payment{
				display: block;
			}
		</style>
		<?php
		$tatp = $_GET['top'];
		$cps = $_GET['payst'];
		$pypat_id = $_GET['pat_id'];
		$bal = $_GET['ccah'];
		$ppid = $_GET['pid'];
	}

		if (isset($_GET['company_bill']) AND $_GET['company_bill'] == 1) {
		?>
		<style type="text/css">
			#company_bill{
				display: block;
			}
		</style>
		<?php
		$tatp = $_GET['top'];
		$cps = $_GET['payst'];
		$pypat_id = $_GET['pat_id'];
		$bal = $_GET['ccah'];
		$ppid = $_GET['pid'];
	}
?>
<style type="text/css">
	.jumbotron{
  background: none;
}
#jumbotron-bg{
  background-color: green;
}
</style>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
    	 <?php include 'inc/main_header.php';?>

		<div class="content">
            <div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<h3  class="text-center"><b>Today's Income</b></h3>
				</div>
				<div class="col-lg-3">
					<h1 class="left">&#8358; 
						<?php 
							include "tot.php";
						?>
							
						</h1>
				</div>
				<div class="col-lg-3">
					<h3  class="text-center">Pending Payments</h3>
				</div>
				<div class="col-lg-3">
					<h1 class="left">&#8358; 
						<?php 
							include "pend.php";
						?>
							
						</h1>
				</div>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Payments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Date Added</th>
										<th>Reference</th>
                                    	<th>Patient</th>
										<th>Payment For</th>
										<th>Status</th>
										<th>Amount</th>
										
										<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_payment3();
											foreach($notarray as $row):
											
											$id = $row['id'];
											$type = $row['GROUP_CONCAT(item)'];
											$date = $row['date_added'];
											$reference = $row['order_id'];
											$appointment_id = $row['app_id'];
											$p_id = $row['patient_id'];
											$to_pay = $row['SUM(to_pay)'];										
											if($row['payment_status'] == 1){
												$status = "Paid";
											}elseif ($row['payment_status'] == 2) {
												$status = "Paid Part";
											}elseif($row['payment_status'] == 3){
												$status = "Company Bill";
											}else{
												$status = "Pending";
											}
											
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
											<td><?php echo $date;?></td>
                                        	<td><?php echo $reference;?></td>
                                        	<td><?php
											$notarray = database::getInstance()->select_from_where2('patients', 'id',$p_id );
											foreach($notarray as $row):
											echo $name = $row['title']." ".$row['surname']." ".$row['first_name'];
											endforeach;
											?></td>
                                        	<td><?php 
                                        	$types = explode(",", $type);
	                                        	foreach ($types as $type):                                        		
												$notarray = database::getInstance()->select_from_where2('payment_type', 'payment_type_id',$type );
												foreach($notarray as $row):
												echo $name = $row['payment_type']. ", ";
												endforeach;
                                        	endforeach;
											?></td>
                                        	<td><?php echo $status;?></td>
											<td>&#x20A6;<?php echo $to_pay;?></td>
                                        	                 
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="update(<?php echo $appointment_id; ?>,'<?php echo $name; ?>')">Wave Payment</a></li>
													<li><a onclick="window.open('modal2.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Company Billing</a></li>
													<li><a onclick="update(<?php echo $appointment_id; ?>,'<?php echo $name; ?>')">Defer Payment</a></li>
													<li><a onclick="window.open('modal.php?id=<?php echo $p_id; ?>&p=<?php echo $id; ?>','_self');">Part Payment</a></li>
														<li><a onclick="update(<?php echo $appointment_id; ?>,'<?php echo $name; ?>')">Full Payment</a></li>
														
													<?php }elseif($row['payment_status'] == 1){ ?>
														<li><a onclick="cancel(<?php echo $appointment_id; ?>,'<?php echo $name; ?>')">Cancel Payment</a></li>
													<?php } ?>
													<?php 
														if($type == 3){
													?>
														<!--<div class="divider"></div>
														<li><a href="process_prescription?id=<?php echo $appointment_id;?>">Process Prescription</a></li>-->
													<?php } ?>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Reference</th>
                                    	<th>Patient</th>
										<th>Payment Type</th>
										<th>Status</th>
										<th>Amount</th>
										<th>Date Added</th>
										<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>
<div class="container-fluid" id="Part_payment">
	<div class="container">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center text-primary">
					Part Payment
				</h5>
				<button type="button" class="close" onclick="part_pay()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="container">
				<div class="row" id="jumbotron-bg">
					<div class="col-lg-6 jumbotron text-center">
								<h4 style="color: #fff; font-family: calibri; font-weight: lighter; font-size: 48px;">To Pay</h4><p></p><br>
								<b>&#8358; <?php echo $tatp;?></b>
					</div>
					<div class="col-lg-6 jumbotron text-center">
								<h4  style="color: #fff; font-family: calibri; font-weight: lighter; font-size: 38px;">Balance</h4><p></p><br>
								<b>&#8358; 
									<span id="balance_val">
									<?php 
										if ($cps == 0) {
											echo $tatp - $bal;
										}elseif ($cps ==2 ) {
											echo $tatp - $bal;
										}
										else{
											echo "Fully Paid";
										}
									?>										
									</span>
								</b>
					</div>
				</div>
				<p></p>
				<div class="row" style="padding-bottom: 20px;">
					<div class="col-md-12">
						<form method="POST" action="update_part_pay.php?pid=<?php echo $pypat_id; ?>&id=<?php echo $ppid; ?>">
							<input type="text" name="part_of_payment" class="form-control" placeholder="Enter Amount To Pay"><br>
							<center><button type="submit" class="btn btn-success btn-lg right <?php if($cps == 1){ echo 'disabled';}else{echo'';} ?>">Make Payment</button></center>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="container-fluid" id="company_bill">
	<div class="container">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary">
					Company Billing
				</h5>
				<button type="button" class="close" onclick="company_bill()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="container">
				<div class="row" id="jumbotron-bg2">
					<div class="col-lg-12 jumbotron text-center">
						<form method="POST" action="send_to_company.php?pid=<?php echo $pypat_id; ?>&id=<?php echo $ppid; ?>">
						<select class="form-control" name="company">
							<option class="disabled" >Select Company</option>
							<?php
														$userDetails = Database::getInstance()->select('companies');
														foreach($userDetails as $ow):
															$ictd = $ow['id'];
															$namee = $ow['company_name'];	
														
													?>
													<option value="<?php echo $ictd;?>"><?php echo $namee;?></option>
													<?php endforeach; ?>
						</select><br>
						<input type="text" name="position" style="text-align: center;font-size: 18px;" class="form-control" placeholder="Position In Company">
					</div>
				</div>
				<p></p>
						
							<center style="margin-bottom: 15px;"><button type="submit" class="btn btn-info btn-lg <?php if($cps == 1){ echo 'disabled';}else{echo'';} ?>">Send Bill</button></center>
						</form>
						
					</div>
				</div>
			</div>
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
                type: 'danger',
                timer: 100000
            });

    	}
		
		function accept(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=1',
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
                type: 'danger',
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
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		function part_pay(){
			var x = document.getElementById("Part_payment");
			if (x.style.display === "none") {
				x.style.display = "block";
			}else{
				x.style.display = "none";
			}
		}
		function company_bill(){
			var x = document.getElementById("company_bill");
			if (x.style.display === "none") {
				x.style.display = "block";
			}else{
				x.style.display = "none";
			}
		}
    </script>

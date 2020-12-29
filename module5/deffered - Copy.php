<?php 
	ob_start();
	session_start();
	$pageTitle = "Credit Balance";
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
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
			
			
                <div class="row">
					 <div class="col-md-4">
					 	<center>
					 			<div class="monthly_boxes red">
					 				<h2><?php include'wav.php'; ?></h2>
					 				<span class="box_title">Invalidate</span>
					 				<i class="fas fa-money"></i>
					 				<div class="link">
					 					<a class="btn-link" href="waved.php"><i class="fas fa-info-circle"></i>Click Here To See All Invalidate</a>
					 				</div>
					 			</div>
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="monthly_boxes green">
					 				<h2><?php include'def.php'; ?></h2>
					 				<span class="box_title">Deffered Payments</span>
					 				<i class="fas fa-credit-card"></i>
					 				<div class="link">
					 					<a class="btn-link" href="deffered.php"><i class="fas fa-info-circle"></i>Click Here To See All Deffered Payements</a>
					 				</div>
					 			</div>
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="monthly_boxes cyan">
					 				<h2><?php include 'com.php'; ?></h2>
					 				<span class="box_title">Company Bills</span>
					 				<i class="fas fa-line-chart"></i>
					 				<div class="link">
					 					<a class="btn-link" href="company.php"><i class="fas fa-info-circle"></i>Click Here To See All Company Bills</a>
					 				</div>
					 			</div>
					 	</center>
					 </div>
                 </div>

                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Deffered Payment Details </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient's Name</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$userDetails = Database::getInstance()->select_deferred();
										foreach($userDetails as $row):
											$ictd = $row['patient_id'];
																			
												$userDetails = Database::getInstance()->select_from_where2('patients', 'id', $ictd );
												foreach($userDetails as $ow):
													
													 $card_name = $ow['surname']." ".$ow['first_name'];
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php echo $card_name; ?>
                                        		
                                        	</td>
                                        	<td>
                                        		<?php 
                                        	if($row['item'] == 1){
												$statusS = "Pharmacy";
											}elseif ($row['item'] == 2) {
												$statusS = "Lab Test";
											}elseif($row['item'] == 3){
												$statusS = "Drugs";
											}elseif($row['item'] == 4){
												$statusS = "Admission";
											}else{
												$statusS = "Card";
											}
											echo $statusS;
											?>
                                        	</td>
                                        	<td>
                                        		<?php echo $row['to_pay']; ?>
                                        	</td>
                                        	<td>
                                        		<?php if($row['payment_status'] == 1){
												$status = "Fully Paid";
											}elseif ($row['payment_status'] == 2) {
												$status = "Paid Part";
											}elseif($row['payment_status'] == 3){
												$status = "Company Bill";
											}elseif($row['payment_status'] == 4){
												$status = "Deffered Payment";
											}else{
												$status = "Pending";
											}

											echo $status;

											 ?>
                                        	</td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="view_payment_details.php?pid=<?php echo $ictd; ?>&amount=<?php echo $row['to_pay']; ?>&id=<?php echo $row['order_id'];?>">View Details</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php
										
									 endforeach; 
									endforeach;
									?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Patient's Name</th>
                                        <th>Payment For</th>
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


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From bank list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delBall',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'c_balance';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

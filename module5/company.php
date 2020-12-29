<?php 
	ob_start();
	session_start();
	$pageTitle = "Company Bills";
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
                                <h4 class="title">All Company Bills</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>Company Name</th>
                                    	<th>Patient's Name</th>
                                    	<th>Amount</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_comp();
											foreach($notarray as $row):
											$id = $row['patient_id'];
											$amt = $row['amount'];
											$exp_date = $row['date_paid'];
											$name = $row['company_name'];
											$bal_type = $row['to_pay'];

											$userDetails = Database::getInstance()->select_from_where2('patients', 'id', $id );
												foreach($userDetails as $ow):
													
													 $card_name = $ow['surname']." ".$ow['first_name'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	
                                        	
                                        	<td>
                                        		<?php echo $exp_date;?>

                                        	</td>
                                        	<td>                                        	
											<?php echo $name; ?>
                                        	</td>
                                        	<td>
                                        		<?php echo ucwords($card_name); ?>
                                        	</td>
                                        	<td>
                                        		<?php echo $bal_type; ?>
                                        	</td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="view_companies_details?id=<?php echo $row['id']; ?>">View Details</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $amt; ?>')">Delete</a>
													</li>
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
                                        <th>Date</th>
                                    	<th>Company Name</th>
                                    	<th>Patient's Name</th>
                                    	<th>Amount</th>
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

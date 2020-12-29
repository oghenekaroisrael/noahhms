<?php 
	ob_start();
	session_start();
	$pageTitle = "Prescriptions";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
$pat = $_GET['pid'];
	include_once '../inc/header-index.php'; //for addding header
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
                                <h4 class="title">All Prescriptions</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro" class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
										<th>Given</th>
                                    	<th>Payment Status</th> 
                                    	<th>Date</th>                              	
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_prescription_all2($pat);
											//var_dump($notarray);
											foreach($notarray as $row):
											$id = $row['prescription_id'];
											$p_id = $row['patient_id'];
											$app = $row['appointment_id'];
											$status1 = $row['status'];
											$oid = $row['reference'];
											$status = database::getInstance()->get_name_from_id2('payment_status','accounts','order_id',$oid);

											$given = $row['pres_status'];
											$doc = $row['doctor_id'];
											$dated = $row['pdate_added'];
											$patient ="";
											
									 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $patient = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>
                                        		
                                        	</td>
                                        	
											
											<td>
                                        		<?php 
                                        			if($given != 0){
                                        				?>
                                        				<div class="badge badge-success">Yes</div>
                                        				<?php
                                        			} else {
                                        				?>
                                        				<div class="badge badge-info">No</div>
                                        				<?php
                                        			}
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if($status != 0){
                                        				?>
                                        				<div class="badge badge-success">Paid</div>
                                        				<?php
                                        			} else {
                                        				?>
                                        				<div class="badge badge-warning">Pending</div>
                                        				<?php
                                        			}
                                        		?>
                                        	</td>
                                        		<td><i class="fas fa-clock-o"></i><?php echo $dated; ?></td>
												<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">

															<?php 
															if($status != 0){
														?>
													<li><a href='presc.php?pid=<?php echo $app;?>'>View Prescription</a></li>
													<li class="divider"></li>
													<li><a onclick="proce(<?php echo $oid; ?>,'<?php echo $patient; ?>')">Process Prescription</a></li>
													
													<?php if($given == 1){	?>
													<li class="divider"></li>
													<li><a onclick="canc(<?php echo $oid; ?>,'<?php echo $patient; ?>')">Cancel Process</a></li>
													<?php }	?>

													<?php } else { ?>
													<li>Payment Not Made</li>
													<?php } ?>
													
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 	<thead>
                                        <th>#</th>
                                        <th>Name</th>
										<th>Given</th>
                                    	<th>Payment Status</th>  
                                    	<th>Date</th>                             	
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


<div class="loader" id="load" style="display:none;"></div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(drugs,tabs,dosage,duration, date,instruction){ 

        	s.notify({
            	icon: '',
            	message: 
				 "<table class='table table-bordered table-primary'><thead><th><b>Drugs</b></th><th>Number of Tabs</th><th>Dosage</th><th>Duration</th><th>Date</th><th>Instructions</th></thead><tbody><tr><td>"+drugs+"</td><td>"+tabs+"</td><td>"+dosage+"</td><td>"+duration+"</td><td>"+date+"</td><td>"+instruction+"</td></tr> </tbody></table>"
				 

            },{
                type: 'success',
                timer: 100000
            });

    	}
		
		function proce(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to process prescription of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='proc("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function proc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=1' + '&doc=' + <?php echo $doc;?> + '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function canc(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Cancel Prescription Process of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function cncel(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=0' +  '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
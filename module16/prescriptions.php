<?php 
	ob_start();
	session_start();
	$pageTitle = "Prescriptions";
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
	
	$finish = database::getInstance()->stock_finish();
	foreach ($finish as $values) {
		$name = $values['name'];
		$rem = intval($values['c_carton']);
		?>
		<script>
				$(document).ready(function() {
					rem('<?php echo $name ?>',<?php echo $rem ?>);
				});
		</script>
		<?php
	}
	
	
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
                            <div class="header" id="here_me">
                                <h4 class="title">Prescriptions</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient's Name</th>
                                        <th>Syrup / Drug / Fluid Name</th>
                                        <th>Quantity to Dispense</th>
										<th>Given</th>
                                    	<th>Payment Status</th>                                    	
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_prescription_all();
											foreach($notarray as $row):
											$id = $row['prescription_id'];
											$p_id = $row['patient_id'];
											$status = $row['status'];
											$given = $row['pres_status'];
											if ($given == 0) {
												$given1 = "red";
												$color = 'danger';
											}else{
												$given1 = "green";
												$color = 'success';
											}
											if ($status == 0) {
												$given2 = "red";
												$color2 = 'danger';
											}else{
												$given2 = "green";
												$color2 = 'success';
											}
											$drugs =  $row['pharm_stock_id'];
											$quantity = $row['quantity_dispense'];
											$date = $row['pdate_added'];
											$doc = $row['doctor_id'];
											$patient ="";
											
									 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $patient = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>
                                        		
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			$pharm = Database::getInstance()->select_from_where('pharm_stock', 'id', $drugs);
													foreach($pharm as $drug):
														echo $drug['name'];
														
													endforeach; 
                                        		?>
                                        	</td>
											<td>
                                        		<?php 
                                        			echo $quantity;
                                        		?>
                                        	</td>
											<td>
                                        		<div class="label label-<?php if (isset($given1) AND !empty($given1)){echo $color;}?>">
                                        			<?php 
                                        			if($given == 0){
                                        				echo "No";
                                        			} else {
                                        				echo "Yes";
                                        			}
                                        		?>
                                        		</div>
                                        	</td>
                                        	<td>
                                        		<div class="label label-<?php if (isset($given2) AND !empty($given2)){echo $color2;}?>">
                                        			<?php 
                                        			if($status != 0){
                                        				echo "Paid";
                                        			} else {
                                        				echo "Not Paid";
                                        			}
                                        		?>
                                        		</div>
                                        	</td>
												
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<?php if($status > 0 && $given == 0){	?>
															<li><a href="process_prescription.php?id=<?php echo $id; ?>">Process Prescription</a></li>
															<?php }elseif($status == 0){	?>
															<li><p>Payment Not Made</p></li>
															<?php }elseif($given == 1){	?>
															<li><a onclick="canc(<?php echo $id; ?>,'<?php echo $patient; ?>')">Cancel Process</a></li>
															<li><a href="process_prescription.php?id=<?php echo $id; ?>&i=1">View Details</a></li>
															<?php }?>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Patient's Name</th>
                                        <th>Syrup / Drug / Fluid Name</th>
                                        <th>Quantity to Dispense</th>
										<th>Given</th>
                                    	<th>Payment Status</th>                                    	
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

    	function rem(name,rem){ 

        	s.notify({
            	icon: 'pe-7s-drawer',
            	message: "<b>"+name+"</b> Is Almost Out Of Stock ("+rem+" Remaining)"

            },{
                type: 'info',
                timer: 300000
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
            data: "val=" + val +  '&ins=cancelPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
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
<?php 
	ob_start();
	session_start();
	$pageTitle = "New Admission Request";
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
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Admission Request</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro" class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Appointment ID</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Date</th>
                                    	<th>Status</th>
                                    	<th>Change Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord('admission_request','ward_id',4,'admission_request_id','DESC');
											foreach($notarray as $row):
											$id = $row['admission_request_id'];
											$app_id = $row['appointment_id'];
											$p_id = $row['patient_id'];
											$d_id = $row['doctor_id'];
											$status = $row['status'];
										
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $app_id;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $pname = $qw['title']." ".$qw['surname']." ".$qw['first_name'];
														
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $d_id);
													foreach($userDetails as $ow):
														echo $dname = $ow['first_name']." ".$ow['last_name'];	
													endforeach; 
												?>

                                        	</td>
                                        	
                                        	<td>
                                        		<?php 
												$fDate = $row['request_time'];
												$dt = new DateTime($fDate); //for getting just date from timestamp
											?>
											<?php echo $dt->format('d-m-Y'); ?>
                                        	</td>

                                        	<td>
                                        		<?php 
                                        			if($status == 1){
                                        				echo "Treated";
                                        			} else{
                                        				echo "Pending";
                                        			}
                                        		?>
                                        	</td>
											
											<td>
												<form>
													<select id="status" class="form-control" name="status">
														
														<option value="<?php echo $status;?>">
															<?php
																switch ($status) {
																	case 0:
																	echo 'Pending';
																	break;
																				
																	case 1:
																	echo 'Treated';
																	break;
																				
																	case 2:
																	echo 'Cancelled';
																	break;
	
																	default:
																	echo 'Pending';
																}
																			 
															?>
														</option>
														<option value="0">Pending</option>
														<option value="1">Treated</option>
														<option value="2">Cancelled</option>
													</select>
												</form>
											</td>
											
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="ipd?id=<?php echo $p_id; ?>&g=<?php echo $id; ?>">Add To IPD</a></li>
														<li class="divider"></li>
														<li><a href="view_note?view=<?php echo $app_id; ?>&id=<?php echo $p_id; ?>">View Case File</a></li>
														<li class="divider"></li>
														<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $pname; ?>')">Delete</a></li> 
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
										<th>Appointment ID</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Date</th>
                                    	<th>Status</th>
                                    	<th>Change Status</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delAdminReq',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'new_request';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changeAdmiStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var app_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, app_id: app_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_result').html(res).show();
						//console.log(res);
				}
			});

		});
</script>

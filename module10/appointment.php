<?php 
	ob_start();
	session_start();
	$pageTitle = "Patients";
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
			<div style="padding-bottom:45px;">
			<a href="new_appointment" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Appointment
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Appointments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Time</th>
                                    	<th>Date</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('patient_appointment','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$p_id = $row['patient_id'];
											$d_id = $row['doctor_id'];
											$date_added = $row['date_added'];
											$time_added = $row['time_added'];
											$treated = $row['treated'];
											$surname = "";
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
														$surname = $qw['surname'];
														
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $d_id);
													foreach($userDetails as $ow):
														echo $name = $ow['first_name']." ".$ow['last_name'];	
													endforeach; 
												?>

                                        	</td>
                                        	
                                        	<td>
                                        		<?php 
												$fDate = $row['date_added'];
												$dt = new DateTime($fDate); //for getting just date from timestamp
											?>
											<?php echo $dt->format('d-m-Y'); ?>
                                        	</td>

                                        	<td>
                                        		<?php echo $row['time_added'];?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if($treated == 1){
                                        				echo "Seen";
                                        			} else{
                                        				echo "Unseen";
                                        			}
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
													<li><a href="appointment_case_note?id=<?php echo $id; ?>">View Case File</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $surname; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Time</th>
                                    	<th>Date</th>
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
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

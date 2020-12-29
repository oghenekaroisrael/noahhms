<?php 
	ob_start();
	session_start();
	$pageTitle = "Vitals";
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
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Vitals </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Temperature</th>
                                    	<th>Weight</th>
                                    	<th>Pulse Rate</th>
                                    	<th>Blood Pressure Standing</th>
                                    	<th>Blood Pressure Sitting</th>
                                    	<th>History</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									    <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('patient_appointment','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$p_id = $row['patient_id'];
											$temp = $row['temperature'];
											$bpst = '('.$row['blood_press_stand_s'].'/Sistolic) ('.$row['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$row['blood_press_sit_s'].'/Sistolic) ('.$row['blood_press_sit_d'].'/Diastolic)';
											if($row['blood_press_sit_s'] == ""){
											$bpst ="";											
											$bpsi ="";											
											}
											$weight = $row['weight'];
											$pulse = $row['pulse_rate'];
											$history = $row['history'];
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
                                        	
                                        	
                                        	<td><?php echo $temp; ?></td>
											<td><?php echo $weight; ?></td>
											<td><?php echo $pulse; ?></td>
                                        	<td><?php echo $bpst;?></td>
											<td><?php echo $bpsi;?></td>
											<td><?php echo $history;?></td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="new_vitals?add=<?php echo $id; ?>">Add Vitals</a></li>
													<li class="divider"></li>
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
                                    	<th>Temperature</th>
                                    	<th>Weight</th>
                                    	<th>Pulse Rate</th>
                                    	<th>Blood Pressure Standing</th>
                                    	<th>Blood Pressure Sitting</th>
                                    	<th>History</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> Vitals ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delPatientVital',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'vitals';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

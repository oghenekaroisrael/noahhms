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
		$db = mysqli_connect("localhost","root","","noahhms");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = ".$user_id." AND strikes <= 3 AND `timer_notify` <=  '".date("Y-m-d H:i:s")."' ORDER BY id DESC");
		$noti2 = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id= 'all_xray' AND status = 0  ORDER BY id DESC");
		if (mysqli_num_rows($noti) > 0){
		$here = mysqli_fetch_assoc($noti);
		?>
		
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>&pid=<?php echo $here['patient_id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
			}elseif (mysqli_num_rows($noti2) > 0) {
				$here2 = mysqli_fetch_assoc($noti2);
		?>
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here2['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here2['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here2['id']; ?>)">Cancel</a> <a href= "<?php echo $here2['link']; ?>&nstat=1&nid=<?php echo $here2['id']; ?>&pid=<?php echo $here2['patient_id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
			}
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
                                <h4 class="title">All Scan Requests </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Request</th>
                                    	<th>Status</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
									  $count = 1;
											$notarray = database::getInstance()->select_from_ord1('patient_xray_group','patient_xray_group_id','DESC');
											foreach($notarray as $row):
											$id = $row['patient_appointment_id'];
											$d_id = $row['doctor_id'];
											$date_added = $row['date_added'];
											$num = $row['xray_num'];
											$status = "Pending";
											$test = "Waiting";
											$b1 = "badge-info";
											$b2 = "badge-info";
											$statusS = Database::getInstance()->get_name_from_id('payment_status', 'accounts','order_id', $row['link_ref']);
											if($statusS > 0){
												$status = "Confirmed";
												$b1 = "badge-warning";
											}
											if($row['awaiting_result'] == 1){
												$test = "Completed";
												$b2 = "badge-success";
											}
											$surname = "";
										?>
                                        <tr>
                                        	<td style="width: 8%;"><?php echo $count++;?></td>
                                        	<td>
                                        		<i class="fas fa-user-md"></i>
                                        		<?php 
                                        			$doc = mysqli_query($db,"SELECT * FROM staff WHERE user_id = ".$d_id."");
                                        		$doct = mysqli_fetch_assoc($doc);
                                        		echo $doct['last_name']." ".$doct['first_name'];
                                        		?>                                        			
                                        		</td>
                                        	<td style="width: 20%;">
                                        		<i class="fas fa-user"></i>
                                        		<?php
                                        		$p = mysqli_query($db,"SELECT * FROM patient_appointment WHERE id = ".$id."");
                                        		$pi = mysqli_fetch_assoc($p);
                                        		$p_id = $pi['patient_id'];

													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
														$surname = $qw['surname'];
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	<td><i class="fas fa-photo"></i>
                                        		<?php 
                                        			$xray = mysqli_query($db, "SELECT name FROM xray_requests where link = '".$row['link_ref']."'");
                                        			$xname="";
                                        			while ($xra = mysqli_fetch_assoc($xray)) {
                                        				$xray_n = mysqli_query($db, "SELECT name FROM xray WHERE id = ".$xra['name']."");
                                        				while ($xray_name = mysqli_fetch_assoc($xray_n)) {
                                        					$xname .= $xray_name['name'].",<br>";
                                        				}
                                        			}
                                        			echo substr($xname,0,-5);
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if ($row['awaiting_result'] > 0) {
                                        				?>
                                        				<div class="badge badge-success">Done</div>
                                        				<?php
                                        			}else{
                                        				?>
                                        				<div class="badge badge-info">Waiting</div>
                                        				<?php
                                        			}
                                        		 ?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if ($statusS > 0) {
                                        				?>
                                        				<div class="badge badge-success">Paid</div>
                                        				<?php
                                        			}else{
                                        				?>
                                        				<div class="badge badge-warning">Pending</div>
                                        				<?php
                                        			}
                                        		 ?>
                                        	</td>
                                        	
                                        
                                        	<td  style="width: 12%;">
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<?php 
															if($statusS != 0){
														?>
													<li><a href="lab_results?id=<?php echo $id; ?>&pid=<?php echo $p_id; ?>&ref=<?php echo $row['link_ref']; ?>">View Case File</a></li>
														<div class="divider"></div>
														<li><a href="upload_doc?id=<?php echo $id; ?>&pid=<?php echo $p_id; ?>&ref=<?php echo $row['link_ref']; ?>">Send Scans</a></li>
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
                                        <th>Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Request</th>
                                    	<th>Status</th>
                                    	<th>Payment</th>
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


<?php
	ob_start();
	session_start();
	$pageTitle = "Lab";
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
		$noti2 = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id= 'all' AND status = 0  ORDER BY id DESC");
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
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>" class="btn btn-info right">View</a>
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
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here2['id']; ?>)">Cancel</a> <a href= "<?php echo $here2['link']; ?>?nstat=1&nid=<?php echo $here2['id']; ?>" class="btn btn-info right">View</a>
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
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
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
                                <h4 class="title">All Laboratory Requests </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Doctor</th>
                                    	<th>Patient</th>
                                    	<th>Request</th>
                                    	<th>Status</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_test_front();
											foreach($notarray as $row):
											$id = $row['id'];
											$doc_id = $row['doctor_id'];
											$patient_id = $row['patient_id'];
											$app_id = $row['patient_appointment_id'];
											$link = $row['link_ref'];
											$statusS = Database::getInstance()->get_name_from_id('payment_status', 'payment','reference', $link);
											$status = "Pending";
											$test = "Waiting";
											$patient = $row['first_name']." ".$row['middle_name']." ".$row['surname'];
											if($statusS ==1 || $statusS == 2 || $statusS == 3 || $statusS == 4 || $statusS == 5){
												$status = "Confirmed";
											}
											if($row['awaiting_result'] ==1){
												$test = "Processed";
											}
											
											if($doc_id == 0){
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        			if($doc_id != 0){
														$userDetails = Database::getInstance()->select_from_where2('staff', 'user_id', $doc_id);
														foreach($userDetails as $ow):
															echo $name = $ow['first_name']." ".$ow['last_name'];	
														endforeach; 
													} else {
														echo "Reception";
													}
                                        		?>
                                        		
                                        	</td>
                                        	<td><?php echo $patient;?></td>
                                        	<td><?php echo $row['test_num'];;?></td>
                                        	<td><?php echo $test;?></td>
                                        	<td><?php echo $status;?></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														
														<?php 
															if($statusS == 1 || $statusS == 2 || $statusS == 3 || $statusS == 4 || $statusS == 5){
														?>
													<li><a href="view_test?id=<?php echo $link; ?>">Send Lab Result</a></li>
													<?php
													$db = mysqli_connect("localhost", "root", "", "noahhms"); 
													$ql = mysqli_query($db, "SELECT * FROM patient_test_group a	left join patients d on a.patient_id = d.id left join accounts e on a.link_ref = e.order_id WHERE a.link_ref = '".$link."'	ORDER BY a.patient_test_group_id DESC");
													$jk = mysqli_fetch_assoc($ql);
													?>
													<li><a href="view_test_lab?id=<?php echo $jk['link_ref'];?>&n=<?php echo $jk['surname']." ".$jk['first_name'];?>&s=<?php echo $jk['sex']; ?>&a=<?php echo $jk['age']; ?>&pid=<?php echo $jk['patient_id']; ?>&did=<?php echo $jk['doctor_id']; ?>">View Sent Result</a></li>
													<li><a href="view_test_lab2.php?id=<?php echo $link; ?>&pid=<?php echo $id; ?>&n=<?php echo $patient; ?>&a=<?php echo $row['age']; ?>&s=<?php echo $row['sex']; ?>&did=<?php echo $doc_id; ?>">Custom Result</a></li>
													<li><a href=""></a></li>
													<?php } else { ?>
													<li>Payment Not Made</li>
													<?php } ?>
													
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php } endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Doctor</th>
                                    	<th>Patient</th>
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
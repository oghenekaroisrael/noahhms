
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
							<a class="btn btn-link" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>" class="btn btn-info right">View</a>
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
                                <h4 class="title">All In-Patients </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Ward</th>
                                    	<th>Payment Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('ipd_patients','id','DESC');
											foreach($notarray as $row):
											$ipid = $row['id'];
											$id = $row['id'];
											$aid = $row['appointment_id'];
											$p_id = $row['patient_id'];
											$d_id = $row['doctor_id'];
											$date_added = $row['date_added'];
											$time_added = $row['time_added'];
											$treated = $row['treated'];
											if ($row['ward'] == 1) {
	                                                			$diagnosis = "Semi 1 Ward";
	                                                		}elseif ($row['ward'] == 2) {
	                                                			$diagnosis = "Semi Private Ward 1";
	                                                		}elseif ($row['ward'] == 3) {
	                                                			$diagnosis = "Semi Private Ward 2";
	                                                		}elseif ($row['ward'] == 4) {
	                                                			$diagnosis = "Semi Private Ward 3";
	                                                		}elseif ($row['ward'] == 5) {
	                                                			$diagnosis = "Children's Ward";
	                                                		}elseif ($row['ward'] == 6) {
	                                                			$diagnosis = "Main Ward";
	                                                		}elseif ($row['ward'] == 7) {
	                                                			$diagnosis = "Neo-Natal Ward";
	                                                		}elseif ($row['ward'] == 8) {
	                                                			$diagnosis = "Private Ward";
	                                                		}elseif ($row['ward'] == 9) {
	                                                			$diagnosis = "ICU Ward";
	                                                		}else{
	                                                			$diagnosis = "No Ward Selected";
	                                                		}
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
                                        	
                                        	<td><?php echo $diagnosis;?></td>
                                        	<td><?php 
                                        		$arrays = Database::getInstance()->get_name_from_id3('payment_status','accounts','app_id',$aid,'patient_id',$p_id,'id');
											if ($arrays == 2) {
												echo $array = "Part Paid";
											}elseif ($arrays == 1) {
												echo $array = "Fully Paid";
											}elseif ($arrays == 3) {
												echo $array = "Company Billed";
											}elseif($arrays == 4) {
												echo $array = "Deffered Payments";
											}elseif($arrays == 5) {
												echo $array = "Invalidate";
											}elseif($arrays == 0){
												echo $array = "Not Paid";

											} ?>
                                        	</td>
                                        
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="prepare_bill.php?id=<?php echo $aid; ?>">Prepare Bill</a></li>
														<li class="divider"></li>
														<li><a href="view_bill?id=<?php echo $aid; ?> ">View Prepared Bill</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Ward</th>
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

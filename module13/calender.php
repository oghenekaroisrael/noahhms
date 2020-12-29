<?php
	ob_start();
	session_start();
	$pageTitle = "OPD";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		$db = mysqli_connect("localhost", "root", "", "noahhms");
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
			}
		mysqli_query($db, "DELETE FROM patient_appointment WHERE date_time_added < DATE_SUB(NOW(), INTERVAL 1 DAY); ");
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
						

							<!--sidebar-->
						<div class="col-lg-2 pull-left widthLeft">
								<h4>Queue</h4>
								<?php 
								$notarray =Database::getInstance()->select_from_where2_DESC3('patient_appointment',$user_id);
								foreach($notarray as $row):
								$p_id = $row['patient_id'];
								$id = $row['id'];
								$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
									foreach($userDetails as $qw):
										 $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
										 echo "<p><a href='lab_results?id=$id'> $name</a></p>";
									endforeach; 
								endforeach; 	
								?>

								<div class="clearTwenty"></div>
								<h4>Lab Results</h4>
								<?php 
								$notarry =Database::getInstance()->select_from_lab();
								if (!empty($notarry)) {
								foreach($notarry as $row):
								$p_id = Database::getInstance()->get_name_from_id("patient_id","patient_appointment","id",$row['patient_appointment_id']);
								if (!empty($p_id)) {									
								$id = $row['patient_appointment_id'];
								$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
								if (!empty($userDetails)) {
									foreach($userDetails as $qw):
										 $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
										 if (!empty($name)) {
										 	echo "<p><a href='lab_results?id=$id'> $name</a></p>";
										 }else{
										 	echo "";
										 }
										 
									endforeach; 
								}else{
									echo "";
								}
								}else{
									echo "";
								}	
								endforeach; 
								}	
								?>

							</div>
							<!--end col-lg-4-->
							
							
							<div class="col-lg-10 pull-right widthRight">
							<div class="card">
								<div class="row">
							            <!-- CALENDAR-->
							            <div class="col-md-12 col-xs-12">    
							                <div class="panel panel-primary " data-collapsed="0" style="border-color: #ebebeb !important;">
							                    <div class="panel-heading" style="color: #373e4a !important;
							    background-color: #ffffff !important;
							    border-color: #ebebeb !important;">
							                        <div class="panel-title">
							                            <i class="fas fa-calendar"></i>
							                           Your Appointments For Today
							                        </div>
							                    </div>
							                    <div class="panel-body" style="padding:0px;">
							                        <div class="calendar-env">
							                            <div class="calendar-body">
							                                <div id="notice_calendar"></div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</div><!--end content-->
							</div><!--end card-->

						</div><!--ed col 8-->
						
						
						</div>
					</div><!--end row-->
				</div>
			</div>
			
			<?php 
				include_once 'inc/footer-index.php';
				ob_end_flush(); 
			?>
			
		</div>
	</div>

	<script src="../assets/fullcalendar/fullcalendar.min.js"></script>
	
	<script>
		var a=jQuery .noConflict();	
 		a(document).ready(function() {
	  
	  	var calendar = a('#notice_calendar');
				
				a('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,

					
					events: [
					<?php 
						$notarray =Database::getInstance()->select_from_where2_DESC3('patient_appointment',$user_id);
						foreach($notarray as $row):
						$nestH = strtotime($row['date_added']);
						$p_id = $row['patient_id'];
						$id = $row['id'];
						$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
							foreach($userDetails as $qw):
								$name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];	
							endforeach; 
						?>
						
						{
							
							title: "<?php echo $name;?>",
							url: 'lab_results?id=<?php echo $id;?>',
							start: new Date(<?php echo date('Y',$nestH);?>, <?php echo date('m',$nestH)-1;?>, <?php echo date('d',$nestH);?>),
							end:	new Date(<?php echo date('Y',$nestH);?>, <?php echo date('m',$nestH)-1;?>, <?php echo date('d',$nestH);?>) 
						},
						
						<?php 
						endforeach
						
						?>
					]
					
				});
	});
  </script>
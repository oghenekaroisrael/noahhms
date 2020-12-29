
<?php 
	ob_start();
	session_start();
	$pageTitle = "Lab Results";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
	}
	$db = mysqli_connect("localhost","root","","coastal");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = 'pharm' AND status = 0 ORDER BY id DESC");
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
	include_once '../inc/header-index.php'; //for adding header
	$pat_id = $_GET['pid'];
	$db = mysqli_connect("localhost", "root", "", "coastal");
	$get_id = mysqli_query($db, "SELECT * FROM patient_appointment WHERE patient_id = '".$pat_id."' LIMIT 1");
	if ($get_id) {
		$value1= mysqli_fetch_assoc($get_id);		
		$value = intval($value1['id']);
	}else{
		$value = '-1'; 
	}
?>
<style>
			@media print {
    .no-print{display: none;}
	 @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 30px;
           padding-bottom: 72px ;
           width:100%;
         }
         
}
			</style>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	   <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
				
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                      
                            <?php
							 
							        $notarray =Database::getInstance()->select_from_where2('lab_result','appointment_id', $value);
									$prescrip = "";
									$complain = "";
									$bpst ="";
									$bpsi ="";
									$ecg ="";
									$echo ="";
									$diag = "";
									$pat_note = "";
									$dt = "";
									$tim = "";
										 $notarray =Database::getInstance()->select_from_where2('patient_appointment','id', $value);
										foreach($notarray as $ow):
											$temp = $ow['temperature'];
										    $pp_id = $ow['patient_id'];	
										    $doc_id  = $ow['doctor_id'];
											$weight = $ow['weight'];
											$prescrip = $ow['prescription'];
											$res = $ow['respiratory'];
											$complain = $ow['complaint'];
											$ecg = $ow['ecg_result'];
											$echo = $ow['echo_result'];
											$sugar = $ow['blood_sugar'];
											$rate = $ow['pulse_rate'];
											$diag = $ow['diagnosis'];
											$pat_note = $ow['patients_note'];
											$comp = $ow['complaint'];
											$exam = $ow['examination'];
											$height = $ow['height'];
											$bmi = $ow['bmi'];
											$rbp = $ow['routine_blood_pressure'];
											$spo2 = $ow['spo2'];
											$note = $ow['nurse_complaint'];
											$allergies = $ow['allergies'];
											
											$bpsts = $ow['blood_press_stand_s'];
											$bpstd = $ow['blood_press_stand_d'];
											$bpsis = $ow['blood_press_sit_s'];
											$bpsid = $ow['blood_press_sit_d'];
											
											
											
											$dateTi = $ow['date_time_added'];
											$bpst = '('.$ow['blood_press_stand_s'].'/Sistolic) ('.$ow['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$ow['blood_press_sit_s'].'/Sistolic) ('.$ow['blood_press_sit_d'].'/Diastolic)';
										endforeach; 

										$userDetails = Database::getInstance()->select_from_where('patients', 'id', $pp_id);
											foreach($userDetails as $qw):
												 $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
												 $sex = $qw['sex'];
												 $blood = $qw['blood_group'];
												 $age = $qw['age'];
												 $reg = $qw['reg_num'];
											endforeach; 
										?>
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Doctor's Sheet For <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No. <?php echo $reg;?></p>
										<?php
										    $dt = date('d-m-Y',strtotime($dateTi));
                                            $tim = date('H:i:s',strtotime($dateTi));
                                            
                                            if($diag != ""){
										?>
										    <p class="text-center" style="text-align:center">Diagnosis: <?php echo $diag;?></p>
										    <p class="text-center" style="text-align:center">Date: <?php echo $dt;?></p>
									    	<p class="text-center" style="text-align:center">Time: <?php echo $tim;?></p>
										<?php } ?>
			                            </div>
										

										<div class="clearTwenty"></div>
											<div class="col-md-12">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <p><strong>Age:</strong> <?php echo $age;?></p>
														<p><strong>Sex:</strong> <?php echo $sex;?></p>
														<!--<p><strong>Blood Group:</strong> <?php echo $blood;?></p>-->
														
														<p><strong>Weight:</strong> <?php echo $weight;?><strong>Kg</strong></p>
														<p><strong>Height:</strong> <?php echo$height;?><strong>Cm</strong></p>
														<p><strong>BMI Ratio:</strong> <?php echo $bmi;?><strong>Kg/m2</strong></p>
														<p><strong>Temperature:</strong> <?php echo $temp;?><strong>Degree Celcius</strong></p>
														<p><strong>Pulse Rate:</strong> <?php echo $rate;?><strong>pulse/min</strong></p>
														<p><strong>Respiratory Rate:</strong> <?php echo $res;?><strong>bit/min</strong></p>
														<p><strong>Routine Blood Pressure:</strong> <?php echo $rbp;?><strong>mmH</strong></p>
													
														<p><strong>Saturatory Pressure of Oxygen(SPO2):</strong> <?php echo $res;?><strong>%</strong></p>
														<p><strong>Random Blood Sugar:</strong> <?php echo $sugar;?><strong>mg/dl</strong></p>
														<p><strong>ORTHOSTATIC BLOOD PRESSURE:</strong><strong>MMH</strong></p>
														<p><strong>Diastolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsid;?></strong>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpsts;?>|</p>
														<p> <strong>Sistolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsis;?>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpsts;?>|</p>
														<p style="color:red;font:bold;"><strong>ALLERGIES:</strong> <?php echo $allergies;?></p>												
														<p><strong>Nurse's Note:</strong> <?php echo $note;?></p>
														
													
														
														
		                                            </div>
		                                        </div>
											</div>
										</div>
				<div id="get_result2"></div>				

		<!--//	END of Additional files-->
		
		<div class="container-fluid">
                            	<?php
											$count = 1;
											$countp = 1; 
											$notarray = database::getInstance()->select_from_where2('patient_appointment', 'id', $value);
											foreach($notarray as $row):
											$complaint = $row['complaint'];
											$exam = $row['examination'];
											$diag = $row['diagnosis'];
											$pres = $row['prescription'];
											$pat_note = $row['patients_note'];
											$inst = $row['instruction'];
											$date = $row['date_time_added'];								
											
											$notarray2 = database::getInstance()->select_from_where2('prescription', 'appointment_id', $value);
											
										?>
                            	<div class="row">
                            		<div class="container">
                            			<div class="col-md-6">
                            			<h5> <b>S/N: </b> <?php echo $count++;?></h5>
                            		</div>
	                            	<div class="col-md-6">
	                            		<h5><b>Date: </b> <?php  if(!isset($date )){echo '';}  else{ echo date('d-m-Y', strtotime($date));}?></h5>
	                            	</div>
                            		</div>
                            	</div>
                            <!--here-->
                            <div class="row">
                            	<div class="col-lg-3 text-center N-21" style="height: 78px;">
                            		COMPLAINT
                            	</div>
                            	<div class="col-lg-9 N-212">
                            		<p><?php if(!isset($complaint)){echo '';}else{echo $complaint;} ?></p>
                            	</div>
                            </div>

                            <div class="row">
                            	<div class="col-lg-3 text-center N-22">
                            		EXAMINATION
                            	</div>
                            	<div class="col-lg-9 N-222">
                            		<p><?php if(!isset($exam)){echo '';}else{echo $exam;}?></p>
                            	</div>
                            </div>

                            <div class="row">
                            	<div class="col-lg-3 text-center N-23">
                            		DIAGNOSIS
                            	</div>
                            	<div class="col-lg-9 N-223">
                            		<p><?php  if(!isset($diag)){echo '';}else{echo $diag;}?></p>
                            	</div>
                            </div>



                            <div class="row">
                            	<div class="col-lg-3 text-center N-23" style="background: #055f12; height: 200px;">
                            		TREATMENT PLAN
                            	</div>
                            	<div class="col-lg-9 N-223" style="border-color: #055f12; height: 200px;">
                            		<p><?php  if(!isset($pat_note)){echo '';}else{echo $pat_note;}?></p>
                            	</div>
                            </div>

                            <div class="row">
                            	<div class="col-lg-3 text-center N-24" style="height: 200px;">
                            		PRESCRIPTION
                            	</div>
                            	<div class="col-lg-9 N-224" style="height: 200px;">
                            		<table class="table table-bordered">
                            			<thead>
                            				<th>#</th>
                            				<th>Drug</th>
                            				<th>Tabs</th>
                            				<th>Frequency</th>
                            				<th>Duration</th>
                            				<th>Quantity To Dispense</th>
                            				<th>Instruction</th> 
                            			</thead>
                            			<?php
                            				foreach($notarray2 as $row){
											$pharm = $row['pharm_stock_id'];
											$tabs = $row['tabs'];
											$dur = $row['duration'];											
											$dispense = $row['quantity_dispense'];	
											$stabs = $row['stabs'];
											$sdur = $row['sduration'];
											$sdispense = $row['squantity_dispense'];
											if ($row['dosage'] == 1) {
													$dosage = "DLY";
												}elseif ($row['dosage'] == 2) {
													$dosage = "B.D";
												}elseif ($row['dosage'] == 3) {
													$dosage = "T.D.S";
												}elseif ($row['dosage'] == 4) {
													$dosage = "Q.D.S";
												}
											if ($row['sdosage'] == 1) {
													$sdosage = "DLY";
												}elseif ($row['sdosage'] == 2) {
													$sdosage = "B.D";
												}elseif ($row['sdosage'] == 3) {
													$sdosage = "T.D.S";
												}elseif ($row['sdosage'] == 4) {
													$sdosage = "Q.D.S";
												}
											$inst = $row['instruction'];
										if(isset($pharm)){
											
											
										
											$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id', $pharm);
											foreach($notarray as $row){
											$drug = $row['name'];
											
											}
										}
                            			?>
                            			<tr>
                            				<td><?php echo $count++; ?></td>
                            				<td><?php if(!isset($drug)){echo '';}else{echo $drug;}?></td>
                            				<td><?php if($tabs == 0){echo $stabs;}else{echo $tabs;}?></td>
                            				<td><?php if(!isset($dosage)){echo $sdosage;}else{echo $dosage;}?></td>
                            				<td><?php if($dur == 0){echo $sdur;}else{echo $dur;}?></td>
                            				<td><?php if ($dispense == 0) {echo $sdispense;}else{echo $dispense;} ?></td>
                            				<td><?php if(!isset($inst)){echo '';}else{echo $inst;}?></td>
                            			</tr>
                            			<?php  }?>
                            			<thead>
                            				<th>#</th>
                            				<th>Drug</th>
                            				<th>Tabs</th>
                            				<th>Frequency</th>
                            				<th>Duration</th>
                            				<th>Quantity To Dispense</th>
                            				<th>Instruction</th>
                            			</thead>
                            		</table>
                            	</div>
                            </div>
                            <!--here-->
                            <span class="line">
                            	<?php endforeach;?>
                            	
                        </div>
		
		
		
		
	<!--end extra test-->
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
	
 function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From File List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delExtraFile',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'lab_results?id=<?php echo $value ?>';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function reqad(){ 
		var p_id = <?php echo $pp_id ?>;
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ins=requestAdmission',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if(data == "Done"){
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}
	
		function rexam(){ 
		var p_id = <?php echo $pp_id ?>;
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ins=requestExam',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if(data == "Done"){
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}
		 function myFunction() {
    window.print();
}
</script>

<script type="text/javascript">

	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('#diag').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('#diag').serialize() + "&val=" + id + "&ins=addDiagnosis",
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result3").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changePrescriptionStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var pre_id = currentRow.find("td:eq(0)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, pre_id: pre_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_result2').html(res).show();
						//console.log(res);
				}
			});

		});
		
</script>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>

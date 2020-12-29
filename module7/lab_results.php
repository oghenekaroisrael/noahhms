<?php 
	ob_start();
	session_start();
	$pageTitle = "Case File";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$db = mysqli_connect("localhost","root","","noahhms");
	include_once '../inc/header-index.php'; //for addding header
	$pval = $_GET['p'];
	if (!isset($_GET['id'])) {
		 $value = database::getInstance()->select_from_where_limit1_ord('patient_appointment','patient_id',$pval,'id','DESC');
	}else{
		$value = $_GET['id'];
	}
	$reqpat = Database::getInstance()->count_from('ipd_patients','appointment_id', $value);
	$reqpat2 = Database::getInstance()->count_from('admission_request','appointment_id', $value);
	$reqpat3 = Database::getInstance()->count_from('surgery_perm','appointment_id', $value);
if(isset($_GET['del']) && $_GET['del']==='np'){
    $ante=Database::getInstance()->deleteCategory($value,'patient_appointment');
	header("Location: index");

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
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-8">
						<?php 
							$pinky=mysqli_query($db,"select p.id as appid, st.first_name as docfname,st.last_name as doclname from patient_appointment as p INNER JOIN staff as st on p.doctor_id=st.user_id where p.id=".$value);
                       $zola=$pinky->fetch_assoc();
						 ?>
					</div>
				</div>
				<?php 
					$notarray = database::getInstance()->select_from_where2('patient_appointment','id', $value);
										foreach($notarray as $ow):											
											$temp = $ow['temperature'];
										    $pp_id = $ow['patient_id'];	
										    $doc_id  = $ow['doctor_id'];
											$weight = $ow['weight'];
											$treated = $ow['treated'];
											$prescrip = $ow['prescription'];
											$res = $ow['respiratory'];
											$complain = $ow['complaint'];
											$ecg = $ow['ecg_result'];
											$echo = $ow['echo_result'];
											$sugar = $ow['blood_sugar'];
											$rate = $ow['pulse_rate'];
											$diag = $ow['diagnosis'];
											$adm_note = $ow['adm_note'];
											$pat_note = $ow['patients_note'];
											$comp = $ow['complaint'];
											$exam = $ow['examination'];
											$height = $ow['height'];
											$bmi = $ow['bmi'];
											$rbp = $ow['routine_blood_pressure'];
											$spo2 = $ow['spo2'];
											$note = $ow['nurse_complaint'];
											$allergies = $ow['allergies'];
											$vital_n = $ow['vital_nurse'];
											$bpsts = $ow['blood_press_stand_s'];
											$bpstd = $ow['blood_press_stand_d'];
											$bpsis = $ow['blood_press_sit_s'];
											$bpsid = $ow['blood_press_sit_d'];
											$date_added = date("d M, Y",strtotime($ow['date_added']));
											$doc_type = database::getInstance()->get_name_from_id("name","doctor_types","type_id",$ow['specialty']);
											
											$dateTi = $ow['date_time_added'];
											$bpst = '('.$ow['blood_press_stand_s'].'/Sistolic) ('.$ow['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$ow['blood_press_sit_s'].'/Sistolic) ('.$ow['blood_press_sit_d'].'/Diastolic)';
										endforeach; 
										$userDetails = Database::getInstance()->select_from_where('patients', 'id', $pp_id);
											foreach($userDetails as $qw):
												 $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
												 $sex = $qw['sex'];
												 $blood = $qw['blood_group'];
												 $age = $qw['age'];
												 $reg = $qw['reg_num'];	
												 $crd = $qw['card_type'];
									 			 $fam = $qw['family_id'];
												 $comp_i = $qw['company_id'];
												 $tariff = $qw['tariff'];
												 $pic = $qw['photo'];
											endforeach; 
				 ?>
				 <div class="row" style="margin-bottom: 20px;">
				 	<div class="col-lg-3">
		                <a id="deletebtn" class="btn btn-md pull-left">Delete Casenote</a>
				 </div>
				 <div class="col-lg-3">
				 	<?php 
				 		if ($treated == 0) {
				 			?>
				 					<button class="btn btn-success pull-right" onclick="todoSession(<?php echo $value; ?>,2)">Begin Session</button>
				 			<?php
				 		}
				 	 ?>
		        </div>
		        <div class="col-lg-3">
				 	
				 	<?php 
				 		if ($treated != 1 && $treated != 0) {
				 			?>
				 					<button class="btn btn-danger pull-right" onclick="todoSession(<?php echo $value; ?>,1)">End Session</button>
				 			<?php
				 		}
				 	 ?>
		        </div>
		        <div class="col-lg-3">
		        	<button class="btn btn-flat btn-primary pull-right" onclick="window.location = 'print.php?id=<?php echo $value; ?>&p=<?php echo $pval; ?>'">Print</button>
		        </div>
				 </div>
				 <div class="sess"></div>
				<div class="card">
					<div class="container" style="padding-top: 50px;padding-bottom: 50px;">
						<div class="row">
							 <div class="col-md-6" style="border-right-style: solid;border-right-width: 1px;border-right-color: #ddd; ">
		                        		<div class="col-lg-4">
		                        			<center>
		                        				<img  width="150" height="150" class="img img-circle" src="../photo/<?php echo $pic; ?>">
		                        			</center>
		                        		</div>

		                        	<div class="col-lg-8">
		                        		<div class="row">
																															<h3 class="h3"><?php echo $name2; ?></h3>
		                        					<div class="col-lg-6">
		                        						<center>
		                        							<h4><?php echo $reg;?></h4>
		                        							<span>Reg Number</span>
		                        						</center>
		                        					</div>

		                        					<div class="col-lg-6">
		                        						<center>
		                        								<?php 
		                        							 		if ($crd == 19) { ?>
		                        							 			<h4><?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>HMO Tariff: <?php echo Database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);?></span>
																																													<?php
																																												}else if($crd == 11){
																																													?><h4>
																																													Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>Company Name: <?php echo Database::getInstance()->get_name_from_id('company_name','companies','id',$comp_i);?></span>
																																													<?php
																																												}else if($crd == 20){
																																													?>
																																													<h4>Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>Family Name: <?php echo Database::getInstance()->get_name_from_id('family_name','families','id',$fam);?></span>

																																													<?php
																																												}else{
																																													?>
																																													<h4><?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4><span>Card Type</span>
																																													<?php
																																												} ?>
		                        							 </h4>
		                        						</center>
		                        					</div>

		                        				</div>
		                        			</center>
		                        		</div>
		                     </div>
		                     <div class="col-md-6" id="detss">
		                     	<div class="row">
		                     		<div class="col-lg-6">
		                     			<label>Sex: </label>
		                     			<strong><?php echo $sex; ?></strong>
		                     		</div>

		                     		<div class="col-lg-6">
		                     			<label>Check-in: </label>
		                     			<strong><?php echo $date_added; ?></strong>
		                     		</div>
		                     </div>

		                     <div class="row">
		                     	<div class="col-lg-6">
		                     			<label>Age: </label>
		                     			<strong><?php echo $age; ?></strong>
		                     		</div>
		                     		<div class="col-lg-6">
		                     			<label>Department: </label>
		                     			<strong><?php echo $doc_type; ?></strong>
		                     		</div>		
		                     </div>

		                     <div class="row">
		                     		<div class="col-lg-6">
		                     			<label>Blood Group: </label>
		                     			<strong><?php echo $blood; ?></strong>
		                     		</div>
		                     		<div class="col-lg-6">
		                     			<label>Doctor: </label>
		                     			<strong><?php echo $zola['docfname']." ". $zola['doclname'] ?></strong>
		                     		</div>
		                     </div>
		                </div>
					</div>
				</div>
</div>
				<div class="row" id="vital_signs">
					 	<div class="col-lg-2">
					 				<div class="card active">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>SYS</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-chair"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $bpsis; ?><small>mmHg</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>DIA</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-chair"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $bpsid; ?><small>mmHg</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Pulse</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-heartbeat"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $rate; ?><small>pulse/min</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Weight</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-weight"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo number_format($weight,2); ?><small>kgs</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Height</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-tape"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo number_format($height,2); ?><small>cm</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>BMI</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fab fa-cloudscale"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo number_format($bmi,2); ?><small>Kg/m<sup>2</sup></small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>SYS</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-male"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $bpsts; ?><small>mmHg</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>DIA</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-male"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $bpstd; ?><small>mmHg</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Temp</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-temperature-high"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $temp; ?><small><sup>o</sup>C</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Blood Sugar</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-tint"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $sugar; ?><small>mg/dl</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>SPO<sub>2</sub></strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-percent"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $spo2; ?><small>%</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>Respiratory Rate</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-lungs"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $res; ?><small>beats/min</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>

					 	<div class="col-lg-2">
					 				<div class="card">
					 						<div class="row" style="padding: 20px 20px;">
					 										<div class="pull-left">
					 														<strong>RBP</strong>
					 										</div>

					 										<div class="pull-right">
					 														<i class="fas fa-drop"></i>
					 										</div>

					 										<div class="text-center">
					 														<h2><?php echo $rbp; ?><small>mmH</small></h2>
					 										</div>
					 						</div>
					 										
					 				</div>
					 	</div>
				</div>

				<div class="card" style="margin-top: 50px;padding: 20px;">
					<div class="row">
						<div class="col-lg-4">
							<label>ALLERGIES</label><br>
							<strong><?php echo $allergies;?></strong>
						</div>

						<div class="col-lg-4">
							<label>Nurse's Note</label><br>
							<strong><?php echo $note;?></strong>
						</div>

						<div class="col-lg-4">
							<label>Vital's Taken By </label><br>
							<strong><?php echo $vital_nurse;?></strong>
						</div>
					</div>
				</div>

				<div class="card">
					<ul class="nav nav-tabs nav-tabs-bottom" id="mytb">
        <li class="nav-item active"><a class="nav-tab" href="#bottom-tab1" data-toggle="tab" role="tab">Prescriptions</a></li>
        <li class="nav-item"><a class="nav-tab" href="#bottom-tab2" data-toggle="tab" role="tab">Notes</a></li>
        <li class="nav-item"><a class="nav-tab" href="#bottom-tab3" data-toggle="tab" role="tab">Results</a></li>
        <li class="nav-item"><a class="nav-tab" href="#bottom-tab4" data-toggle="tab" role="tab">Appointment History</a></li>
     </ul>

                            <div class="tab-content" style="padding-bottom: 50px;">
                            	<!--Presciptions-->
                                <div class="tab-pane active" id="bottom-tab1" role="tabpanel">
                                	<div class="container">
                                		<div class="row">
																										 <div class="col-md-12">
																										  	<div class="header">
																										  		<h3 class="h3" style="font-family: raleway;">Prescriptions</h3> 
																										  	</div> 
																										  	<a class="btn btn-info" href="print_prescription?ref=<?php echo $_GET['id']; ?>">Print</a>
																					        <div class="content" style="height: 300px;overflow-y: scroll;">
																					          <table id="pro"class="table table-striped table-hover">
																					           <thead>
																														    <th>#</th>
																					             <th>Drug</th>
																					             <th>Tabs</th>
																					             <th>Frequency</th>
																					             <th>Duration (Days)</th>
																					             <th>Instruction</th>
																					             <th>Doctor</th>
																					             <th>Date</th>
																															 	<th>Medication Status</th>
																					            <th>Change Status</th>
																					          </thead>
																					          <tbody>
																																	  <?php
																																			$count = 1; 
																																			$nogray =Database::getInstance()->select_from_prescription($value);
																																			foreach($nogray as $oow):
																																			$diagnosis = $oow['diagnosis'];
																																			$pre_id = $oow['prescription_id'];
																																			$name = $oow['name'];
																																			$tabs = $oow['tabs'];
																																			if ($oow['dosage'] == 1) {
																																				$dosage = "DLY";
																																			}elseif ($oow['dosage'] == 2) {
																																				$dosage = "B.D";
																																			}elseif ($oow['dosage'] == 3) {
																																				$dosage = "T.D.S";
																																			}elseif ($oow['dosage'] == 4) {
																																				$dosage = "Q.D.S";
																																			}elseif ($oow['dosage'] == 5) {
																																				$dosage = "STAT";
																																			}elseif ($oow['dosage'] == 6) {
																																				$dosage = "NOCT";
																																			}

																																			$stabs = $oow['stabs'];
																																			if ($oow['sdosage'] == 1) {
																																				$sdosage = "DLY";
																																			}elseif ($oow['sdosage'] == 2) {
																																				$sdosage = "B.D";
																																			}elseif ($oow['sdosage'] == 3) {
																																				$sdosage = "T.D.S";
																																			}elseif ($oow['sdosage'] == 4) {
																																				$sdosage = "Q.D.S";
																																			}elseif ($oow['sdosage'] == 5) {
																																				$sdosage = "STAT";
																																			}elseif ($oow['sdosage'] == 6) {
																																				$sdosage = "NOCT";
																																			}
																																			$duration = $oow['duration'];
																																			$sduration = $oow['sduration'];
																				 															$instruction = $oow['instruction'];
																																			$doctor = $oow['first_name'].' '.$oow['last_name'];
																																			$date = $oow['pdate_added'];
																																			$status = $oow['prescription_status'];
																																		?>
																								                                    <tr>
																								                                        	<td><?php echo $count++;?></td>
																								                                        	<td><?php echo $name;?></td>
																								                                        	<td><?php if(!empty($tabs) AND $tabs != 0){echo $tabs;}else{echo $stabs;}?></td>
																								                                        	<td><?php if(!empty($dosage) AND $dosage != 0){echo $dosage;}else{echo $sdosage;}?></td>
																								                                        	<td><?php if(!empty($duration) AND $duration != 0){echo $duration;}else{echo $sduration;}?></td>
																								                                        	<td><?php echo $instruction;?></td>
																								                                        	<td><?php echo $doctor;?></td>
																								                                        	<td><?php echo $date;?></td>
																																			<td><?php  
																				                                        			if($status == 1){
																				                                        				echo "stopped";
																				                                        			} elseif($status== 0){
																				                                        				echo "Taking";
																				                                        			}elseif($status == 2){
																																		echo "completed";
																																	}else{
																																		
																																		echo"Select";
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
																																						echo 'Taking';
																																						break;
																																					
																																						case 1:
																																						echo 'Stopped';
																																						break;
																																									
																																						case 2:
																																						echo 'Completed';
																																						break;
																						
																																						default:
																																						echo 'Select';
																																					}
																																								 
																																				?>
																																			</option>
																																			<option value="0">Taking</option>
																																			<option value="1">Stopped</option>
																																			<option value="2">Completed</option>
																																		</select>
																																	</form>
																																</td>			
																															</tr>
																																<?php endforeach;?>
																															</tbody>
																											        </table>
																											</div>
																										</div>
				</div>
                                	</div>
                                	
  </div>
                                <!--/. Prescriptions-->

                                <!--Notes-->
                                <div class="tab-pane" id="bottom-tab2" role="tabpanel">
	                                	<div class="container">

						 <div id="get_result3"></div>
	                                			 <div class="header">
                                <h4 class="title">DOCTOR'S NOTE</h4>
                            </div>
							
                            <div class="content">
                                 <form id="diag">
								 
								 <div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Complaint</label>
	                                                <textarea class="form-control" style="white-space: wrap;" name="complaint" placeholder="Complaint" rows="5"><?php echo $comp;?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Examination</label>
	                                                <textarea class="form-control" name="exam" placeholder="Examination" rows="5"><?php echo $exam;?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Diagnosis</label>
	                                                <textarea class="form-control" name="diagnosis" placeholder="Diagnosis" rows="5"><?php echo $diag;?></textarea>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>

									
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Treatment Plan</label>
	                                                <textarea class="form-control"  style="white-space: wrap;" name="patients_note" placeholder="Treatment  Plan" rows="5"><?php echo $pat_note = trim(str_replace( "<br/>","\n", $pat_note));?></textarea>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php $n = database::getInstance()->count_it("ipd_patients","appointment_id",$value); ?>
									<div class="col-md-12" style="display: <?php if ($n>0) {echo "block;";}else{echo "none;";} ?>">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admission Note</label>
	                                                <textarea class="form-control" name="adm_note" placeholder="Admission Note" rows="5"><?php echo $adm_note = trim(str_replace( "<br/>","\n", $adm_note));?></textarea>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
						
						</div>
	                                	</div>
                                </div>
                                <!--/. Notes-->

                                <!--Results-->
                                <div class="tab-pane" id="bottom-tab3" role="tabpanel">
	                                	<div class="container">
	                                				<div class="content">
                            	<div class="row">
									 <div class="col-md-12">
				                        
											
											 <div class="row">
											 	<div class="header">
											 		Lab Results
											 	</div>
											 	<div class="col-lg-12 jumbotron">
											 		<?php
												$count = 1; 
												$ntray =Database::getInstance()->select_from_where_ord('patient_test_group','patient_appointment_id', $value,'patient_test_group_id','DESC');
												foreach($ntray as $rw):
												$res = $rw['awaiting_result'];
												$poiid = $rw['link_ref'];
												$vclas = "waiBtn";
												$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Result";
												if($res == 1){
													$vclas = "waiSuc";
													$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Result";
												}
											?>
				                            <a style="color:#fff;" href = "view_test?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php endforeach;?>


											<?php
											//SENT FROM FRONT DESK Specific Doctor
												$count = 1; 
												$ptid = $_GET['p'];
												$db =mysqli_connect("localhost","root","","noahhms");
												$send_test = mysqli_query($db, "SELECT * FROM `send_test` WHERE `staff_to` = $user_id AND patient_id = $ptid");
												while ($rw = mysqli_fetch_assoc($send_test)) {
													$pat = $rw['patient_id'];
													$link2 = $rw['link']; 
													$vclas = "sentlab";
													$statem = "Lab Test From Front Desk ".$rw['time'];
													if($rw['status'] == 1){
													$vclas = "sentlab2";
													$statem = "View Lab Result From Front Desk ".$rw['time'];
												}
											?>
				                            <a style="color:#fff;" href = "view_test_front?id=<?php echo $link2;?>&pid=<?php echo $patient_id; ?>&did=<?php echo $user_id; ?>&stat=1"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php }?>
											 	</div>
											 </div>

											 <div class="row">
											 	<div class="header">
											 		Xray Results
											 	</div>
											 	<div class="col-lg-12 jumbotron">
											<?php
												$count = 1; 
												$ntray =Database::getInstance()->select_from_where_ord('patient_xray_group','patient_appointment_id', $value,'patient_xray_group_id','DESC');
												foreach($ntray as $rw):
												$res = $rw['awaiting_result'];
												$poiid = $rw['link_ref'];
												$vclas = "waiBtn2";
												$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Xray";
												if($res == 1){
													$vclas = "waiSuc2";
													$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Xray";
												}
											?>
				                            <a style="color:#fff;" href="view_xray?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>" class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php endforeach;?>
											</div>
										</div>
										<div class="row">
											 	<div class="header">
											 		Scan Results
											 	</div>
											 	<div class="col-lg-12 jumbotron">
											<?php
												$count = 1; 
												$ntray =Database::getInstance()->select_from_where_ord('patient_scan_group','patient_appointment_id', $value,'patient_scan_group_id','DESC');
												foreach($ntray as $rw):
												$res = $rw['awaiting_result'];
												$poiid = $rw['link_ref'];
												$vclas = "waiBtn2";
												$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Scans";
												if($res == 1){
													$vclas = "waiSuc2";
													$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Scans";
												}
											?>
				                            <a style="color:#fff;" href="view_scans?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>" class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php endforeach;?>
										</div>
									</div>

											

											<!--<?php
											//SENT FROM FRONT DESK All Doctors
												$count = 1; 
												$ntray2 = Database::getInstance()->select_from_front_desk_id($value,$pp_id,$user_id);
												foreach($ntray2 as $rw2):
													$pat = $rw2['patient_id'];
													$link = $rw2['link_ref']; 
													$vclas = "sentlab";
													$db =mysqli_connect("localhost","root","","noahhms");
													$gt = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$pp_id." LIMIT 1");
													$name = mysqli_fetch_assoc($gt);
													if($rw2['seen_result'] == 1){
													$vclas = "sentlab2";
													$statem = "View Lab Result From Front Desk For ".$name['surname']." ".$name['first_name'];
												}

													$statem = "Requested Lab Test From Front Desk For ".$name['surname']." ".$name['first_name'];
											?>
				                            <a style="color:#000;" href = "view_test_front?id=<?php echo $link;?>&pid=<?php echo $pat; ?>&did=<?php echo $user_id; ?>&stat=1&front=<?php echo $rw2['front_desk']; ?>"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php endforeach;?>-->

											

				                        </div>
				                 </div>
                            </div>
	                                	</div>
                                </div>
                                <!--/. Results-->

                                <!-- History-->
                                <div class="tab-pane" id="bottom-tab4" role="tabpanel">
	                                	<div class="container">
	                                		<div class="row">
	                                			<div class="col-md-4 text-center">
	                                				<h4><b>Date</b></h4>
	                                			</div>
	                                			<div class="col-md-8 text-center">
	                                				<h4><b>Diagnosis</b></h4>
	                                			</div>
	                                		</div>
	                                				<?php 
																																													$apps = database::getInstance()->select_from_where_ord("patient_appointment","patient_id",$_GET['p'],"id","DESC");
																																													foreach ($apps as $app1) {
																																														$l = $app1['id'];

	                                													$hex = "#".substr(md5(mt_rand()), 0,6);
																																														if ($l == $value) {
																																															?>
																																															<div onclick="window.location='lab_results.php?p=<?php echo $pval; ?>&id=<?php echo $l; ?>'" class="row" style="margin-bottom:10px;border-left-style: solid;border-left-width: 2px;border-left-color: <?php echo $hex; ?>;">
																																																				<div class="col-md-4 text-center">Current Appointment</div>
																																																				<div class="col-md-8 text-center"><?php echo $app1['diagnosis']; ?></div>
																																															</div>
																																															<?php
																																															}else{
																																																?>
																																																<div onclick="window.location='lab_results.php?p=<?php echo $pval; ?>&id=<?php echo $l; ?>'" class="row" style="border-left-style: solid;border-left-width: 2px;border-left-color: <?php echo $hex; ?>;">
																																																				<div class="col-md-4 text-center"><?php echo $app1['date_added']; ?></div>
																																																				<div class="col-md-8 text-center"><?php echo $app1['diagnosis']; ?></div>
																																															</div>
																																																<?php
																																																}
																																													}
	                                				 ?>
	                                	</div>
                                </div>
                                <!--/. History-->
                            </div>
				</div>

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
									$adm_note = "";
									$dt = "";
									$tim = "";
										 
										$vital_nur = Database::getInstance()->select_from_where('staff','user_id',$vital_n);
										foreach ($vital_nur as $nurse) {
											$vital_nurse = "Nurse ".$nurse['last_name']." ".$nurse['first_name']." ".$nurse['other_names'];
										}
										
										?>
										
	 
	                    <div class="content no-print">


	
	
	
	<div class="no-print"style="padding-bottom:45px;">
			

			<?php ?>
			<!-- echeck if request was sent by doctor-->
			
			<?php if($reqpat < 1 && $reqpat2 < 1){?>
													<button type="button" class="btn btn-primary col-md-3 btn-flat btblack" onclick="reqad();"><i class="entypo-plus-circled"></i>Request For Admission</button>
			<?php } ?>
			

			<?php if($reqpat2 >= 1){
				$ift = Database::getInstance()->get_name_from_id('status','admission_request','appointment_id', $value);
				if($ift == 1){
					$hclas = "waiSuc";
					$wors = "Successful";
				}else{					
					$hclas = "waiBtn";
					$wors = "Pending";
				}
			
			?>
			
			<a  class="btn btn-primary col-lg-3 btn-flat <?php echo $hclas;?>" id="addre">
				Admission Request <?php echo $wors;?>
			</a>

			<?php } ?>
			
			
			<a href="injections?id=<?php echo $value; ?>" class="btn btn-primary col-lg-3 btn-flat btblack"><i class="entypo-plus-circled"></i>Request For Injection</a>
			
			
			<?php if($reqpat3 >= 1){
				$ift = Database::getInstance()->get_name_from_id('status','surgery_perm','appointment_id', $value);
				$sur_date = Database::getInstance()->get_name_from_id('surgery_date','surgery_perm','appointment_id', $value);
				if($ift == 1){
					$hclas = "waiSuc";
					$wors = "Processed";
				}else{
					$hclas = "waiBtn";
					$wors = "Pending";
				}
			
			?>
			<a href="surgery?id=<?php echo $value; ?>&pid=<?php echo $ptid; ?>" style="margin-bottom:10px;" class="btn btn-primary col-md-3 btn-flat <?php echo $hclas;?>" id="addre">
				Surgery Scheduled For <?php echo $sur_date;?> <?php echo $wors;?>
			</a> 
			<?php } ?>
			
			</div>

			<div id="anyres">
				<?php 
					if ($_GET['res'] == 'Done') {
						?>
						<div class="alert alert-success">
							<strong>Physiotherapy</strong> Request Was Successful!
						</div>
						<?php
					}
				?>
			</div>
			<div id="adres" style="display: none;">
						<div class="alert alert-success">
							<strong>Admission</strong> Request Was Successful!
						</div>
			</div>					
	<!--------- MANAGEMENT and INVESTIGATION  ---->								
									
									
	                    <div class="content no-print">
            <div class="container-fluid">
<?php 
	$db = mysqli_connect("localhost","root","","noahhms");
	$get_pat = mysqli_query($db,"SELECT * FROM accounts WHERE item = 5 AND  patient_id = ".$pp_id." LIMIT 1");
	$get_pati = mysqli_fetch_assoc($get_pat);
	$font = mysqli_query($db, "SELECT front_desk FROM patients WHERE id = ".$pp_id." LIMIT 1");
	$front = mysqli_fetch_assoc($font);
?>
							
                            <div class="content">
										<div class="row">
	              <div class="col-md-4">
																			 <div class="btn-group">
																				<button type="button" class="btn btn-info">Investigative Requests</button>
																				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																				<span class="caret"></span>
																				<span class="sr-only">Toggle Dropdown</span>
																				</button>
																				<ul class="dropdown-menu" role="menu">
																					<li><a href="request_test?id=<?php echo $value;?>">Request Test</a></li>
																					
																					<li class="divider"></li>
																					<li >
																					
																					<a href="request_physiotherapy.php?pid=<?php echo $pp_id; ?>&staff=<?php echo $user_id; ?>&app=<?php echo $value; ?>&front=<?php echo $front['front_desk']; ?>">Request Physiotheraphy</a></li>
																					<li class="divider"></li>
																					<li><a href="xray_request.php?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>">Request Xray</a></li>

																					<li class="divider"></li>
																					<li><a href="scan_request.php?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>">Request Scan</a></li>
																				
																				</ul>
																			</div> 
	               </div>
	               
	               <div class="col-md-4">
	               			<div class="btn-group">
													<button type="button" class="btn btn-info">Management Requests</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu"  style="">
														<li><a href="patient_details?id=<?php echo $value;?>">Prescription</a></li>
														
													
														<li class="divider"></li>
														<li><a href="new_surgery?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>">Request Surgery</a></li>
													</ul>
												</div>                          	
	               </div>
										</div>
									
									</div>
            
            </div>
			 
        </div>
	 <!-- //investigation -->

<div id="anyres"></div>      
</div>
	 <!-- //management -->               


	<!--end extra test-->
						</div>
                    </div>
                 </div>

                 <div class="card">
                 					<div class="content no-print">
   <div class="row">
					<div class="col-md-12">
							<h3 class="text-center">Additional Files</h3>
				   <div class="card">
				   <div class="content table-responsive table-full-width">
				                                <table id="pro"class="table table-hover table-striped">
				                                    <thead>
														<th>#</th>
				                                        <th>File</th>
				                                        <th>Date Uploaded</th>
				                                        <th>Action</th>
				                                    </thead>
				                                    <tbody>
													  <?php
															$count = 1; 
															$notray =Database::getInstance()->select_from_where_ord('extra_file','patient_appointment_id', $value,'extra_file_id','DESC');
															foreach($notray as $row):
															$id = $row['extra_file_id'];
															$file = $row['name'];
															$date = $row['date_uploaded'];
														?>
				                                        <tr>
				                                        	<td><?php echo $count++;?></td>
				                                        	<td><?php echo $file;?></td>
				                                        	<td><?php echo $date;?></td>
				                                        	<td>
																<div class="btn-group">
																	<button type="button" class="btn btn-info">Action</button>
																	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																	<span class="caret"></span>
																	<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	<ul class="dropdown-menu" role="menu">
																		<li><a onclick="download<?php echo $id; ?>()">Download File</a></li>
																		<li class="divider"></li>
																		<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $file; ?>')">Delete</a></li>
																	</ul>
																</div>
															</td>
				                                        </tr>
														<script type="text/javascript">

														function download<?php echo $id; ?>(){
														document.getElementById("load").style.display = "block";
														var fil = '<?php echo $file; ?>';
														var ins = 'extra';
														window.location = '../func/download?fil='+fil+'+&ins='+ins;
														document.getElementById("load").style.display = "none";
														}
                                                         </script>
														
									 
														<?php endforeach;?>
				                                    </tbody>
				                                 <thead>
														<th>#</th>
				                                        <th>File</th>
				                                        <th>Date Uploaded</th>
														<th>Action</th>
				                                    </thead>
												</table>

				                            </div>
				                           </div>
										<a href='upload_doc?id=<?php echo $value;?>&pid=<?php echo $pp_id; ?>' class="btn btn-info btn-fill pull-right">Upload Extra Files</a>
				                    </div>
				               
							   </div>
							   
							   <button onclick="goBack()"  class="btn btn-info">Go Back</button>
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

	s("#deletebtn").on("click",function(){

	    var pex=window.confirm("are you sure you want to delete this casenote?");
	    if(pex){
            window.location = 'lab_results.php?id=<?php echo $value;?>&p=<?php echo $_GET['p']; ?>&del=np';
        }

    });
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
					document.getElementById("adres").style.display = "block";
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}

		/*function Physiotheraphy(pid,staff,app,front_desk){ 
		var pid = pid; 
		var app = app;
		var staff = staff;
		var front_desk = front_desk;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "app=" + app +  '&pid=' + pid +  '&staff=' + staff + '&front=' + front_desk + '&ins=request_physiotherapy',
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
		}*/
	
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
		function todoSession(app,id) {
                    f.ajax({
                        url: 'session.php',
                        method: 'POST',
                        data: "app="+app+"&id="+id,
                        success: function (res) {
                            if (res == "Done" || res == "Done2"){
                            					window.location = "lab_results?p=<?php echo $_GET['p']; ?>&id=<?php echo $_GET['id']; ?>";
                            }
                        }
                    })
                }
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changePrescriptionStatus';
			var pre_id = "<?php echo $pre_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, pre_id: pre_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					if (res == "Done") {
						location.reload();
					}
						//console.log(res);
				}
			});

		});
		
function goBack() {
  window.history.back();
}
</script>
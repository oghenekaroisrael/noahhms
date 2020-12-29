
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
	include_once '../inc/header-index.php'; //for addding header
	$value = $_GET['id'];
	$reqpat = Database::getInstance()->count_from('ipd_patients','appointment_id', $value);
	$reqpat2 = Database::getInstance()->count_from('admission_request','appointment_id', $value);
	$reqpat3 = Database::getInstance()->count_from('exam_request','appointment_id', $value);
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
									$adm_note = "";
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
												 $crd = $qw['card_type'];
												 $fam = $qw['family_id'];
												 $comp_i = $qw['company_id'];

											endforeach; 
										?>
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Doctor's Sheet For <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No: <?php echo $reg;?></p>
										<?php
											if ($crd == 19) {
												?>

												<?php
											}else if($crd == 11){
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<p class="text-center" style="text-align:center">Company Name: <?php echo Database::getInstance()->get_name_from_id('company_name','companies','id',$comp_i);?></p>
												<?php
											}else if($crd == 20){
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<p class="text-center" style="text-align:center">Family Name: <?php echo Database::getInstance()->get_name_from_id('family_name','families','id',$fam);?></p>
												<?php
											}else{
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<?php
											}
										?>
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
													
														<p><strong>Saturatory Pressure of Oxygen(SPO2):</strong> <?php echo $spo2;?><strong>%</strong></p>
														<p><strong>Random Blood Sugar:</strong> <?php echo $sugar;?><strong>mg/dl</strong></p>
														<p><strong>ORTHOSTATIC BLOOD PRESSURE:</strong><strong>MMH</strong></p>
														<p><strong>Diastolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsid;?></strong>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpstd;?>|</p>
														<p> <strong>Sistolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsis;?>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpsts;?>|</p>
														<p style="color:red;font:bold;"><strong>ALLERGIES:</strong> <?php echo $allergies;?></p>												
														<p><strong>Nurse's Note:</strong> <?php echo $note;?></p>
													
														
														
		                                            </div>
		                                        </div>
											</div>
										</div>
										
								
							
							
							
							<div class="content no-print">
                            	<div class="row">
									 <div class="col-md-12">
									  <h3 class="text-center">Prescriptions/ History</h3>  
				                            <div class="content">
				                                <table id="pro"class="table table-bordered">
				                                    <thead>
													<!--	<th>#</th> -->
				                                    <!--    <th>Diagnosis</th>-->
													    <th>Prescription ID</th>
				                                        <th>Drug</th>
				                                        <th>Tabs</th>
				                                        <th>Frequency</th>
				                                        <th>Duration (Days)</th>
				                                        <th>Instruction</th>
				                                        <th>Doctor</th>
				                                        <th>Date</th>
														 <th>Medication Status</th>
				                                         <th>Change Status</th>
				                                        <!-- <th>Edit</th>
				                                         <th>Delete</th>-->
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
															}
															$duration = $oow['duration'];
															$sduration = $oow['sduration'];
 															$instruction = $oow['instruction'];
															$doctor = $oow['first_name'].' '.$oow['last_name'];
															$date = $oow['pdate_added'];
															$status = $oow['prescription_status'];
														?>
				                                        <tr>
				                                        	<td><?php echo $pre_id;?></td>
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
                                        		?></td>
				                                        	<td><form>
													<select id="status" class="form-control" name="status">
														
														<option value="<?php echo $status;?>" onchange="myFunction()">
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
											<!--<td>
												<a class="btn btn-info btn-flat"  href="edit_presc.php?p=<?php echo $pre_id; ?>&id=<?php echo $value; ?>"><i class="fas fa-edit" style="position: relative;left: 10px;font-size: 18px;"></i></a>
											</td>
											<td>
												<a class="btn btn-info btn-flat" style="background: red;border-color: red;"  href="del_presc.php?p=<?php echo $pre_id; ?>&id=<?php echo $value; ?>"><i class="fas fa-trash" style="position: relative;left: 10px;font-size: 18px;"></i></a>	
											</td>   -->                                 								
										</tr>
														
														<?php endforeach;?>
														
										
				                                    </thead>
				                                    </tbody>
				                                 
												</table>

				                            </div>

				                  
										
				                    </div>
				                 </div>
								  <button onclick="goBack()"  class="btn btn-info">Go Back</button>
								 
                            </div>
                            

							 
				
				<div id="get_result2"></div>				

                             <!-- //diagnose -->
	 
	                    <div class="content no-print">
            <div class="container-fluid">
	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
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
	                                                <textarea class="form-control" style="white-space: nowrap;" name="complaint" placeholder="Complaint" rows="5"><?php echo $comp;?></textarea>
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
	                                                <textarea class="form-control"  style="white-space: nowrap;" name="patients_note" placeholder="Treatment  Plan" rows="5"><?php echo $pat_note = trim(str_replace( "<br/>","\n", $pat_note));?></textarea>
	                                               
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
						 <div id="get_result3"></div>
                    </div>
                </div>

				
			
            </div>
        </div>
	 <!-- //diagnose -->

	<div class="content">
                            	<div class="row">
									 <div class="col-md-12">
				                        
											
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
												$count = 1; 
												$ntray =Database::getInstance()->select_from_where_ord('patient_xray_group','patient_appointment_id', $value,'patient_xray_group_id','DESC');
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
				                            <a style="color:#fff;" href="view_xray?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>" class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
												<?php echo $statem;?>
											</a>
											
											<?php endforeach;?>


											<?php
											//SENT FROM FRONT DESK Specific Doctor
												$count = 1; 
												$db =mysqli_connect("localhost","root","","noahhms");
												$send_test = mysqli_query($db, "SELECT * FROM `send_test` WHERE `staff_to` = ".$user_id."");
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
	
	
	
	<div class="no-print"style="padding-bottom:45px;">
			

			<?php ?>
			<!-- echeck if request was sent by doctor-->
			
			<?php if($reqpat < 1 && $reqpat2 < 1){?>
												<div class="btn-group">
													<button type="button" class="btn btn-primary pull-left btn-flat btblack"><i class="entypo-plus-circled"></i>Request For Admission</button>
													<button type="button" class="btn btn-primary btn-flat btblack dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li>
															<a onclick="reqad(1);">General Male Ward</a>															
														</li>														
														<li class="divider"></li>
														<li>														
															<a onclick="reqad(2);">General Female Ward</a>
														</li>
														<li class="divider"></li>
														<li>															
															<a onclick="reqad(3);">VIP Ward</a>
														</li>
														<li class="divider"></li>
														<li>															
															<a onclick="reqad(4);">Maternity Ward</a>
														</li>
														</ul>
												</div> 
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
			
			<a  style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat <?php echo $hclas;?>" id="addre">
				Admission Request <?php echo $wors;?>
			</a>

			<?php } ?>
			
			
			<?php if($reqpat3 < 1){?>
			<div class="btn-group">
													<button type="button" class="btn btn-primary pull-left btn-flat btblack"><i class="entypo-plus-circled"></i>Request Examination</button>
													<button type="button" class="btn btn-primary btn-flat btblack dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li>
															<a onclick="rexam(1);">General Male Ward</a>															
														</li>														
														<li class="divider"></li>
														<li>														
															<a onclick="rexam(2);">General Female Ward</a>
														</li>
														<li class="divider"></li>
														<li>															
															<a onclick="rexam(3);">VIP Ward</a>
														</li>
														<li class="divider"></li>
														<li>															
															<a onclick="rexam(4);">Maternity Ward</a>
														</li>
														</ul>
												</div> 
			<?php } ?>
			
			<?php if($reqpat3 >= 1){
				$ift = Database::getInstance()->get_name_from_id('status','exam_request','appointment_id', $value);
				if($ift == 1){
					$hclas = "waiSuc";
					$wors = "Successful";
				}else{
					$hclas = "waiBtn";
					$wors = "Pending";
				}
			
			?>
			<a  style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat <?php echo $hclas;?>" id="addre">
				Examination Request <?php echo $wors;?>
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
	
          
                                <h4 class="title">INVESTIGATION</h4>
<?php 
	$db = mysqli_connect("localhost","root","","noahhms");
	$get_pat = mysqli_query($db,"SELECT * FROM accounts WHERE item = 5 AND  patient_id = ".$pp_id." LIMIT 1");
	$get_pati = mysqli_fetch_assoc($get_pat);
	$font = mysqli_query($db, "SELECT front_desk FROM patients WHERE id = ".$pp_id." LIMIT 1");
	$front = mysqli_fetch_assoc($font);
?>
							
                            <div class="content">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            
												
												 <div class="btn-group">
													<button type="button" class="btn btn-info" style="width:1000px;">Investigation</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu"  style="width:1000px;">
														<li><a href="request_test?id=<?php echo $value;?>">Request Test</a></li>
														
														<li class="divider"></li>
														<li >
														
														<a href="request_physiotherapy.php?pid=<?php echo $pp_id; ?>&staff=<?php echo $user_id; ?>&app=<?php echo $value; ?>&front=<?php echo $front['front_desk']; ?>">Request Physiotheraphy</a></li>
													
														<!--<li class="divider"></li>
														<li><a>Request ECG</a></li>
														
														<li class="divider"></li>
														<li><a>Request ECHO</a></li>-->
														
														<li class="divider"></li>
														<li><a href="xray_request.php?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>">Request Xray</a></li>
														
														<!--<li class="divider"></li>
														<li><a>Request Ultrasound</a></li>-->
														
													
													</ul>
												</div> 
										
												
												<div class="form-group">
	                                               
	                                                
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									</div>
            
            </div>
			 
        </div>
	 <!-- //investigation -->

<div id="anyres"></div>
		
			<div class="content no-print">
            <div class="container-fluid">
                      
                        
                                <h4 class="title">MANAGEMENT</h4>
                              <div class="content">								
									<div class="col-md-12">
										<div class="row">
										
	                                       <div class="col-md-12">
	                                           <div class="btn-group">
													<button type="button" class="btn btn-info" style="width:1000px;">Management</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu"  style="width:1000px;">
														<li><a href="patient_details?id=<?php echo $value;?>">Prescription</a></li>
														
													
														<li class="divider"></li>
														<!--<li><a>Request Injection</a></li>
														<li class="divider"></li>
														<li><a>Dressing</a></li>
													
														<li class="divider"></li>-->
													   
													</ul>
												</div> 
												
												
												
												
												
	                                            
	                                               
	                                            </div>
	                                        </div>
										</div>	
										</div>
										
									</div>
	
                    
            </div>
        </div>
	 <!-- //management -->               
		
	<!--Additional files-->
				
	
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
                            
		
		
		
		
		
		
		
		
		<!--//	END of Additional files-->
		
		
		
		
		
		
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
		
		function reqad(ID){ 
		var p_id = <?php echo $pp_id ?>; 
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>;
		var ward = ID; 
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ward=' + ward + '&ins=requestAdmission',
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
	
		function rexam(ID){ 
		var p_id = <?php echo $pp_id ?>;
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ward=' + ID + '&ins=requestExam',
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

<?php 
	ob_start();
	session_start();
	$pageTitle = "Print Case File";
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
	include_once '../inc/header-index.php'; //for addding header
	$value = $_GET['id'];
	$pval = $_GET['p'];
	$reqpat = Database::getInstance()->count_from('ipd_patients','appointment_id', $value);
	$reqpat2 = Database::getInstance()->count_from('admission_request','appointment_id', $value);
	$reqpat3 = Database::getInstance()->count_from('surgery_perm','appointment_id', $value);
?>
<style>
	#pro thead,tbody{
		font-size: 12px;
	}
	@media print {
    .no-print{display: none;}
    .content{height:inherit;}
    #vitals > p{
    	line-height: normal;
    }
	 @page {
	 	font-size: 12px;
           margin:10px;
           width: 100%;
           position: absolute;
           left: 0;
           top: 0;
           margin-left: -300px;
         }
         body  {
           padding:0;
           position: absolute;
         }
    }
</style>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
 <button onclick="goBack()"  class="btn btn-info  no-print">Go Back</button>
	<button  type="button" id="submitEP" class="btn btn-success no-print pull-right" onclick="myFunction()"> Print</button>
<!--  MAIN -->
<div class="content" id="contentsss">
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
											$vital_n = $ow['vital_nurse'];
											$bpsts = $ow['blood_press_stand_s'];
											$bpstd = $ow['blood_press_stand_d'];
											$bpsis = $ow['blood_press_sit_s'];
											$bpsid = $ow['blood_press_sit_d'];
											
											
											$dateTi = $ow['date_time_added'];
											$bpst = '('.$ow['blood_press_stand_s'].'/Sistolic) ('.$ow['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$ow['blood_press_sit_s'].'/Sistolic) ('.$ow['blood_press_sit_d'].'/Diastolic)';
										endforeach; 
										$vital_nur = Database::getInstance()->select_from_where('staff','user_id',$vital_n);
										foreach ($vital_nur as $nurse) {
											$vital_nurse = "Nurse ".$nurse['last_name']." ".$nurse['first_name']." ".$nurse['other_names'];
										}
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
											endforeach; 
										?>
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Doctor's Sheet For <?php echo $name2;?></strong></h4>
										<h5 class="text-center" style="text-align:center">Reg No. <?php echo $reg;?></h5>
										<?php
											if ($crd == 19) {
												?>
													<h5 class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h5>
												<h5 class="text-center" style="text-align:center">HMO Tariff: <?php echo Database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);?></h5>
												<?php
											}else if($crd == 11){
												?>
												<h5 class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h5>
												<h5 class="text-center" style="text-align:center">Company Name: <?php echo Database::getInstance()->get_name_from_id('company_name','companies','id',$comp_i);?></h5>
												<?php
											}else if($crd == 20){
												?>
												<h5 class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h5>
												<h5 class="text-center" style="text-align:center">Family Name: <?php echo Database::getInstance()->get_name_from_id('family_name','families','id',$fam);?></h5>
												<?php
											}else{
												?>
												<h5 class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h5>
												<?php
											}
										?>
										<?php
										    $dt = date('d-m-Y',strtotime($dateTi));
                                            $tim = date('H:i:s',strtotime($dateTi));
                                            
                                            if($diag != ""){
										?>
										    <h5 class="text-center" style="text-align:center">Diagnosis: <?php echo $diag;?></h5>
										    <h5 class="text-center" style="text-align:center">Date: <?php echo $dt;?></h5>
									    	<h5 class="text-center" style="text-align:center">Time: <?php echo $tim;?></h5>
										<?php } ?>
			                            </div>
										
<!--vitals-->
<div class="clearTwenty"></div>
											<div class="col-md-12">
											<div class="row">
		                                       <div class="col-md-12" id="vitals">
		                                       	<div class="header"><h5>PATIENT'S VITALS</h5></div>
		                                                <div class="row">
		                                                	<p class="l2"><strong>Age:</strong> <?php echo $age;?></p>
														<p class="l2"><strong>Sex:</strong> <?php echo $sex;?></p>
														<p class="l2"><strong>Weight:</strong> <?php echo $weight;?><strong>Kg</strong></p>
														<p class="l2"><strong>Height:</strong> <?php echo$height;?><strong>Cm</strong></p>
														<p class="l2"><strong>BMI Ratio:</strong> <?php echo $bmi;?><strong>Kg/m2</strong></p>
														<p class="l2"><strong>Temperature:</strong> <?php echo $temp;?><strong>Degree Celcius</strong></p>
														<p class="l2"><strong>Pulse Rate:</strong> <?php echo $rate;?><strong>pulse/min</strong></p>
														

														<p class="l2"><strong>Respiratory Rate:</strong> <?php echo $res;?><strong>bit/min</strong></p>
														</div>
														<div class="row"><p class="l2"><strong>Routine Blood Pressure:</strong> <?php echo $rbp;?><strong>mmH</strong></p>
													
														<p class="l2"><strong>Saturatory Pressure of Oxygen(SPO2):</strong> <?php echo $spo2;?><strong>%</strong></p>
														<p class="l2"><strong>Random Blood Sugar:</strong> <?php echo $sugar;?><strong>mg/dl</strong></p>
														<p class="l2"><strong>ORTHOSTATIC BLOOD PRESSURE:</strong><strong>MMH</strong></p>
														<p class="l2"><strong>Diastolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsid;?></strong>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpstd;?>|</p>
														<p class="l2"> <strong>Sistolic:<strong style="color:blue;font:bold;">Sitting</strong>|<?php echo $bpsis;?>|<strong style="color:blue;font:bold;">Standing</strong>|<?php echo $bpsts;?>|</p>
		                                                </div>
														<div class="row">
															<p  class="l12" style="color:red;font:bold;"><strong>ALLERGIES:</strong> <?php echo $allergies;?></p>	
															</div>
															<div class="row">
														<p class="l12"><strong>Nurse's Note:</strong> <?php echo $note;?></p>
														</div>
															<div class="row">
														<p class="l12"><strong>Vitals Added By: <?php echo $vital_nurse; ?></strong></p>
														</div>
		                                        </div>
											</div>
</div>							
							
<!--prescriptions-->							
<div class="content">
                            	<div class="row">
									 <div class="col-md-12">
									  <div class="header"><h5>PRESCRIPTIONS/ HISTORY</h5></div>  
				                            <div class="content">
				                                <table id="pro"class="table">
				                                    <thead>
													    <th>Prescription ID</th>
				                                        <th>Drug</th>
				                                        <th>Tabs</th>
				                                        <th>Frequency</th>
				                                        <th>Duration (Days)</th>
				                                        <th>Instruction</th>
				                                        <th>Doctor</th>
				                                        <th>Date</th>
														 <th>Medication Status</th>
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
														</tr>
													<?php endforeach;?>
									       		 </tbody>
									       		 <tfoot>
													    <th>Prescription ID</th>
				                                        <th>Drug</th>
				                                        <th>Tabs</th>
				                                        <th>Frequency</th>
				                                        <th>Duration (Days)</th>
				                                        <th>Instruction</th>
				                                        <th>Doctor</th>
				                                        <th>Date</th>
														 <th>Medication Status</th>
				                                    </tfoot>
											</table>
										</div>
									</div>
								</div>
</div>			

 <!-- //diagnose -->
<div class="content">
            <div class="container-fluid">
				<div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h5>DOCTOR'S NOTE</h5>
                            </div>
							
                            <div class="content">								 
								 <div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>COMPLAINT:</label>
	                                                <div class="jumbotron"><?php echo $comp;?></div>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>EXAMINATION:</label>
	                                                <div class="jumbotron"><?php echo $exam;?></div>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>DIAGNOSIS: </label>
	                                                <div class="jumbotron"><?php echo $diag;?></div>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>

									
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>TREATMENT PLAN: </label>
	                                                <div class="jumbotron"><?php echo $pat_note;?></div>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>ADMISSION NOTE: </label>
	                                               <div class="jumbotron"><?php echo $adm_note;?></div>
	                                               
	                                            </div>
	                                        </div>
										</div>
									</div>
						
						</div>
						 <div id="get_result3"></div>
                    </div>
                </div>

				
			
            </div>
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
 <div class="loader" id="load" style="display:none; ">
</div>

<script type="text/javascript">
		 function myFunction() {
		 	var divCont = document.getElementById('contentsss').innerHTML;
		 	var a = window.open("","_self");
		 	a.document.write("<?php include_once '../inc/header-index.php'; ?>");
		 	a.document.write("<style>#vitals > p{font-size:12px;float:left;margin-right:10px;} div.row{display:table;}p.l2{display:table-cell; width:16.67%;font-size:12px;}p.l12{width:100%;font-size:12px;}#pro thead,tbody,tfoot{font-size: 12px;}#pro tbody tr td{padding:5px;text-align:center;}.header{text-align:center;text-transform: capitalize;}label{font-size:12px;}.jumbotron{font-weight:lighter;}@media print {.no-print{display: none;}.content{height:inherit;}@page {font-size: 12px;      margin:10px;width: 100%;}body  {padding:0;position: absolute;}}</style><body>");
		 	a.document.write(divCont);
		 	a.document.write("<?php include_once '../inc/footer-index.php';?>");
		 	a.document.close();
		 	a.print();
}
function goBack() {
  window.history.back(); 
}

window.onload = myFunction;
</script>
<script>

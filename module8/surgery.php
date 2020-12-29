<?php 
	ob_start();
	session_start();
	$pageTitle = "Surgery";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
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
	include_once '../inc/header-index.php'; //for addding header
	
	$value2 = $_GET['id'];	
	$value = $_GET['pid'];
	if (isset($_POST) AND !empty($_POST) AND !empty($_POST['note'])) {
		$insert = database::getInstance()->insert_progress($_POST['note'], $value, $user_id);
		if ($insert == 'Done') {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=done");
			unset($_POST);
		} else {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=error");
			unset($_POST);
		}
		
	} else {
		unset($_POST);
	}
?>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
<?php 
	if (isset($_GET['status']) AND $_GET['status'] == "done") {
		?>
		<div class="alert alert-success">Progress Note Added Successfully</div>
		<?php
	}else if (isset($_GET['status']) AND $_GET['status'] == "error") {
		?>
		<div class="alert alert-danger">Progress Note Could Not be Added</div>
		<?php
	}
 ?>
        <div class="content">
            <div class="container-fluid">
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Surgery Details</h4>
                                <?php
                             $pid = database::getInstance()->get_name_from_id('patient_id','ipd_patients','id',$value);
                             $date = database::getInstance()->get_name_from_id('surgery_date','surgery_perm','appointment_id',$value2);
								 $userDetails = Database::getInstance()->select_from_where('patients', 'id', $value);
											foreach($userDetails as $qw):
												 $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
												 $sex = $qw['sex'];
												 $reg = $qw['reg_num'];
											endforeach; 
										?>	
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Patient's Name: <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No: <?php echo $reg;?></p>
										<p class="text-center" style="text-align:center">Scheduled Date: <b><?php echo $date;?></b></p>
			                            </div>
                            </div><!--end of header -->

                            <div class="card-body">
                            	<?php 
                            		$precheck_stat = Database::getInstance()->get_name_from_id('prechecklist','surgery_perm','appointment_id',$value2);

                            		if ($precheck_stat == 0 || $precheck_stat == '0') {
                            	 ?>
                            	<div id="accordion">
                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#pre-check" aria-expanded="false" aria-controls="pre-check" style="width: 100%;margin-bottom: 20px;">
                            			Pre-Operative Checklist</button>
                            		<div class="collapse" id="pre-check">
                            	<div class="container">
                            		<form id="check_list">
                            		<div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has patient been assessed by the anaesthesiologist? </label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q1" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q1" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was premedicant prescribe? </label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q2" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q2" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has it been glven [YES /NO] Any reaction? </label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q3" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q3" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was blood or blood product prescribed?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q4" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q4" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">if yes, is blood available now?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q5" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q5" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has Patient accepted to receive blood?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q6" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q6" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are patient's Laboratory results availabile?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q7" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q7" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has informed consent been taken and form signed?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q8" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q8" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient starved appropriately?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q9" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q9" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient shaved?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q10" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q10" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>



                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient changed into Operating Theatre outfit?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q11" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q11" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are Patient's vital signs checked and recorded?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q12" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q12" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are All pre-operative requests e.g Drugs,Fluids, Instruments,Drapes,e.t.c Ready?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q13" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q13" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient Dentures?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q14" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q14" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>	

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has it Been removed?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q15" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q15" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient's Jewelry been removed?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q16" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q16" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has Catether been passed?</label></div>
                                        <div class="col col-md-4">
                                          <div class="form-check-inline form-check">
                                         <input type="radio" required id="inline-radio1" name="q17" value="Yes" class="form-check-input">Yes
                                          <input type="radio" required id="inline-radio2" name="q17" value="No" class="form-check-input">No
                                        </div>
                                     </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-large">Submit</button>
                            	</form>
                            	</div>
                            </div><!--end of pre-check-->
                            </div><!--end of accordion-->
                            <?php 
                            	}else{
                            		$get_answers = Database::getInstance()->select_from_where('prechecklist','appointment_id',$value2);
                            		foreach ($get_answers as $answer) {
                            			$q1 = $answer['q1'];
										$q2 = $answer['q2'];
										$q3 = $answer['q3'];
										$q4 = $answer['q4'];
										$q5 = $answer['q5'];
										$q6 = $answer['q6'];
										$q7 = $answer['q7'];
										$q8 = $answer['q8'];
										$q9 = $answer['q9'];
										$q10 = $answer['q10'];
										$q11 = $answer['q11'];
										$q12 = $answer['q12'];
										$q13 = $answer['q13'];
										$q14 = $answer['q14'];
										$q15 = $answer['q15'];
										$q16 = $answer['q16'];
										$q17 = $answer['q17'];
                            		}
                            ?>
                            <div class="container">
                            	<h3 class="title text-center" style="color: red; margin-top: 20px;">Operative Precheck List</h3>
                            	<div class="row">
                                        <div class="col col-md-8"><label class=" form-control-label">Has patient been assessed by the anaesthesiologist? </label></div>
                                        <div class="col col-md-4">
                                          <?php echo $q1; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was premedicant prescribe? </label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q2; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has it been glven [YES /NO] Any reaction? </label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q3; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was blood or blood product prescribed?</label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q4; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">if yes, is blood available now?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q5; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has Patient accepted to receive blood?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q6; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are patient's Laboratory results availabile?</label></div>
                                        <div class="col col-md-4">
                                        
                                          <?php echo $q7; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has informed consent been taken and form signed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q8; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient starved appropriately?</label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q9; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient shaved?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q10; ?>
                                     </div>
                                </div>



                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient changed into Operating Theatre outfit?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q11; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are Patient's vital signs checked and recorded?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q12; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are All pre-operative requests e.g Drugs,Fluids, Instruments,Drapes,e.t.c Ready?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q13; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient Dentures?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q14; ?>
                                     </div>
                                </div>	

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has it Been removed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q15; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient's Jewelry been removed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q16; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has Catether been passed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q17; ?>
                                     </div>
                                </div>
                               </div>
                            <?php		
                            	}
                             ?>
                             <div id="accordion">
                                    <button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#consent" aria-expanded="false" aria-controls="consent" style="width: 100%;margin-bottom: 20px; margin-top: 20px">
                                       Consent Form</button>
                                    <div class="collapse" id="consent">
                                       <h5 style="text-align: center;"><b>General Consent For Medical/Surgical Procedures/Interventions</b></h5>

                                       <form>
                                          <div class="form-group">
                                            <div class="col-md-12"></div>
                                            <div class="row">
                                              <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label>Patient FirstName</label>
                                                  <input type="text" name="patient name" class="form-control" placeholder="Patient FirstName">
                                              </div>
                                               <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label>Patient MiddleName</label>
                                                  <input type="text" name="patient name" class="form-control" placeholder="Patient MiddleName">
                                              </div>
                                               <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label>Patient LastName</label>
                                                  <input type="text" name="patient name" class="form-control" placeholder="Patient lastName">
                                              </div>

                                              <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label>Medical record Number</label>
                                                  <input type="Number" name="patient name" class="form-control" placeholder="Medical record Number">
                                              </div>
                                            </div>
                                          </div> 

                                          <div class="col-md-12">
                                              <h4 style="font-size: 19px;"><b> 1.The name stated above you have been given information about your condition and the recommended
                                            surgical, medical, or diagnostic procedure(s). This consent form is designed to provide a written confirmation of these discussions.</b></h4>
                                          </div>

                                          
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-md-4">
                                                    <label>Name of Clinician</label>
                                                      <input type="text" name="Clinician" class="form-control" placeholder="Name of Clinician">
                                                  </div>
                                                  <div class="col-md-8">
                                                      <h4>has explained to me that I have the following condition(s):</h4>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-md-12">
                                            <label>Explain Conditions in lay terms:</label>
                                              <input type="text" name="conditions" class="form-control" placeholder="Explain in lay terms">
                                          </div>

                                         <div class="col-md-12">
                                              <h4 style="font-size: 19px;"><b> 2. The following procedure/intervention/anesthesia (if any) has been recommended: </b>
                                                </h4>
                                          </div>

                                          <div class="col-md-12">
                                            <label>Explain Conditions in lay terms:</label>
                                              <input type="text" name="conditions" class="form-control" placeholder="Explain in lay terms">
                                          </div>

                                            <div class="col-md-12">
                                              <h4 style="font-size: 19px;"><b>3.The following have been explained to me about the procedure/intervention/anesthesia (if any):</b> </br>
                                                    a. Its purpose and nature. </br>
                                                    b. The potential benefits and risks. </br>
                                                    c. The likely result if I do not have the recommended procedure/intervention. </br>
                                                    d. The available alternative treatments and their benefits and risks. 
                                                </h4>
                                          </div>


                                           <div class="col-md-12">
                                            <label>The most likely and most serious risks of the procedure(s) are: </label>
                                              <input type="text" name="conditions" class="form-control" placeholder="Explain in lay terms">
                                          </div>

                                            <div class="col-md-12">
                                              <h4 style="font-size: 19px;"><b>4. I am aware that there may be other risks or complications not discussed that may occur. I also
                                                understand that during the course of the proposed procedure, unforeseen conditions may be
                                                revealed requiring the performance of additional procedures, and I authorize such procedures
                                                to be performed. I acknowledge that no guarantees or promises have been made to me
                                                concerning the results of this procedure or any treatment that may be required as a result of
                                                this procedure. 
                                            </b>
                                                </h4>
                                          </div>


                                            <div class="col-md-12">
                                              <h4 style="font-size: 19px;"> <b>5. I understand what has been discussed with me as well as the contents of this form. I have
                                                been given the opportunity to ask questions and have received satisfactory answers. If you
                                                have not had all of your questions answered to your satisfaction, do not sign this form until you
                                                have. 
                                            </b>
                                                </h4>
                                          </div>

                                          <div class="col-md-12">
                                              <h4 style="font-size: 19px;"> <b>6.I voluntarily consent to the performance of the procedure/intervention/anesthesia (if any)
                                                    described above by my clinician or those who work with him/her. 
                                            </b>
                                                </h4>
                                          </div>


                                         <div class="col-md-12"></div>
                                            <div class="row">
                                              <div class="col-md-6 col-lg-6 col-sm-6">
                                                <label>Patient Name</label>
                                                  <input type="text" name="patient name" class="form-control" placeholder="Patient FirstName">
                                              </div>
                                               <div class="col-md-6 col-lg-6 col-sm-6">
                                                <label>Witness Name</label>
                                                  <input type="text" name="Witness name" class="form-control" placeholder="Witness MiddleName">
                                              </div>

                                          </div>
                                               <div class="col-md-12">
                                        <div class="row">

                                               <div class="col-md-6 col-lg-6 col-sm-6">
                                                <label>Physician Name</label>
                                                  <input type="text" name="Physician name" class="form-control" placeholder="Physician lastName">
                                              </div>

                                              <div class="col-md-6 col-lg-6 col-sm-6">
                                                <label>Date</label>
                                                  <input type="date" name="date" class="form-control" placeholder="Date">
                                              </div>
                                            </div>
                                          </div> 

                                          <button type="submit" class="btn btn-info btn-large" style="margin-bottom: 20px;">Submit</button>
                                      </div>

                                  






                                       </form>

                                    </div>
                            </div>
	    </div>
    </div>

                             </div>
			                            <!--<div class="row">
			                            	<form method="POST">
			                            		<div class="col-lg-1"></div>
			                            	<div class="col-lg-8">
			                            		<div class="form-group">
			                            			<label>New Note</label>
			                            			<textarea name="note" class="form-control"></textarea>
			                            		</div>
			                            	</div>
			                            	<div class="col-lg-3">
			                            		<button class="btn btn-info" type="submit" style="margin-top: 40px;">Upload</button>
			                            	</div>
			                            	</form>
			                            </div>
										<table class="table table-stripped" style="overflow-y: scroll;height: 700px;">
											<thead>
												<th>#</th>
												<th>Progress</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
											<tbody>
												<?php $notarray =Database::getInstance()->select_from_where_ord('progress','ipd_numb', $value,'date_added',"DESC");
										$count = 1;
										foreach($notarray as $ow):
											$note = $ow['note'];
											$date_added =$ow['date_added'];
											$added_by =$ow['added_by'];

											$staff = database::getInstance()->select_from_where2('staff','user_id',$added_by);
											foreach ($staff as $emp) {
												$Doctor = $emp['last_name']. " ".$emp['first_name'];
											}
											?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo $note; ?></td>
												<td><?php echo $Doctor; ?></td>
												<td><?php echo $date_added; ?></td>
											</tr>
											<?php
										endforeach; ?>
											</tbody>
											<thead>
												<th>#</th>
												<th>Progress</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
										</table>-->

                            
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delAdminReq',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'new_request';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#check_list').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var value = "<?php echo $value2; ?>";//appointment id
			var doc_id = "<?php echo $user_id; ?>";
			var p_id = "<?php echo $value; ?>";
			f.ajax({
				type: "POST",
				data: f('#check_list').serialize()+ '&pid=' + p_id + '&doc_id=' +doc_id + '&id=' + value + '&ins=newPreCheckList',
				url: "../func/verify.php",
				success: function(res) {
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
					window.location = "surgery.php?id=<?php echo $value2; ?>&pid=<?php echo $value; ?>";
				}
			});
        });
</script>
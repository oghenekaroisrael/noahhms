<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Vital Entry";
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

	$value= $_GET['id'];
?>

<!----BMi Calculation>  ---->
			<script>
function myFunction() {
 
  var y = parseInt(document.getElementById("height").value);
  var z = parseInt(document.getElementById("weight").value);
 var b = y*y;
 var f = b/10000;
 var e = z;
 var c = e/f;
 var x =   Math.round( c * 10 ) / 10;

  if(y == '' && z == ''){
  document.getElementById("bmi").value = x;
  }else{
  document.getElementById("bmi").value = x;
  }
}
</script>


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
                           <div class="header">
                                <h4 class="title">Vitals</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                
													<label>Patient's Name</label>
												
													<?php
																$userDetails = Database::getInstance()->select_from_where("patient_appointment", "id", $value);
																  foreach($userDetails as $ew):  
																    $pid = $ew['patient_id'];
																    $bmi = $ew['bmi'];
																    $weight = $ew['weight'];
																    $height = $ew['height'];
																    $temp = $ew['temperature'];
																    $pulse = $ew['pulse_rate'];
																    $spo2 = $ew['spo2'];
																    $blood_sugar = $ew['blood_sugar'];
																    $resp = $ew['respiratory'];
																    $bpss = $ew['blood_press_stand_s'];
																    $bpds = $ew['blood_press_stand_d'];
																    $bpst = $ew['blood_press_sit_s'];
																    $bpsd = $ew['blood_press_sit_d'];
																    $allergies = $ew['allergies'];
																    $rbp = $ew['routine_blood_pressure'];
																    $nc = $ew['nurse_complaint'];
																  endforeach; 
																	$userDetails = Database::getInstance()->select_from_where("patients", "id", $pid);
																	
																foreach($userDetails as $w):
																	$c_id = $w['id'];
																	$title = $w['title'];	
																	$first = $w['surname'];	
																	$last = $w['middle_name'];
																		
																	
																$nam = $title." ".$first." ".$last;
													
															endforeach;
															?>
															<input type="text" class="form-control" name="name" placeholder="Patient's Name" value="<?php echo $nam;?>">
															
														
													</div>
												</div>
										</div>
									</div>
													
						

									<div class="clearfix"></div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Weight</label>(kg)
	                                                <input type="text" class="form-control" name="weight" id="weight" onkeyup="myFunction()" placeholder="Weight in kg" value="<?php echo $weight; ?>" / >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Height</label>(cm)
	                                                <input type="text" class="form-control" name="height" id="height" onkeyup="myFunction()" placeholder="height in cm"  value="<?php echo $height; ?>"/ >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>BMI Ratio</label>
	                                                <input type="text" class="form-control" name="bmi"  id="bmi" placeholder="BMI in kg/m2"  value="<?php echo $bmi; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Temperature</label>(Celcius)
	                                                <input type="text" class="form-control" name="temp" placeholder="Temperature in Celcius"  value="<?php echo $temp; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Pulse Rate</label>(pulse/min)
	                                                <input type="text" class="form-control" name="pulse" placeholder="Pulse Rate in pulse/min"  value="<?php echo $pulse; ?>">
	                                            </div>
	                                        </div>
										    </div>
                                            </div>												
											<div class="col-md-4">
											<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Respiratory Rate</label>(bit/min)
	                                                <input type="text" class="form-control" name="respiratory" placeholder="Respiratory Rate in bit/min"  value="<?php echo $resp; ?>">
	                                            </div>
	                                        </div>
											</div>
	                                       
										
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                 <label>Routine Blood Pressure</label>(mmHg)
	                                                <input type="text" class="form-control" name="rbp" placeholder="Routine Blood Pressure in mmH"  value="<?php echo $rbp; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>SPO2</label>(%)
	                                                <input type="text" class="form-control" name="spo2" placeholder="Saturatory Pressure of Oxygen in %"  value="<?php echo $spo2; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                               <label>Random Blood Sugar</label>(mg/dl)
	                                                <input type="text" class="form-control" name="rds" placeholder="Random Blood Sugar in mg/dl"  value="<?php echo $blood_sugar; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group" >
	                                                 <label style="margin-left:270px;" >Orthostatic BP<span>(mmH)</span></label>
	                                              
	                                            </div>
	                                        </div>
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Diastolic Blood pressure</label>
	                                               
	                                            </div>
	                                        </div>
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Standng</label>
	                                                <input type="text" class="form-control" name="dsstand" placeholder="Diastolic Standing in mmH"  value="<?php echo $bpds; ?>"/>
	                                            </div>
												<div class="form-group">
	                                                 <label>Sitting</label>
	                                                <input type="text" class="form-control" name="dssit" placeholder="Diastolic Sitting in mmH" value="<?php echo $bpsd; ?>"/>
	                                            </div>
	                                        </div>
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Systolic Blood Pressure</label>
	                                               
	                                            </div>
	                                        </div>
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Standng</label>
	                                                <input type="text" class="form-control" name="ssstand" placeholder="Systolic Standing in mmH"  value="<?php echo $bpss; ?>"/ >
	                                            </div>
												<div class="form-group">
	                                                 <label>Sitting</label>
	                                                <input type="text" class="form-control" name="sssit" placeholder="Systolic Standing Sitting in mmH" value="<?php echo $bpst; ?>" / >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
					
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Allergies</label>
	                                                <textarea type="text" class="form-control" name="allergies" placeholder="Allergies"><?php echo $allergies; ?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Nurse's Note</label>
	                                                <textarea type="text" class="form-control" name="complaint" placeholder="note" style="font-size: 16px;"><?php echo $nc; ?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Vitals</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				

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

<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			var me = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id +"&me=" + me + "&ins=addVitals&edit=1",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})
</script>	
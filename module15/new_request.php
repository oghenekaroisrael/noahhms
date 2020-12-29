<?php 
	ob_start();
	session_start();
	$pageTitle = "New Request";
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
?>

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
                                <h4 class="title">Request Form</h4>
                            </div>

                            <div class="content">
                                <form id="schedule">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                               <label>Sample type</label>
	                                               <select class="form-control" name="sample">
	                                               	<option selected disabled>Select sample</option>
	                                               	<?php 
														$contt = Database::getInstance()->select_from_ord1('samples', 'id','DESC');
														foreach($contt as $ow){
														?>
														<option value="<?php echo $ow['id']?>"><?php echo $ow['sample']?></option>
														<?php } ?>
	                                               </select>
	                                            </div>
	                                        </div>
	                                        <div class="col-md-3">
			                                            <div class="form-group">
			                                                <label>Urgency</label>
			                                                <select class="form-control" name="urgency">
			                                                	<option value="Immediately">Immediately</option>
			                                                	<option value="Not Very Urgent">Not Very Urgent</option>
			                                                </select>
			                                            </div>
											</div>

											<div class="col-md-3">
			                                            <div class="form-group">
			                                                <label>Volume</label>
			                                                <input type="number" class="form-control" name="volume" placeholder="Volume" value="0">
			                                            </div>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="row">
											<div class="title"><h4><b>Submitting facility information</b></h4></div>
	                                       <div class="col-lg-12">
	                                       	
	                                            <div class="form-group">
	                                                <label>facility name</label>
	                                                <input type="text" class="form-control" name="facility_name" placeholder="Facility Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>

								<div class="col-lg-12">
									<div class="row">
									  <div class="col-lg-4">
									  	
										       <div class="form-group">
	                                                <label>phone number</label>
	                                                <input name="fphone_number" class="form-control" type= "tel" placeholder="+234-100-200-3000">
	                                           
	                                        </div>
										</div>
									
							
                                   
									<div class="col-lg-8">
										
                                                <div class="form-group">
                                                    <label for="Requesting physician">Requesting Physician</label>
                                                    <input class="form-control" name="physician" type="text" required>
                                                </div>
                                           
                                    </div>
                                </div>
                            </div>



                                    <div class="col-lg-12">
										<div class="row">					
										<div class="title"><h4><b>Patient Information</b></h4></div>	
	                                       <div class="col-lg-7">
	                                       	
	                                            <div class="form-group">
	                                                <label>patient name</label>
	                                                <input type="text" class="form-control" name="patient_name" placeholder="Patient Name" >
	                                            </div>
	                                        </div>

	                                        <div class="col-lg-5">
	                                       	
	                                            <div class="form-group">
	                                                <label>patient ID or LIS#</label>
	                                                <input type="text" class="form-control" name="patient_id" placeholder="Patient Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-6">
									  	
										       <div class="form-group">
	                                                <label>Patient's Address</label>
	                                                <input name="address" class="form-control" type= "tel" placeholder="Patient's Address">
	                                           
	                                        </div>
										</div>
									  <div class="col-lg-3">
									  	
										       <div class="form-group">
	                                                <label>phone number</label>
	                                                <input name="pphone_number" class="form-control" type= "tl" placeholder="+234-100-200-3000" >
	                                           
	                                        </div>
										</div>
									
							
                                   
									<div class="col-lg-3">
										
                                                <div class="form-group">
                                                    <label for="Requesting physician">Patient DOB</label>
                                                    <input class="form-control" name="patient_dob" type="Date" required placeholder="mon-date-year">
                                                </div>
                                           
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
                            				<label for="diagnosis">Diagnosis</label>
                            				<input type="text" name="diagnosis" placeholder="Patient's diagnosis" class="form-control">
                            			</div>
                            		</div>
                            	</div>
                            </div>



                          <div class="col-lg-12">
										<div class="row">
											<div class="title"><h4><b>Patient History:</b>***Please Personally ask the patient this questions***</h4> </div>
	                                       <div class="col-lg-12">
	                                       	
	                                            <div classs="form-group">
	                                                <label>Was patient inquiry performed???</label>
	                                                <input type="checkbox" name="inquiry" id="checkedYes"  onclick="checkfunction()"><span>Yes</span>
	                                                <input type="checkbox" name="inquiry" id="checkedNo" onclick="checkfunction()"><span>No,</span>
	                                                <label style="display: none;" id="labelreason">reason why?</label> <input type="text" id="inputreason" class="form-control" style="display: none;" name="inquiry_reason" value="">
	                                            </div>
	                                        </div>
										</div>
									</div>
								<div class="col-lg-12">
									<div class="row">
									  <div class="col-lg-7">
										       <div class="form-group">
	                                                <label>Known RBC antibody(ies)</label>
	                                                <input class="form-control" type="text" name="rbc">
	                                        </div>
										</div>
									
									<div class="col-lg-5">
										
                                                <div class="form-group">
                                                    <label>Date of last known negative antibody screen</label>
                                                    <input class="form-control" type="date" required name="date_lknas">
                                                </div>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
                            				<label>Current Medications</label>
                            				<input type="text" placeholder="Current Medications" class="form-control" name="cmeds">
                            			</div>
                            		</div>
                            	</div>
                            </div>

                            <div class="col-lg-12">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
                            				<label>Additional information</label>
                            				<input type="text" placeholder="Patients Additional informations..." class="form-control" name="info">
                            			</div>
                            		</div>
                            	</div>
                            </div>


                            <div class="col-lg-12">
										<div class="row">
											<div class="title"><h4><b>Transfusion History:</b></h4> </div>
	                                       <div class="col-lg-6">
	                                       	
	                                            <div classs="form-group">
	                                                <label>Within last 3 months</label>
	                                                <input type="checkbox" name="transfusion" id="checkYes" onclick="check()"><span>Yes</span>
	                                                <input type="checkbox" name="transfusion" id="checkNo" onclick="check()"><span>No,</span>
	                                            
	                                            </div>

	                                         
	                                       	
	                                        </div>
										</div>
									</div>


								


                                    <button type="submit" class="btn btn-info btn-fill pull-right">Send Request</button>
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

<script type="text/javascript">
	var a=jQuery .noConflict();			
	a(function () {
		a('#schedule').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#schedule').serialize() + '&ins=newBRequest&id=<?php echo $user_id; ?>',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });


    function checkfunction(){
    	var checkedNo = document.getElementById('checkedNo');
    	var checkedYes = document.getElementById('checkedYes');
    	var inputreason = document.getElementById('inputreason');
    	var labelreason = document.getElementById('labelreason');

    	if(checkedNo.checked === true){
    		inputreason.style.display = 'block';
    		labelreason.style.display = 'block';
    		checkedYes.checked = false;
    	} else if (checkedYes.checked === true){
    		checkedNo.checked = false;
    	} 
    	else{
            inputreason.style.display = 'none';
    		labelreason.style.display = 'none';
    	}

    	
    }

    function check(){

      	var checkNo = document.getElementById('checkNo');
    	var checkYes = document.getElementById('checkYes');

    	if(checkNo.checked === true ){
    		checkYes.checked = false;
    	}else if(checkYes.checked === true){
    		checkNo.checked = false;
    	}
     }

</script>


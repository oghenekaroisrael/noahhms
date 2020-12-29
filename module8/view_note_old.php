<?php 
	ob_start();
	session_start();
	$pageTitle = "View Case File";
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
	
	$value = $_GET['view'];
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Case Note</h4>
                            </div>
							
							
							
							
							
							
							 <?php
							 
							        $notarray =Database::getInstance()->select_from_where2('lab_result','appointment_id', $value);
									$prescrip = "";
									$complain = "";
									$bpst ="";
									$bpsi ="";
									$ecg ="";
									$echo ="";
									$diag = "";
									$dt = "";
									$tim = "";
										 $notarray =Database::getInstance()->select_from_where2('patient_appointment','id', $value);
										foreach($notarray as $ow):
											$temp = $ow['temperature'];
										    $pp_id = $ow['patient_id'];	
											$weight = $ow['weight'];
											$prescrip = $ow['prescription'];
											$res = $ow['respiratory'];
											$complain = $ow['complaint'];
											$ecg = $ow['ecg_result'];
											$echo = $ow['echo_result'];
											$sugar = $ow['blood_sugar'];
											$rate = $ow['pulse_rate'];
											$diag = $ow['diagnosis'];
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
												<br>		<p><strong>Nurse's Note:</strong> <?php echo $note;?></p>
														
													
														
														
		                                            </div>
		                                        </div>
											</div>
										</div>
							
							<br><br><br><br>
							
											
							
							
                            <div class="content table-responsive table-full-width">
                                <table id="pro" class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Complaint</th>
                                        <th>Examination</th>
                                    	<th>Diagnosis</th>
                                    	<th>Prescription <small>Drug | Tabs | Dosage | Instruction</small></th>
                                    	<th>Date</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where2('patient_appointment', 'id', $value);
											foreach($notarray as $row):
											$complaint = $row['complaint'];
											$exam = $row['examination'];
											$diag = $row['diagnosis'];
											$pres = $row['prescription'];
											$date = $row['date_time_added'];
											
											$notarray = database::getInstance()->select_from_where2('prescription', 'appointment_id', $value);
											foreach($notarray as $row){
											$pharm = $row['pharm_stock_id'];
											$tabs = $row['tabs'];
											$dosage = $row['dosage'];
											$inst = $row['instruction'];
											
											}
										if(isset($pharm)){
											
											
										
											$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id', $pharm);
											foreach($notarray as $row){
											$drug = $row['name'];
											
											}
										}
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php if(!isset($complaint)){echo '';}else{echo $complaint;} ?></td>
                                        	<td><?php if(!isset($exam)){echo '';}else{echo $exam;}?></td>
                                        	<td><?php  if(!isset($diag)){echo '';}else{echo $diag;}?></td>
                                        	<td><?php


											if(!isset($drug)){echo '';}else{echo $drug;}?> | <?php if(!isset($tabs)){echo '';}else{echo $tabs;}?> | <?php  if(!isset($dosage)){echo '';}else{echo $dosage;}?>| <?php if(!isset($inst)){echo '';}else{echo $inst;}?></td>
                                        	<td> <?php  if(!isset($date )){echo '';}  else{ echo date('d-m-Y', strtotime($date));}?></td>
                                        	
                                        </tr>
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
										<th>Complaint</th>
                                        <th>Examination</th>
                                    	<th>Diagnosis</th>
                                    	<th>Prescription</th>
                                    	<th>Date</th>
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
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changeAdmiStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var app_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, app_id: app_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_result').html(res).show();
						//console.log(res);
				}
			});

		});
</script>
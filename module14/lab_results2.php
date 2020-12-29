<?php 
	ob_start();
	session_start();
	$pageTitle = "Case Note";
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
	include_once '../inc/header-index.php'; //for addding header
	$value = $_GET['id'];
	$pid = $_GET['pid'];
	$ref = $_GET['ref'];
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
							 
							        $notarray =Database::getInstance()->select_from_where2('lab_result','front_desk', $value);
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
										 $notarray =Database::getInstance()->select_from_where2('patient_appointment','front_desk', $value);

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
			                               <h4 class="text-center" style="text-align:center"><strong>Case Note For <?php echo $name2;?></strong></h4>
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
<!--Doctor's Note -->
<div class="content no-print">
	<?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where2('patient_appointment', 'front_desk', $value);
											foreach($notarray as $row):
											$complaint = $row['complaint'];
											$exam = $row['examination'];
											$diag = $row['diagnosis'];
											$pnote = $row['patients_note'];
											$date = $row['date_time_added'];
										?>
										<div class="row">
											<div class="col-md-12">
												<font class="pull-left">S/N: <?php echo $count++;?></font>
												<h5 class="pull-right"><b>Date: </b> <?php  if(!isset($date )){echo '';}  else{ echo date('d-m-Y', strtotime($date));}?></h5>
											</div>
										</div>
	<div class="row">
		<div class="col-md-3 xray-comp">
			<h4 class="text-center">Complaint</h4>
			<hr style="margin-top: 2px;">
			<p><?php if(!isset($complaint)){echo '';}else{echo $complaint;} ?></p>
		</div>
		<div class="col-md-3 xray-exam">
			<h4 class="text-center">Examination</h4>
			<hr style="margin-top: 2px;">
			<p><?php if(!isset($exam)){echo '';}else{echo $exam;}?></p>
		</div>
		<div class="col-md-3 xray-diag">
			<h4 class="text-center">Diagnosis</h4>
			<hr style="margin-top: 2px;">
			<p><?php  if(!isset($diag)){echo '';}else{echo $diag;}?></p>
		</div>
		<div class="col-md-3 xray-presc">
			<h4 class="text-center">Patient's Note</h4>
			<hr style="margin-top: 2px;">
			<p><?php  if(!isset($pnote)){echo '';}else{echo $pnote;}?></p>
		</div>
	</div>
	<span class="line">
 <?php endforeach;?>
</div>										
<!--Additional files-->
				
	
		 <div class="content no-print">
                            	<div class="container">
                            			<h2 class="text-center">Xray Scans</h2>
                            			<!--Display From xray_group_result -->
                            		<div class="row">
                            			<table id="pro"class="table table-hover table-striped">
				                                    <thead>
				                                        <th>Name</th>
				                                        <th>Scanned Image</th>
				                                        <th>Radiologist's Comment</th>
				                                        <th>Date Uploaded</th>
				                                        <th>Action</th>
				                                       
				                                    </thead>
				                                    <tbody>
													 <?php
															$db =  mysqli_connect("localhost","root","","noahhms");
															$sql = mysqli_query($db, "SELECT * FROM patient_xray_result WHERE patient_id = ".$pid." AND front_desk = ".$value." ORDER BY  id DESC");
															if ($sql) {
															while ($get = mysqli_fetch_assoc($sql)) {
															?>
															<tr>
															<td width="20%"><?php echo $get['xray_name']; ?>
															
															</td>
															<td  width="20%">
																<img src="../extrafile/<?php echo $get['file'];?>" height="300" width="300">
															</td>
															<td width="40%">
																<?php echo $get['comment'];?>
															</td>
															<td width="8%">
																<?php echo $get['date_added']; ?>
															</td>
														<td width="12%">
																<div class="btn-group">
																	<button type="button" class="btn btn-info">Action</button>
																	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																	<span class="caret"></span>
																	<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	<ul class="dropdown-menu" role="menu">
																		<li><a onclick="download<?php echo $get['id']; ?>()">Download File</a></li>
																		<li class="divider"></li>
																	</ul>
																</div>
															</td>
														<script type="text/javascript">

														function download<?php echo $get['id']; ?>(){
														document.getElementById("load").style.display = "block";
														var fil = '<?php echo $get['file']; ?>';
														var ins = 'extra';
														window.location = '../func/download?fil='+fil+'+&ins='+ins;
														document.getElementById("load").style.display = "none";
														}
                                                         </script>
														
									 
														</tr>
															<?php
															}
														}
															
														?> 
				                                        	
				                                    </tbody>
				                                 <thead>
														<th>Name</th>
				                                        <th>Scanned Image</th>
				                                        <th>Radiologist's Comment</th>
				                                        <th>Date Uploaded</th>
				                                        <th>Action</th>
				                                    </thead>
												</table>
                            		</div>
                            		<!--//-->
                            		<h2 class="text-center">Therapy Plan</h2>
                            			<!--Display From therapy_plan -->
                            		<div class="row">
                            			<div class="col-md-12">
                            				<table class="table table-striped table-hover">
                            					<thead>
                            						<th>#</th>
                            					<th>Plan</th>
                            					<th>Date Added</th>
                            					<th>Action</th>
                            					</thead>
                            					<tbody>
                            						<?php 
                            				$db =  mysqli_connect("localhost","root","","noahhms");
															$sql = mysqli_query($db, "SELECT * FROM therapy_plans WHERE patient_id = ".$pid." AND front_desk = ".$value." ORDER BY  id DESC");
															$count_t = 1;
															$plan = mysqli_num_rows($sql);
                            					if (!empty($plan) AND $plan  > 0) {
                            						while ($tplan = mysqli_fetch_assoc($sql)) {
                            							?>
                            							<tr>
                            								<td width="10%"><?php echo $count_t++; ?></td>
                            								<td width="60%"><?php echo $tplan['comment']; ?></td>
                            								<td width="18%"><?php echo $tplan['time_added']; ?></td>
                            								<td width="12%">
                            									<div class="btn-group">
																	<button type="button" class="btn btn-info">Action</button>
																	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																	<span class="caret"></span>
																	<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	<ul class="dropdown-menu" role="menu">
																		<li><a href="edit_plan.php?pid=<?php echo $pid; ?>&id=<?php echo $value; ?>&ref=<?php echo $ref; ?>&edit=<?php echo $tplan['id']; ?>">Edit Plan</a></li>
																		<li class="divider"></li>
																		<li><a onclick="sure1(<?php echo $tplan['id']; ?>)">Delete Plan</a></li>
																	</ul>
																</div>
                            								</td>
                            							</tr>
                            							<?php
                            						}
                            					}else{
                            						?>
                            						<tr>
                            							<td colspan="3">
                            								<h3 class="text-center"> No Plan Added Currently</h3>
                            							</td>
                            						</tr>
                            						<?php
                            					}

                            				?>
                            					</tbody>
                            					<thead>
                            					<th>#</th>
                            					<th>Plan</th>
                            					<th>Date Added</th>
                            					<th>Action</th>
                            					</thead>
                            				</table>
                            				<a href='upload_doc?id=<?php echo $value;?>&pid=<?php echo $pid; ?>&ref=<?php echo $ref; ?>' class="btn btn-info btn-fill pull-right">Add Therapy Plan</a>
                            			</div>
                            		</div>
                            		<!--//-->

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
 function sure1(ID){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+ID+"</b> From Therapy Plans List? </br><button type='button' class='btn pop-btn' onclick='delet1("+ID+")'>Delete</button>"

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
						window.location = 'lab_results?id=<?php echo $value ?>&pid=<?php echo $pid; ?>&ref=<?php echo $ref; ?>';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function delet1(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=deltherapyPlan',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'lab_results?id=<?php echo $value ?>&pid=<?php echo $pid; ?>&ref=<?php echo $ref; ?>';
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

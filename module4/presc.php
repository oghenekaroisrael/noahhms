<?php 
	ob_start();
	session_start();
	$pageTitle = "Pateint's Note";
	// Include database class
	include_once '../inc/db.php';
	$oid = database::getInstance()->get_distinct_name_from_id('reference','prescription','appointment_id',$_GET['pid']);
	$paid = database::getInstance()->get_name_from_id2('payment_status','accounts','order_id',$oid);
	$xpat = database::getInstance()->get_name_from_id('patient_id','patient_appointment','id',$_GET['pid']);
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
		if (!isset($_SESSION['sale'])) {
    	$sales_id = date('Ymdhis');
    	$_SESSION['sale'] = $sales_id;
	} else {
		$_SESSION['sale'] = $_SESSION['sale'];
	}
	if ($_GET['status'] == 'done') {
    	$sales_id = date('Ymdhis');
    	$_SESSION['sale'] = $sales_id;
		echo'<script>
                $(document).ready(function() {
                    rem();
                });
        </script>';
	}
	include_once '../inc/header-index.php'; //for adding header
	$pat_id = $_GET['pid'];
	$db = mysqli_connect("localhost", "root", "", "noahhms");
	$get_id = mysqli_query($db, "SELECT * FROM patient_appointment WHERE id = '".$pat_id."' LIMIT 1");
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
							 
							        $notarray =Database::getInstance()->select_from_where2('lab_result','appointment_id', $_GET['pid']);
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
										 $notarray =Database::getInstance()->select_from_where2('patient_appointment','id', $_GET['pid']);
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
			                               <h4 class="text-center" style="text-align:center"><strong>Case Note For <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No. <?php echo $reg;?></p>
										<?php
											if ($crd == 19) {
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<p class="text-center" style="text-align:center">HMO Tariff: <?php echo Database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);?></p>
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
                        <div class="row" id="xray_case">
		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-2">
					<div>
						<i class="fas fa-meh-o"></i>
					</div>
				</div>
				<div class="col-md-10">
					<h4>Complaint</h4>
					<p><?php if(!isset($complaint)){echo '';}else{echo $complaint;} ?></p>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-2">
					<div>
						<i class="fas fa-stethoscope"></i>
					</div>
				</div>
				<div class="col-md-10">
					<h4>Examination</h4>
					<p><?php if(!isset($exam)){echo '';}else{echo $exam;}?></p>
				</div>
			</div>
		</div>


		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-2">
					<div>
						<i class="fas fa-user-md"></i>
					</div>
				</div>
				<div class="col-md-10">
					<h4>Diagnosis</h4>
					<p><?php  if(!isset($diag)){echo '';}else{echo $diag;}?></p>
				</div>
			</div>
		</div>


		<div class="col-lg-6">
			<div class="row">
				<div class="col-md-2">
					<div>
						<i class="fas fa-file-text-o"></i>
					</div>
				</div>
				<div class="col-md-10">
					<h4>Patient's Note</h4>
					<p><?php  if(!isset($pnote)){echo '';}else{echo $pnote;}?></p>
				</div>
			</div>
		</div>
	</div>

                            <div class="row">
                            	<div class="header">
                            		<h3>Prescriptions</h3>
                            	</div>
                            	<div class="col-lg-12 " style="height: 200px;">
                            		<table class="table table-bordered">
                            			<thead>
                            				<th>#</th>
                            				<th>Drug</th>
                            				<th>Tabs</th>
                            				<th>Frequency</th>
                            				<th>Duration</th>
                            				<th>Quantity To Dispense</th>
                            				<th>Price</th>
                            				<th>Instruction</th> 
                            			</thead>
                            			<?php
                            				foreach($notarray2 as $row){
                            				$pr_id = $row['prescription_id'];
											$pharm = $row['pharm_stock_id'];
											$tabs = $row['tabs'];
											$dur = $row['duration'];
											$doc = $row['doctor_id'];			
											$dispense = $row['quantity_dispense'];	
											$stabs = $row['stabs'];
											$sdur = $row['sduration'];
											$given = $row['pres_status'];
											$sdispense = $row['squantity_dispense'];
											$ref = $row['reference'];
											
											if ($dispense > 0) {
												if ($tariff > 0) {

													$tariff_name = database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);
													$tariff_name = strtolower($tariff_name);
													$tariff_name = str_replace(" ", "_", $tariff_name);
													$price =  database::getInstance()->get_name_from_id($tariff_name,"pharm_stock","id",$pharm);
													$money = "&#8358;".($price* $dispense);
												}else{
													$price =  database::getInstance()->get_name_from_id("price","pharm_stock","id",$pharm);
													$money = "&#8358;".($price* $dispense);
												}

											}elseif ($sdispense > 0) {

												if ($tariff > 0) {
													$tariff_name = database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);
													$tariff_name = strtolower($tariff_name);
													$tariff_name = str_replace(" ", "_", $tariff_name);
													$price =  database::getInstance()->get_name_from_id($tariff_name,"pharm_stock","id",$pharm);
												}else{
													$price =  database::getInstance()->get_name_from_id("price","pharm_stock","id",$pharm);
												}
												

												$custom_price =  database::getInstance()->get_name_from_id("to_pay","accounts","order_id",$ref);
												$supposed_price = $price * $sdispense;
												if($custom_price > 0 && $supposed_price != $custom_price){
													$money = "&#8358;".number_format($custom_price);
												}else if ($supposed_price == $custom_price) {
													$money = "&#8358;".number_format($supposed_price);
												}else{
													$money = "IPD <br>(See Doctor Or Nurse For Price)";
												}
											}
											if ($row['dosage'] == 1) {
													$dosage = "DLY";
												}elseif ($row['dosage'] == 2) {
													$dosage = "B.D";
												}elseif ($row['dosage'] == 3) {
													$dosage = "T.D.S";
												}elseif ($row['dosage'] == 4) {
													$dosage = "Q.D.S";
												}elseif ($row['dosage'] == 5) {
													$dosage = "STAT";
												}elseif ($row['dosage'] == 6) {
													$dosage = "NOCT";
												}

											if ($row['sdosage'] == 1) {
													$sdosage = "DLY";
												}elseif ($row['sdosage'] == 2) {
													$sdosage = "B.D";
												}elseif ($row['sdosage'] == 3) {
													$sdosage = "T.D.S";
												}elseif ($row['sdosage'] == 4) {
													$sdosage = "Q.D.S";
												}elseif ($row['sdosage'] == 5) {
													$dosage = "STAT";
												}elseif ($row['sdosage'] == 6) {
													$dosage = "NOCT";
												}
											$inst = $row['instruction'];
											$stat = $row['status'];
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
                            				<td><?php echo $money; ?></td>
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
                            				<th>Price</th>
                            				<th>Instruction</th>
                            			</thead>
                            		</table>
                            	</div>
                            </div>
                            <!--here-->
                            <span class="line">
                            	<?php endforeach;?>
		
		
		
		
	<!--end extra test-->
						</div>
                    </div>
                 </div>

            </div>
        </div>
	 <!-- //MAIN -->
	 <div class="side-button" style="background: <?php if ($paid > 0) {
	 	echo "#00b91d";
	 }else{
	 	echo "#bf0b0b";
	 } ?>;"><i class="fa <?php if ($paid > 0) {
	 	echo "fa-thumbs-o-up";
	 }else{
	 	echo "fa-thumbs-o-down";
	 } ?>"></i></div>


	 <!--Processing
	 <div class="side-button-p" style="background: <?php if ($given == 0) {
	 	echo "#1c7fbb";
	 }else{
	 	echo "#bf0b0b";
	 } ?>;" <?php if ($given == 0) {?>
	 	onclick="proce(<?php echo $pp_id; ?>,'<?php echo $pr_id; ?>')"
	 <?php
	}else{
		?>
		onclick="canc(<?php echo $pp_id; ?>,'<?php echo $pr_id; ?>')"
		<?php } ?>><i class="fa <?php if ($given == 0) {
	 	echo "fa-spinner";
	 }else{
	 	echo "fa-times";
	 } ?>"></i></div> -->
		<!--  footer -->
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>

 <div class="loader" id="load" style="display:none ">
</div>

<script type="text/javascript">
	var a=jQuery .noConflict();
		var p_id = <?php echo $_SESSION['sale']; ?>;
		var s_id = <?php echo $user_id; ?>;
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&id=' + p_id + '&s=' + s_id +'&ins=newBill_prep2d',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
					window.location = 'presc.php?pid=<?php echo $_GET['pid']; ?>';
				}
			});
        });
	a(function () {
		
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				d_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a(".input2").val(d_id);
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});
    });	
function sure(ID,name){ 
	
        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delSaleDet',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'presc.php?pid=<?php echo $_GET['pid']; ?>';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}

		function cancel_all(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delSaleDet_all',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'presc.php?pid=<?php echo $_GET['pid']; ?>';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}
		a('#page').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";			
			var val = <?php echo $_SESSION['sale']; ?>;
			a.ajax({
				type: "POST",
				data: a('#page').serialize() + '&val=' + val+'&ins=sendtoAccount2',
				url: "../func/verify.php",
				success: function(data) {
					document.getElementById("load").style.display = "none";
					if (data === 'Done') {
					console.log(data);
						window.location = 'presc.php?pid=<?php echo $_GET['pid']; ?>&status=done';
				  } else {
						a("#get_result").html(data).fadeIn("slow");
				  }
				}
			});
        });

        a('#patients'). on('change', function(e) {
        	var card = parseInt(document.getElementById("patients").value);
        	if (card == "0") {
				document.getElementById('opd').style.display = "block";	
        	}else{
				document.getElementById('opd').style.display = "none";	
        	}
       

        });
        function rem(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Payment Was Successfully"

            },{
                type: 'success',
                timer: 300000
            });

    	}

    	function proce(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to process prescription of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='proc("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function proc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=1' + '&doc=' + <?php echo $doc;?> + '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function canc(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Cancel Prescription Process of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function cncel(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=0' +  '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

</script>
<script>
function goBack() {
  window.history.back();
}
</script>
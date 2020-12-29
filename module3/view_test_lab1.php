
<?php 
	ob_start();
	session_start();
	$pageTitle = "View Blood Screening Result";
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
	$value = $_GET['id'];
	Database::getInstance()->seen_result($value);	
	$omi = "";
	$donor_id = database::getInstance()->get_name_from_id('donor_id','blood_test_group','link_ref',$value);
	$donor_d = database::getInstance()->select_from_where2('donors','donor_id',$donor_id);
	foreach ($donor_d as $donor) {
		$p_name = $donor['name'];
		$p_sex = $donor['gender'];
		$p_addr = $donor['address'];
		$p_dob = $donor['dob'];
		$p_age = 1;
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
           padding-top: 20px;
           padding-bottom: 72px ;
         }
}
			</style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
				 <?php
                      $noarray = database::getInstance()->select_all_test($value);
                       foreach($noarray as $opow){
						$contt = Database::getInstance()->select_all_test3($opow['lab_test_type_id'],$opow['link_ref']);
							 
				?>
					 <div class="col-md-12">
                      
                      
						<div class="clearTwenty"></div>	
                
				<?php } ?>
				
				  <div class="card">
				<table class="table table-bordered">
					<tr>
						<td colspan="4">
							<center>
								<?php
								$db =  mysqli_connect("localhost","root","","noahhms");
								$info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
								$get_hospital_info = mysqli_fetch_assoc($info);
								$name = $get_hospital_info['name'];
								$address = $get_hospital_info['address'];
								$phone = $get_hospital_info['phone'];
								$email =  $get_hospital_info['email'];
								?>
								<h2><b><?php echo $name; ?></b></h2>
							<?php echo $address; ?><br>
							<?php echo $phone; ?> <?php echo $email; ?>
							<br>
							<br>
								<b class="h3">LABORATORY RESULT</b>
							</center>
						</td>
					</tr>
					<tr>
						<td width="50%"><b>Name Of Donor: </b><?php echo $p_name; ?></td>
						<td width="20%"><b>Date Of Birth: </b><?php echo $p_dob; ?></td>
						<td  width="8%"><b>Age: </b><?php echo $p_age; ?></td>
						<td  width="12%"><b>Sex: </b><?php echo $p_sex; ?></td>						
					</tr>
					<tr>
						<td colspan="4"><b>Address: </b><?php echo $p_addr; ?></td>
					</tr>
					<tr>
						<td colspan="4"><b>Clinician / Consultant: </b>
							<?php
								$sql_doc = mysqli_query($db, "SELECT first_name, last_name FROM staff WHERE user_id = ".$doc_id."");
								while ($get_doc = mysqli_fetch_assoc($sql_doc)) {
									$doc_name = $get_doc['last_name']." ".$get_doc['first_name'];

								}
								echo $doc_name; 
							?>
						</td>
					</tr>
					<tr>
						<td colspan="4"><b>Scientist: </b>
							<?php
							$lab_id = Database::getInstance()->get_name_from_id('lab_id','patient_test_group','link_ref',$_GET['id']); 
								$sql_lab = mysqli_query($db, "SELECT first_name, last_name FROM staff WHERE user_id = ".$lab_id."");
								while ($get_lab = mysqli_fetch_assoc($sql_lab)) {
									$lab_name = $get_lab['last_name']." ".$get_lab['first_name'];

								}
								echo $lab_name; 
							?>
						</td>
					</tr>
					<tr>
						<td colspan="4"><b>Selected Tests:  </b>
							<?php
								$sql_al = mysqli_query($db, "SELECT lab_test_id, lab_test_type_id FROM blood_test WHERE link_ref = '".$value."'");
								while ($get_al = mysqli_fetch_assoc($sql_al)) {
									$al_lti = $get_al['lab_test_id'];
								if (!empty($al_lti)) {
									$sql_lt = mysqli_query($db, "SELECT lab_test FROM lab_test WHERE lab_test_id = ".$al_lti."");
									while ($lb = mysqli_fetch_assoc($sql_lt)) {
										$test .= $lb['lab_test'].", ";
									}
								}else{
									echo "Nil";
								}

								}
								echo $test;
							?>
						</td>
					</tr>
					<?php
						$sql = mysqli_query($db, "SELECT DISTINCT test_name FROM blood_test_result WHERE ref_id = '".$value."'");
						while ($get = mysqli_fetch_assoc($sql)) {
							$test_name2 = $get['test_name']; 
						?>
						<tr>
						<td><?php 
						$no1 = database::getInstance()->select_from_where2('lab_temp_name','id',$test_name2);
			                        foreach($no1 as $row1):
										$la_name1 = $row1['name'];
									endforeach;
						echo $la_name1; ?>
						
						</td>
						<td colspan="3">
									<table class="table table-bordered">
										<th>//</th>
										<th>Values</th>
							<?php
								$sql21 = mysqli_query($db, "SELECT lab_temp_id,value,date_added FROM blood_test_result WHERE ref_id = '".$value."' AND test_name = ".$test_name2."");
								while ($get2 = mysqli_fetch_assoc($sql21)) {
									?>									
												<?php 
													$sql22 = mysqli_query($db, "SELECT temp_name FROM lab_temps WHERE id = ".$get2['lab_temp_id']."");
													while ($get3 = mysqli_fetch_assoc($sql22)) {
														?>
															<tr>
																<td><?php echo str_replace("_", " ", ucwords($get3['temp_name'])); ?></td>
																<td><?php echo $get2['value']; ?></td>
															</tr>
														<?php
													}
												?>
									<?php
								}
							?>
							</table>
						</td>
					<tr>
						<?php
						};
						
					?>
						
					</tr>                             
			                    </table>
								
								<div class="clearTwenty"></div>	

							<button  type="button" id="submitEP" class="btn btn-success no-print" onclick="myFunction()"> Print</button>
							
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
            	message: "Are you sure you want to delete <b>"+name+"</b> Vitals ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delPatientVital',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'vitals';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

 function myFunction() {
    window.print();
}

    </script>

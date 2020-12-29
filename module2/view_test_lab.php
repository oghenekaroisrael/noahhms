<?php 
	ob_start();
	session_start();
	$pageTitle = "View Lab Test";
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
	$pid = $_GET['pid'];
	$p_name = $_GET['n'];
	$p_sex = $_GET['s'];
	$p_age = $_GET['a'];
	$doc_id = $_GET['did'];	
	$db =  mysqli_connect("localhost","root","","noahhms");
	$pat = mysqli_query($db, "SELECT patient_id FROM accounts WHERE order_id = '".$value."'");
	$pa = mysqli_fetch_assoc($pat);
	$sql_pt = mysqli_query($db, "SELECT address,dob FROM patients WHERE id = ".$pa['patient_id']."");
	$get_pt = mysqli_fetch_assoc($sql_pt);
	$p_addr = $get_pt['address'];
	$p_dob = $get_pt['dob'];
?>

<style>
			@media print {
    .no-print{display: none;}
    .content{height:inherit;}
	 @page {
           margin:0;
           width: 100%;
           margin-left: -130px;
         }
         body  {
           padding:0;
           position: absolute;
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
								<img src="../assets/images/hospital.png" style="height: 200px;width: 200px; float: left;"><h2  style="font-size: 64px;font-family: arial black;"><b><?php echo $name; ?></b></h2>
							<font style="font-size: 28px;font-family: calibri;font-weight: bold;"><?php echo $address; ?><br>
							<?php echo $phone; ?> <?php echo $email; ?></font>
							<br>
							<div class="head-cont" style="font-size: 24px; width: 40%;font-family: arial black;">
								LABORATORY RESULT
							</div>
							</center>
						</td>
					</tr>
					<tr>
						<td width="45%" style="font-size: 24px;"><b>Name Of Patient: </b><?php echo $p_name; ?></td>
						<td width="20%" style="font-size: 24px;"><b>Date Of Birth: </b><?php echo $p_dob; ?></td>
						<td  width="8%" style="font-size: 24px;"><b>Age: </b><?php echo $p_age; ?></td>
						<td  width="12%" style="font-size: 24px;"><b>Sex: </b><?php echo $p_sex; ?></td>						
					</tr>
					<tr>
						<td colspan="4" style="font-size: 24px;"><b>Address: </b><?php echo $p_addr; ?></td>
					</tr>
					<tr>
						<td colspan="4" style="font-size: 24px;"><b>Clinician / Consultant: </b>
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
						<td colspan="4" style="font-size: 24px;"><b style="color: red;">Allergies: </b>
							<?php
								$sql_al = mysqli_query($db, "SELECT allergies FROM patient_appointment WHERE patient_id = ".$pid."");
								while ($get_al = mysqli_fetch_assoc($sql_al)) {
									$al_name = $get_al['allergies'];

								}
								if (!empty($al_name)) {
									echo $al_name;
								}else{
									echo "Nil";
								}
							?>
						</td>
					</tr>
					<?php
						$sql = mysqli_query($db, "SELECT DISTINCT test_name FROM patient_test_result WHERE ref_id = '".$value."'");
						while ($get = mysqli_fetch_assoc($sql)) {
							$test_name2 = $get['test_name']; 
						?>
						<tr>
						<td style="font-size: 24px;"><?php 
						$no1 = database::getInstance()->select_from_where2('lab_temp_name','id',$test_name2);
			                        foreach($no1 as $row1):
										$la_name1 = $row1['name'];
									endforeach;
						echo $la_name1; ?>
						
						</td>
						<td colspan="3" style="font-size: 24px;">
									<table class="table table-bordered">
										<th>//</th>
										<th>Value</th>
										<th>Date</th>
							<?php
								$sql21 = mysqli_query($db, "SELECT lab_temp_id,value,date_added FROM patient_test_result WHERE ref_id = '".$value."' AND test_name = ".$test_name2."");
								while ($get2 = mysqli_fetch_assoc($sql21)) {
									?>									
												<?php 
													$sql22 = mysqli_query($db, "SELECT temp_name FROM lab_temps WHERE id = ".$get2['lab_temp_id']."");
													while ($get3 = mysqli_fetch_assoc($sql22)) {
														?>
															<tr>
																<td style="font-size: 24px;"><?php echo str_replace("_", " ", ucwords($get3['temp_name'])); ?></td>
																<td style="font-size: 24px;"><?php echo $get2['value']; ?></td>
																<td style="font-size: 24px;"><?php echo $get2['date_added']; ?></td>
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

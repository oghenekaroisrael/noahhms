
<?php 
	ob_start();
	session_start();
	$pageTitle = "View Scan";
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
	$sql_pt = mysqli_query($db, "SELECT address,dob FROM patients WHERE id = ".$pid."");
	while ($get_pt = mysqli_fetch_assoc($sql_pt)) {
		$p_addr = $get_pt['address'];
		$p_dob = $get_pt['dob'];

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
                      $noarray = database::getInstance()->select_scan_to($value);
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
							<div class="head-cont">
								SCAN RESULT
							</div>
							</center>
						</td>
					</tr>
					<tr>
						<td width="50%"><b>Name Of Patient: </b><?php echo $p_name; ?></td>
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
						<td colspan="4"><b style="color: red;">Allergies: </b>
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
					<tr>
						<td colspan="4"><b>Selected Scans:  </b>
							<?php
								$sql_al = mysqli_query($db, "SELECT name, type FROM scan_requests WHERE link = '".$value."'");
								while ($get_al = mysqli_fetch_assoc($sql_al)) {
									$al_lti = $get_al['name'];
								if (!empty($al_lti)) {
									$sql_lt = mysqli_query($db, "SELECT name FROM scan WHERE id = ".$al_lti."");
									while ($lb = mysqli_fetch_assoc($sql_lt)) {
										$n .= $lb['name'].",";
									}
									echo substr(trim($n), 0,-1);
								}else{
									echo "Nil";
								}

								}
							?>
						</td>
					</tr>
				</table>
				<table  class="table table-bordered">
					<?php
						$sql = mysqli_query($db, "SELECT * FROM patient_scan_result WHERE patient_id = ".$_GET['pid']."  AND ref_id = '".$_GET['id']."' ORDER BY  id DESC");
						while ($get = mysqli_fetch_assoc($sql)) {
						?>
						<tr>
						<td width="20%"><?php echo $get['scan_name']; ?>
						
						</td>
						<td  width="20%">
							<img src="../extrafile/<?php echo $get['file'];?>" height="300" width="300">
						</td>
						<td colspan="2"  width="60%">
							<?php echo $get['comment'];?>
						</td>
					</tr>
						<?php
						}
						
					?>                             
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

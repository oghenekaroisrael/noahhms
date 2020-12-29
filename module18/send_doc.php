<?php 
	ob_start();
	session_start();
	$pageTitle = "New Appointment";
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
	$db = mysqli_connect("localhost","root","","noahhms");
	$last  = mysqli_query($db,"SELECT DISTINCT patient_id FROM patient_test WHERE link_ref LIKE '".$_GET['id']."' ORDER BY patient_id DESC LIMIT 1 ");
	$get_last = mysqli_fetch_assoc($last);
	$last2  = mysqli_query($db,"SELECT patient_appointment_id FROM patient_test WHERE link_ref LIKE '".$_GET['id']."' AND patient_id = ".$get_last['patient_id']." ORDER BY patient_id DESC LIMIT 1 ");
	$get_last2 = mysqli_fetch_assoc($last2);
	$name = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$get_last['patient_id']." LIMIT 1");
    $get_name = mysqli_fetch_assoc($name);
	if(!isset($_POST['send'])){
		unset($_POST);
	}else{
		$doc = $_POST['doctor'];
		$link = $_GET['id'];
		$patient_id = $get_last['patient_id'];
		$sql = "INSERT INTO send_test (`patient_id`,`staff_to`, `staff_from`, `link`,`appointment_id`) VALUES (".$patient_id.",'".$doc."',0,'".$link."',".$get_last2['patient_appointment_id'].")";
		$ins = mysqli_query($db, $sql);
		if ($ins) {
			$final = "<div class='alert alert-success'>
						Test Has Been Sent To Doctors</div>";
		}
	}
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
                                <h4 class="title">Send Test Result For <b><?php                                 	
                                	echo $get_name['surname']." ".$get_name['first_name'];
                                	
                                ?></b> To A Doctor</h4>
                            </div>
                            <div class="result">
                            	<?php echo $final;?>
                            </div>
                            <div class="content">
                                <form method="POST" action="">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Choose Doctor</label>
	                                                <select class="form-control" name="doctor">
													<option value="">Choose Doctor</option>
													<option value="all_doctors">All Doctors</option>
													<?php
														$doc_id = 5;

														$userDetails = Database::getInstance()->select_from_where2('staff', 'role_id', $doc_id);
														foreach($userDetails as $ow):
															$id = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

								    <button type="submit" name="send" class="btn btn-info btn-fill pull-right">Send To Doctor</button>
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



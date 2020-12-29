<?php 
	ob_start();
	session_start();
	error_reporting(0);
	$pageTitle = "View Lab Test";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
	}

	include_once '../inc/header-index.php'; //for addding header
	$value = $_GET['id'];
	$db = mysqli_connect("localhost","root","","noahhms");
	if (!isset($_POST['submit'])) {
		unset($_POST);
		$success = "";
	}else{
		$form = substr(trim($_GET['form']), 4);
		$ref = $_GET['id'];

		$sql_labtn = mysqli_query($db, "SELECT * FROM lab_test WHERE lab_test_id = ".$form." ORDER BY lab_test_type_id DESC");
		if (!empty($sql_labtn)) {
			while ($get_labtn = mysqli_fetch_assoc($sql_labtn)) {
				$temp = $get_labtn['template'];
				$sql_labTemp = mysqli_query($db,"SELECT * FROM lab_temps WHERE label_id = ".$temp." ORDER BY label_id DESC ");
				if (!empty($sql_labTemp)) {
					while ($get_labTemp = mysqli_fetch_assoc($sql_labTemp)) {
						$id = $get_labTemp['id'];
						$temp_name = $get_labTemp['temp_name'];
						$val = $_POST[$temp_name];
						$exist = mysqli_query($db, "SELECT * FROM blood_test_result WHERE  test_id = ".$form." AND ref_id = '".$ref."' AND test_name = ".$temp." AND lab_temp_id = ".$id."");
						if (mysqli_num_rows($exist) > 1) {
							while ($ext = mysqli_fetch_assoc($exist)) {							
								$insertRes = mysqli_query($db, "UPDATE blood_test_result SET test_id = ".$form.",ref_id = '".$ref."', value = '".$val."', test_name = ".$temp.", lab_temp_id = ".$id." WHERE ref_id LIKE '".$ref."' AND lab_temp_id = ".$ext['lab_temp_id']."");

						}
						if ($insertRes) {
							$success = "Done2";
							$update_await = mysqli_query($db,"UPDATE blood_test_group SET awaiting_result = 1,lab_id = ".$user_id." WHERE link_ref = '".$ref."'");
							if ($update_await) {
								$success = "Done2";
							}else{
								$success = "Not Done2";
							}
						}else{
							$success = "Not Done2";
						}
						}else{
						$donor_id = database::getInstance()->get_name_from_id('donor_id','blood_test_group','link_ref',$value);
						$insertRes = mysqli_query($db, "INSERT INTO blood_test_result(donor_id,test_id,ref_id, value, test_name, lab_temp_id) VALUES(".$donor_id.",".$form.",'".$ref."','".$val."',".$temp.",".$id.")");
						if ($insertRes) {
							$success = "Done";
							$update_await = mysqli_query($db,"UPDATE blood_test_group SET awaiting_result = 1,lab_id = ".$user_id." WHERE link_ref LIKE '".$ref."'");
							if ($update_await) {
								$success = "Done";
							}else{
								$success = "Not Done";
							}
						}else{
							$success = "Not Done";
						}
					}
					}
				}
			}
		}
	}
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">            
            <div class="container-fluid">
            	<div class="row">
            		<div class="col-lg-12">
            			<h3 class="title text-center"> REQUESTED TESTS</h3>
            		</div>
            		<hr>
            	</div>
														<div id="get_resultd">
															<?php 
																if ($success == "Done") {
																	echo '<div class="alert alert-success">
																			Result Entered
																		</div>';
																		unset($success);
																		$p_name = database::getInstance()->select_from_where2("donors","donor_id",$p_id);
																			foreach ($p_name as $pname) {
																				$pan = $pname['name'];
																				$page = $pname['age'];
																				$psex = $pname['gender'];
																			}
																}elseif ($success == "Not Done") {
																	echo '<div class="alert alert-danger">
																			 Test Result could not be Inserted 1
																		  </div>';
																}elseif ($success == "Done2") {
																	echo '<div class="alert alert-success">
																			Result Updated
																		</div>';
																		unset($success);
																		$p_name = database::getInstance()->select_from_where2("donors","donor_id",$p_id);
																			foreach ($p_name as $pname) {
																				$pan = $pname['name'];
																				$page = $pname['age'];
																				$psex = $pname['gender'];
																			}
							mysqli_query($db, "INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
							VALUES (".$doc.",".$p_id.",'Results Are Available For: ','view_test_lab?id=".$_GET['id']."&pid=".$p_id."&n=".$pan."&a=".$page."&s=".$psex."&did=".$user_id."',NOW(),0)");
																}elseif ($success == "Not Done2") {
																	echo '<div class="alert alert-danger">
																			 Test Result could not be Inserted2
																		  </div>';
																}
															?>
														</div>
            	<div class="row">            		
            		<div class="col-lg-12">
            			<?php $view_all = Database::getInstance()->select_view_blood_tests($value);
            			foreach ($view_all as $row):
						$labTn = Database::getInstance()->select_from_where2('lab_test','lab_test_id', $row['lab_test_id']); 
							foreach ($labTn as $rows):
							$counts = $rows['lab_test_id'];
            				?>
            				<div class="accordion">
            					<?php
            						 $con = mysqli_connect("localhost","root","","noahhms");
            						 $cont = $row['lab_test_type_id'];
            						 	?>
            						 		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#con<?php echo $counts;?>" aria-expanded="false" aria-controls="con<?php echo $counts;?>" style="width: 100%;margin-bottom: 20px;">
                            			<?php echo $rows['lab_test']; ?></button>
                            			
                            		<div class="collapse" id="con<?php echo $counts;?>">
	                            			<div class="card">
	                            				<div class="content">
	                            					<form id="resu" method="POST" action="view_test1.php?id=<?php echo $_GET['id']; ?>&app=<?php echo $_GET['app']; ?>&form=form<?php echo $counts; ?>">									
														<div>
															<?php
															$sep = mysqli_query($con, "SELECT * FROM lab_temps WHERE label_id = ".$rows['template']."");
															foreach ($sep as $key) {
																		?>
																		<div class="col-md-6">
																			<div class="row">
																				<div class="col-md-12">
																					<div class="form-group">
				<label><?php echo $key['temp_name'];?></label>
				<input type="text" class="form-control" name="<?php echo $key['temp_name'];?>" placeholder="<?php echo $key['temp_name'];?>">

																					</div>
																				</div>
																			</div>
																		</div>
							            						 	<?php

							            						 }						            						
							            					?>
														</div>
														<div class="clearfix"></div>
					                                    <button type="submit" class="btn btn-info btn-fill pull-right" name="submit">Add Result</button>
														<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
					                                    <div class="clearfix"></div>
					                                </form>
														<div class="clearTwenty"></div>
	                            				</div>
	                            			</div>
                            		</div>
            			</div>
            				<?php
            			endforeach;
            			endforeach;
            			?>
            			
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


<div class="loader" id="load" style="display:none; ">
</div>
<script type="text/javascript">
var a=jQuery .noConflict();			
		a(function () {

			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#schedule').serialize() + '&ins=getFields' + '&temp=<?php echo $temp; ?>',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
      
    });
</script>
<!--<script type="text/javascript">
	//Lets ajaxify this part on submit
	var j=jQuery .noConflict();
	j(function () {
		j('#resu').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var test = '<?php echo $counts;?>';
			var id = '<?php echo $_GET['id'];?>';
			var app_id = '<?php echo $row['patient_appointment_id'];?>';
			var temp = '<?php echo $rows['template'];?>';
			j.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: j('#resu').serialize()+ "&temp="+ temp + "&p_id="+ p_id + "&test="+ test + "&id="+ id + '&ins=insertRes',
				success: function(data){
					document.getElementById("load").style.display = "none";
					if(data === "Done"){
						j('#get_resultd').html(data);
					} else {
						j("#get_resultd").html(data).fadeIn("slow");
					} 
					console.log(data);
				}
			});
		});
	});
</script>-->
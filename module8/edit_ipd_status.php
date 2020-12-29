<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit IPD Status";
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
	
	$value= $_GET['edit'];
	$patient= $_GET['pat'];
	$patient = Database::getInstance()->get_name_from_id('reg_num', 'patients','id',$patient);
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
                                <h4 class="title">Edit <b><?php echo $patient; ?></b>Status</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Status</label>
	                                                <select class="form-control" name="status">
													<option value="">Select Status</option>
													<?php
														$beda = Database::getInstance()->select_from_ord1('admission_status', 'admission_status_id','DESC');
														foreach($beda as $ow):
															$id = $ow['admission_status_id'];
															$adm = $ow['admission_status'];	
														
													?>
													<option value="<?php echo $id;?>"><?php echo $adm;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
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
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&val=<?php echo $value ?>'+ '&ins=editAdmissionStatus',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>


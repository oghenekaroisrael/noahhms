<?php 
	ob_start();
	session_start();
	$pageTitle = "New Surgery";
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
                                <h4 class="title">Surgery</h4>
                            </div>
                            <div class="content">
                                <form id="card">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Surgery Date</label>
	                                                <input type="date" class="form-control" name="sur_date">
	                                            </div>
	                                        </div>

	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Surgery Time</label>
	                                                <input type="text" class="form-control" name="sur_time" placeholder="Surgery Time E.g: 10:00am" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                       	<label>Patient</label>
												 <select  name="patient" class="form-control">
													<option value="">None</option>
													<?php 
														$notray = database::getInstance()->select_from_ord1('patients','id','DESC');
														foreach($notray as $uow):
													?>
                                            
														<option value="<?php echo $uow['id'];?>"><?php echo $uow['title']." ".$uow['surname']." ".$uow['first_name']." ".$uow['middle_name	'];?></option>
													<?php endforeach; ?>
												</select>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Surgery Title</label>
	                                                <input type="text" class="form-control" name="sur_name" placeholder="Surgery Title" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Remark</label>
	                                                <textarea type="text" class="form-control" name="sur_remark" placeholder="Remark" ></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<!--
									<div class="col-md-12">
										<div class="row">
	                                       <div class="checkbox">
												<label><input type="checkbox" value="">I hereby give permission for an operation to be performed and i leave the the extent
												of the operation to the discretion of the Surgeon</label>
											</div>
										</div>
									</div>
									-->
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Patient</button>
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
	a('#card').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var doc = "<?php echo $user_id; ?>";
			a.ajax({
				type: "POST",
				data: a('#card').serialize() + '&ins=newSurgery&doc='+doc,
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
    });
</script>


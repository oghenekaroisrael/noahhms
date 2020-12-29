<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Observation";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$value = $_GET['edit'];
	
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
                                <h4 class="title">Edit Observations</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											
										<?php
			                            $noarray = database::getInstance()->select_from_where('patient_obs','patient_obs_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            	?>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Temp</label>
	                                                <input type="text" class="form-control" name="temp" placeholder="Temp" value="<?php echo $ow['temp'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Resr</label>
	                                                <input type="text" class="form-control" name="resr" placeholder="Resr" value="<?php echo $ow['resr'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Pulse</label>
	                                                <input type="text" class="form-control" name="pulse" placeholder="Pulse" value="<?php echo $ow['pulse'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>BP</label>
	                                                <input type="text" class="form-control" name="bp" placeholder="BP" value="<?php echo $ow['bp'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Intake</label>
	                                                <input type="text" class="form-control" name="intake" placeholder="Intake" value="<?php echo $ow['intake'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Output</label>
	                                                <input type="text" class="form-control" name="output" placeholder="Output" value="<?php echo $ow['output'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Observation</button>
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
		var val = "<?php echo $value;?>"; 
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() +  '&val=' + val + '&ins=editObs',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


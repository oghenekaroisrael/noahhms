<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Fluid";
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
                                <h4 class="title">Dipensing Chart</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											<?php
			                            $noarray = database::getInstance()->select_from_where('patient_fluid','patient_fluid_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            	?>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Nature Of Fluid</label>
	                                                <input type="text" class="form-control" name="nature" placeholder="Nature Of Fluid" value="<?php echo $ow['nature'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Oral</label>
	                                                <input type="text" class="form-control" name="oral" placeholder="Oral" value="<?php echo $ow['oral'];?>">
	                                            </div>
	                                        </div>
											
											 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Rectal</label>
	                                                <input type="text" class="form-control" name="rectal" placeholder="Rectal" value="<?php echo $ow['rectal'];?>" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>IV</label>
	                                                <input type="text" class="form-control" name="iv" placeholder="IV" value="<?php echo $ow['iv'];?>">
	                                            </div>
	                                        </div>
											
											 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Other Routes</label>
	                                                <input type="text" class="form-control" name="other1" placeholder="Other Routes" value="<?php echo $ow['intake_other'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Total</label>
	                                                <input type="text" class="form-control" name="total1" placeholder="Total" value="<?php echo $ow['intake_total'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Output</h4>
		                            </div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Urine</label>
	                                                <input type="text" class="form-control" name="urine" placeholder="Urine" value="<?php echo $ow['urine'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Vomit</label>
	                                                <input type="text" class="form-control" name="vomit" placeholder="Vomit" value="<?php echo $ow['vomit'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tube</label>
	                                                <input type="text" class="form-control" name="tube" placeholder="Tube" value="<?php echo $ow['tube'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Other Routes</label>
	                                                <input type="text" class="form-control" name="other2" placeholder="Other Routes" value="<?php echo $ow['output_other'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Total</label>
	                                                <input type="text" class="form-control" name="total2" placeholder="Total" value="<?php echo $ow['output_total'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Balance</label>
	                                                <input type="text" class="form-control" name="balance" placeholder="Balance" value="<?php echo $ow['balance'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Chloride In Urine</label>
	                                                <input type="text" class="form-control" name="chloride" placeholder="Chloride In Urine" value="<?php echo $ow['chloride'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Fluid Chart</button>
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
				data: a('#appt').serialize() +  '&val=' + val + '&ins=editFluid',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


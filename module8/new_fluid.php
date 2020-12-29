<?php 
	ob_start();
	session_start();
	$pageTitle = "New Fluid";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$p_id = $_GET['id'];
	$ipid = $_GET['ipid'];
	
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
											

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Nature Of Fluid</label>
	                                                <input type="text" class="form-control" name="nature" placeholder="Nature Of Fluid" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Oral</label>
	                                                <input type="text" class="form-control" name="oral" placeholder="Oral" >
	                                            </div>
	                                        </div>
											
											 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Rectal</label>
	                                                <input type="text" class="form-control" name="rectal" placeholder="Rectal" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>IV</label>
	                                                <input type="text" class="form-control" name="iv" placeholder="IV" >
	                                            </div>
	                                        </div>
											
											 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Other Routes</label>
	                                                <input type="text" class="form-control" name="other1" placeholder="Other Routes" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Total</label>
	                                                <input type="text" class="form-control" name="total1" placeholder="Total" >
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
	                                                <input type="text" class="form-control" name="urine" placeholder="Urine" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Vomit</label>
	                                                <input type="text" class="form-control" name="vomit" placeholder="Vomit" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tube</label>
	                                                <input type="text" class="form-control" name="tube" placeholder="Tube" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Other Routes</label>
	                                                <input type="text" class="form-control" name="other2" placeholder="Other Routes" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Total</label>
	                                                <input type="text" class="form-control" name="total2" placeholder="Total" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Balance</label>
	                                                <input type="text" class="form-control" name="balance" placeholder="Balance" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Chloride In Urine</label>
	                                                <input type="text" class="form-control" name="chloride" placeholder="Chloride In Urine" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add To Fluid Chart</button>
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
		var ipid = "<?php echo $ipid;?>"; 
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() +  '&ipid=' + ipid + '&ins=newFluid',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>


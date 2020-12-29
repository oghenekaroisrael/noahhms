<?php 
	ob_start();
	session_start();
	$pageTitle = "New Antenatal Record";
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
                                <h4 class="title">Antenatal Record</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>EGA (Wks)</label>
	                                                <input type="text" class="form-control" name="ega" placeholder="EGA (Wks)" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>SFH (cm)</label>
	                                                <input type="text" class="form-control" name="sfh" placeholder="SFH (cm)" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Presentation</label>
	                                                <input type="text" class="form-control" name="pres" placeholder="Presentation" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Position</label>
	                                                <input type="text" class="form-control" name="pos" placeholder="Position" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Foetal Heart</label>
	                                                <input type="text" class="form-control" name="fh" placeholder="Foetal Heart" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Oedema</label>
	                                                <input type="text" class="form-control" name="o" placeholder="Oedema" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<label>Lab Result</label>
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <input type="text" class="form-control" name="u" placeholder="Urine" >
	                                            </div>
	                                        </div>

	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <input type="text" class="form-control" name="p" placeholder="PCV" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Weight</label>
	                                                <input type="text" name="w" class="form-control" placeholder="Weight">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Pressure (BP)</label>
	                                                <input type="text" class="form-control" name="bp" placeholder="Blood Pressure (BP)" >
	                                            </div>
	                                        </div>
										</div>
									</div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Record</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
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
		var ipid = "<?php echo $_GET['id'];?>"; 
		var by = "<?php echo $user_id;?>"; 
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() +  '&id=' + ipid +  '&by=' + by + '&ins=newAnteRecord',
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


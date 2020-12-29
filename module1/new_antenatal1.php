<?php 
	ob_start();
	session_start();
	$pageTitle = "New Antenatal";
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
                                <h4 class="title">Antenatal</h4>
                            </div>

                            <div class="content">
                                <form id="ante">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-4">
	                                           <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" >
			                                    </div>   
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="first_name" placeholder="Position">
												</div>
	                                        </div>

	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Hospital Number</label>
	                                                <input type="text" class="form-control" name="hosp_num" placeholder="Position">
												</div>
	                                        </div>  
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label>Special Points / Instructions</label>
	                                                <textarea class="form-control" name="instructions" placeholder="Instructions / Special Points"></textarea>
										</div>
									</div>	

									<div class="row">
										<div class="col-lg-6">
											<label>Address</label>
	                                                <textarea class="form-control" name="address" placeholder="Home Address"></textarea>
										</div>

										<div class="col-lg-6">
											<label>Duration of Pregnancy At Booking</label>
	                                                <textarea class="form-control" name="preg_duration" placeholder="Duration of Pregnancy At Booking"></textarea>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<label>Age</label>
	                                                <input type="number" name="age" class="form-control" placeholder="Age">
										</div>

										<div class="col-lg-4">
											<label>Age Of Marriage</label>
	                                                <input type="number" name="marriage_age" class="form-control" placeholder="Age Of Marriage">
										</div>

										<div class="col-lg-4">
											<label>L.M.P</label>
	                                        <input type="text" name="lmp" class="form-control" placeholder="L.M.P">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<label>Tribe</label>
	                                                <input type="text" name="tribe" class="form-control" placeholder="Tribe">
										</div>

										<div class="col-lg-4">
											<label>Occupation</label>
	                                                <input type="text" name="occupation" class="form-control" placeholder="Occupation">
										</div>

										<div class="col-lg-4">
											<label>E.D.D</label>
	                                        <input type="text" name="edd" class="form-control" placeholder="E.D.D">
										</div>
									</div>	

										</div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Antenatal</button>
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

		a('#ante').on('submit', function (e) {
			var staff = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#ante').serialize()  + '&ins=newAntenatal&staff='+staff,
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
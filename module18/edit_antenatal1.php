<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Antenatal";
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
	$id = $_GET['id'];
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
                                <form id="change_ante">
									<?php
										$noarray = database::getInstance()->select_from_where('antenatal1','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-4">
	                                           <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $row['surname']; ?>">
			                                    </div>   
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="first_name" placeholder="Position" value="<?php echo $row['first_name']; ?>">
												</div>
	                                        </div>

	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Hospital Number</label>
	                                                <input type="text" class="form-control" name="hosp_num" placeholder="Position" value="<?php echo $row['hospital_number']; ?>">
												</div>
	                                        </div>  
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<label>Special Points / Instructions</label>
	                                                <textarea class="form-control" name="instructions" placeholder="Instructions / Special Points"><?php echo $row['instructions']; ?></textarea>
										</div>
									</div>	

									<div class="row">
										<div class="col-lg-6">
											<label>Address</label>
	                                                <textarea class="form-control" name="address" placeholder="Home Address"><?php echo $row['address']; ?></textarea>
										</div>

										<div class="col-lg-6">
											<label>Duration of Pregnancy At Booking</label>
	                                                <textarea class="form-control" name="preg_duration" placeholder="Duration of Pregnancy At Booking"><?php echo $row['preg_duration']; ?></textarea>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<label>Age</label>
	                                                <input type="number" name="age" class="form-control" placeholder="Age" value="<?php echo $row['age']; ?>">
										</div>

										<div class="col-lg-4">
											<label>Age Of Marriage</label>
	                                                <input type="number" name="marriage_age" class="form-control" placeholder="Age Of Marriage" value="<?php echo $row['marriage_age']; ?>">
										</div>

										<div class="col-lg-4">
											<label>L.M.P</label>
	                                        <input type="text" name="lmp" class="form-control" placeholder="L.M.P" value="<?php echo $row['lmp']; ?>">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<label>Tribe</label>
	                                                <input type="text" name="tribe" class="form-control" placeholder="Tribe" value="<?php echo $row['tribe']; ?>">
										</div>

										<div class="col-lg-4">
											<label>Occupation</label>
	                                                <input type="text" name="occupation" class="form-control" placeholder="Occupation" value="<?php echo $row['occupation']; ?>">
										</div>

										<div class="col-lg-4">
											<label>E.D.D</label>
	                                        <input type="text" name="edd" class="form-control" placeholder="E.D.D" value="<?php echo $row['edd']; ?>">
										</div>
									</div>	

										</div>
									</div>
									<?php } ?>
									<div class="clearTwenty"></div>
									
									<div class="clearTwenty"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Antenatal</button>
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

		a('#change_ante').on('submit', function (e) {
			var ID = "<?php echo $_GET['id']; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAntenatal&edit='+ ID,
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
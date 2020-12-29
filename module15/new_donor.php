<?php 
	ob_start();
	session_start();
	$pageTitle = "New Donor";
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
                                <h4 class="title">Donor Registration</h4>
                            </div>

                            <div class="content">
                                <form id="schedule">
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Full Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Full Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Father's Full Name</label>
	                                                <input type="text" class="form-control" name="father_name" placeholder="Father's Full Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Sex</label>
	                                                <select name="sex" class="form-control">
	                                                	<option value="Male">Male</option>
	                                                	<option value="Female">Female</option>
	                                                </select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">Date Of Birth</label>
                                                    <input class="form-control" name="dob" type="date" required id="example-date-input">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Body Weight</label>
	                                                <input type="text" class="form-control" name="weight" placeholder="Body Weight" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Group</label>
	                                                <select class="form-control" id="type" name="type">
														<option disabled>Select Blood Group</option>
														<?php 
														$contt = Database::getInstance()->select_from_ord1('blood_groups', 'blood_group_id','DESC');
														foreach($contt as $ow){
														?>
														<option value="<?php echo $ow['blood_group_id']?>"><?php echo $ow['blood_group']?></option>
														<?php } ?>
														
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Address</label>
	                                                <input type="text" class="form-control" name="address" placeholder="Home Address" >
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Email</label>
	                                                <input type="email" class="form-control" name="email" placeholder="Email Address" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Phone Number</label>
	                                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" >
	                                            </div>
	                                        </div>
										</div>
									</div>




                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Donor</button>
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
		a('#schedule').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#schedule').serialize() + '&ins=newDonor',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


<?php 
	ob_start();
	session_start();
	$pageTitle = "New Xray";
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
                                <h4 class="title">New Xray</h4>
                            </div>

                            <div class="content">
                                <form id="schedule">
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Xray Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Xray Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Fee</label>
	                                                <input type="number" class="form-control" name="fee" placeholder="Fee" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Category</label>
	                                                <select class="form-control" id="type" name="type">
														<option value="type">Select Category</option>
														<?php 
														$contt = Database::getInstance()->select_from_ord1('xray_types', 'xray_cat_id','DESC');
														foreach($contt as $ow){
														?>
														<option value="<?php echo $ow['xray_cat_id']?>"><?php echo $ow['category']?></option>
														<?php } ?>
														
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">New Xray</button>
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
				data: a('#schedule').serialize() + '&ins=newXray',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


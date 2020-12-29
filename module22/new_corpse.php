<?php 
	ob_start();
	session_start();
	$pageTitle = "New Out Corpse";
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
                                <h4 class="title">Process Out Deceased</h4>
                            </div>
                            <div class="content">
                                <form>
								<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
			                                        <div class="form-group">
			                                            <label>Full Name</label>
			                                            <input type="text" class="form-control" name="name">
			                                        </div> 
			                                </div>

			                                <div class="col-md-6">
			                                        <div class="form-group">
			                                            <label>Sex</label>
			                                            <select class="form-control" name="sex">
			                                            	<option value="Male">Male</option>
			                                            	<option value="Female">Female</option>
			                                            </select>
			                                        </div> 
			                                </div>


			                                
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Relative Details</h4>
		                            </div>

		                            <div class="clearfix"></div>

		                            <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Relative's Fullname</label>
			                                            <input type="text" class="form-control" name="kname"/>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Relative's Phone  Number</label>
	                                                <input type="date" class="form-control" name="kphone">
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Relative's Address</label>
	                                                <input type="text" class="form-control" name="kaddress">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Relationship</label>
	                                                <input type="text" class="form-control" name="krel">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Bed / Room Assignment</h4>
		                            </div>

		                            <div class="clearfix"></div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Room Type</label>
	                                                <select class="form-control" name="room" id="room_type">
													<?php
														
														
														$wards = Database::getInstance()->select('morgue_bed_types');
														foreach($wards as $ward):

															$ward_id= $ward['id'];
															$ward = $ward['types'];	
														
													?>
													<option value="<?php echo $ward_id;?>"><?php echo $ward;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Bed Number</label>
	                                                 <select class="form-control" name="bed_num" id="bed">
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tag Number</label>
	                                                 <input class="form-control" name="tag">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Serial Number</label>
	                                                 <input class="form-control" name="serial">
	                                            </div>
	                                        </div>
										</div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Process</button>
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
<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&id=" + id + "&ins=processDeceased&staff=<?php echo $user_id; ?>&type=2",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})	
		s("#room_type").change(function(){
			var id = s(this).val();
			var post_id = 'id='+ id + 'bed=<?php echo $bed; ?>';
			s.ajax({
			type: "POST",
			url: "b.php",
			data: post_id,
			cache: false,
			success: function(res){
					s("#bed").html(res).fadeIn("slow");
				} 
			});
 
		});		
	})			
</script>


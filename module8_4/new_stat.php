<?php 
	ob_start();
	session_start();
	$pageTitle = "New Shift";
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
                                <h4 class="title">Duty</h4>
                            </div>

                            <div class="content">
                                <form id="duty">
									<div class="col-md-6">
										<div class="row">

											<div class="col-md-6">
	                                             <div class="form-group">
	                                                <label>Mornig or Night</label>
	                                                <select class="form-control" name="morn">
														<option value="">Choose</option>
														<option value="Morning">Morning</option>
														<option value="Night">Night</option>
													</select>
	                                            </div>
	                                        </div>  
											
	                                       <div class="col-md-2">
	                                           
			                                        <div class="form-group">
			                                            <label>Bed</label>
			                                            <input type="text" class="form-control" name="bed" placeholder="Bed" >
			                                        </div>   
			                                    
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>V-Bed</label>
	                                                <input type="text" class="form-control" name="v_bed" placeholder="V-Bed">
												</div>
	                                        </div> 
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
										 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>T-PT</label>
	                                                <input type="text" class="form-control" name="t_pt" placeholder="T-PT">
												</div>
	                                        </div> 
											
										
										<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Adm</label>
			                                        <input type="text" class="form-control" name="adm" placeholder="Adm" >
			                                     </div>
	                                        </div> 
	                                      
										  
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                               <label>Disc</label>
			                                        <input type="text" class="form-control" name="disc" placeholder="disc" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Delivery</label>
	                                                <input type="text" class="form-control" name="delivery" placeholder="Delivery" >
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
	                                                <label>Ceasarean</label>
	                                                <input type="text" class="form-control" name="cs" placeholder="Ceasarean" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Labour Case</label>
	                                                <input type="text" class="form-control" name="labour" placeholder="Labour Case" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>Trans In/Out</label>
	                                                <input type="text" class="form-control" name="trans" placeholder="Trans In/Out" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Death</label>
	                                                <input type="text" class="form-control" name="death" placeholder="Death" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
	                                            <label>Comment</label>
	                                            <textarea class="form-control" name="comment" placeholder="Comment" ></textarea>
	                                        </div>
										</div>
									</div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Duty Check</button>
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

		a('#duty').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#duty').serialize()  + '&ins=newDuty',
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


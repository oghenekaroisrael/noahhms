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
                                <h4 class="title">Duty</h4>
                            </div>

                            <div class="content">
                                <form id="duty">
									<?php
										$noarray = database::getInstance()->select_from_where('duty_check','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
	                                             <div class="form-group">
	                                                <label>Morning or Night</label>
	                                                <select class="form-control" name="morn">
														<option value="<?php echo $row['morn'];?>"><?php echo $row['morn'];?></option>
														<option value="Morning">Morning</option>
														<option value="Night">Night</option>
													</select>
	                                            </div>
	                                        </div>  
											
	                                       <div class="col-md-2">
	                                           
			                                        <div class="form-group">
			                                            <label>Bed</label>
			                                            <input type="text" class="form-control" name="bed" value="<?php echo $row['bed'];?>" >
			                                        </div>   
			                                    
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>V-Bed</label>
	                                                <input type="text" class="form-control" name="v_bed" placeholder="V-Bed" value="<?php echo $row['v_bed'];?>">
												</div>
	                                        </div> 
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
										 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>T-PT</label>
	                                                <input type="text" class="form-control" name="t_pt" placeholder="T-PT" value="<?php echo $row['t_pt'];?>">
												</div>
	                                        </div> 
											
										
										<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Adm</label>
			                                        <input type="text" class="form-control" name="adm" placeholder="Adm" value="<?php echo $row['adm'];?>" >
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
			                                        <input type="text" class="form-control" name="disc" placeholder="disc"  value="<?php echo $row['disc'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Delivery</label>
	                                                <input type="text" class="form-control" name="delivery" placeholder="Delivery" value="<?php echo $row['delivery'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
	                                                <label>Ceasarean</label>
	                                                <input type="text" class="form-control" name="cs" placeholder="Ceasarean" value="<?php echo $row['cs'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Labour Case</label>
	                                                <input type="text" class="form-control" name="labour" placeholder="Labour Case" value="<?php echo $row['labour'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>Trans In/Out</label>
	                                                <input type="text" class="form-control" name="trans" placeholder="Trans In/Out" value="<?php echo $row['trans'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Death</label>
	                                                <input type="text" class="form-control" name="death" placeholder="Death" value="<?php echo $row['death'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
	                                            <label>Comment</label>
	                                            <textarea class="form-control" name="comment" placeholder="Comment" ><?php echo $row['comment'];?></textarea>
	                                        </div>
										</div>
									</div>
									<?php } ?>
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
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#duty').serialize()  + "&id=" + id + '&ins=editStat',
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
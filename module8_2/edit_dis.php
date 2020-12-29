<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Dispensing Chart";
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
                                <h4 class="title">Edit Dipensing Chart</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											
											<?php
			                            $noarray = database::getInstance()->select_from_where('dispensing_chart','dispensing_chart_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
										$pharm = database::getInstance()->get_name_from_id('name','pharm_stock','id',$ow['pharm_stock_id']);	
			                            	?>
											
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
												 <select  name="pharm" class="form-control">
													<option value="<?php echo $ow['pharm_stock_id'];?>"><?php echo $pharm;?></option>
													<?php 
														$notray = database::getInstance()->select_from_wherenot_ord('pharm_stock','id',$ow['pharm_stock_id'],'id','DESC');
														foreach($notray as $uow):
													?>
                                            
														<option value="<?php echo $uow['id'];?>"><?php echo $uow['name'];?></option>
													<?php endforeach; ?>
													</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Dosage</label>
	                                                <input type="text" class="form-control" name="dosage" placeholder="Dosage" value="<?php echo $ow['dosage'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Method Of Administration</label>
	                                                <input type="text" class="form-control" name="meth" placeholder="Method Of Administration" value="<?php echo $ow['meth_administration'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Remark</label>
	                                                <textarea class="form-control" name="remark" placeholder="Remark" ><?php echo $ow['remark'];?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Chart</button>
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
				data: a('#appt').serialize() +  '&val=' + val + '&ins=editDis',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


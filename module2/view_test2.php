<?php 
	ob_start();
	session_start();
	$pageTitle = "View Lab Test";
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
	$value = $_GET['id'];
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
				 <?php
                      $noarray = database::getInstance()->select_all_test($value);
                       foreach($noarray as $opow){
						$contt = Database::getInstance()->select_all_test3($opow['lab_test_type_id'],$opow['link_ref']);
							
				?>
				
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo $opow['lab_test_type'];?></h4>
								
                            </div>
							
							<div class="box-content padded" style="padding:20px;">
							
							<form action="insert_result?id=<?php echo $value;?>">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tests</label>
													 
														<select class="form-control" name="test" required="required">
															<option>Pick A Test</option>
															<?php 
															 foreach($contt as $ow){
															 ?>
																<option value="<?php echo $ow['lab_test_id'];?>"><?php echo $ow['lab_test'];?></option>
															<?php } ?>
														</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
								<?php }?>	
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Template Name</label>
													 
														<select class="form-control" name="template" required="required">
															<option>Pick A Template</option>
															<?php 
																$notarray = database::getInstance()->select('lab_temp_name');
																foreach($notarray as $ow){												
															 ?>
																<option value="<?php echo $ow['id'];?>"><?php echo $ow['name'];?></option>
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
	                                                <input class="form-control" name="id" type="hidden" value="<?php echo $value;?>" />
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Insert Result</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
				
							
                         </div>
						 
						  
                       </div>
                    </div>
                
				</div>



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
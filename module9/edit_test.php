<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Doctor's Schedule";
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

	$value= $_GET['edit'];
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
                                <h4 class="title">Edit Test</h4>
                            </div>

                            <div class="content">
                                <form id="edit_sche">
                                	<?php
			                            $noarray = database::getInstance()->select_from_where('lab_test','lab_test_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            		$type = database::getInstance()->get_name_from_id('lab_test_type','lab_test_type','lab_test_type_id',$ow['lab_test_type_id']);
			                            	?>
									
									
										<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Test Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Test Name" value="<?php echo $ow['lab_test'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Fee</label>
	                                                <input type="number" class="form-control" name="fee" placeholder="Fee" value="<?php echo $ow['fee'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Test Type</label>
	                                                <select class="form-control" id="type" name="type">
														<option value="<?php echo $ow['lab_test_type_id'];?>"><?php echo $type;?></option>
														<?php 
														$contt = Database::getInstance()->select_from_wherenot_ord('lab_test_type', 'lab_test_type_id',$ow['lab_test_type_id'], 'lab_test_type_id','DESC');
														foreach($contt as $row){
														?>
														<option value="<?php echo $row['lab_test_type_id']?>"><?php echo $row['lab_test_type']?></option>
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
	                                                <label>Normal Value</label>
	                                                <input type="text" class="form-control" name="nvalue" placeholder="Normal Value" value="<?php echo $ow['normal_value'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Normal Range</label>
	                                                <input type="text" class="form-control" name="nrange" placeholder="Normal Range" value="<?php echo $ow['normal_range'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Reference Range</label>
	                                                <input type="text" class="form-control" name="rrange" placeholder="Reference Range" value="<?php echo $ow['reference_range'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>


								<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Lab Test</button>
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
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&ins=editTest",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


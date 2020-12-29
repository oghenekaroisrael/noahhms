<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Scan";
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
                                <h4 class="title">Edit Scan</h4>
                            </div>

                            <div class="content">
                                <form id="edit_sche">
                                	<?php
			                            $noarray = database::getInstance()->select_from_where('scan','id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            		$type = database::getInstance()->get_name_from_id('category','scan_types','scan_cat_id',$ow['category']);
			                            	?>
									
									
										<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Scan Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Scan Name" value="<?php echo $ow['name'];?>">
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
	                                                <label>Scan Type</label>
	                                                <select class="form-control" id="type" name="type">
	                                                	<?php 
														$contt = Database::getInstance()->select_from_where('scan_types', 'scan_cat_id',$ow['category']);
														foreach($contt as $row){
														?>
														<option value="<?php echo $row['scan_cat_id'];?>"><?php echo $row['category'];?></option>
													<?php } ?>
														<?php 
														$contt = Database::getInstance()->select_from_wherenot_ord('scan_types', 'scan_cat_id',$ow['category'], 'scan_cat_id','DESC');
														foreach($contt as $row){
														?>
														<option value="<?php echo $row['scan_cat_id']?>"><?php echo $row['category']?></option>
														<?php } ?>
														
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

								<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Scan</button>
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
				data: s('form').serialize() + "&val=" + id + "&ins=editScan",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


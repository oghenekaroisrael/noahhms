<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit HMO Lab Test";
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
	$tid = $_GET['id'];
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
                                	$names = database::getInstance()->get_name_from_id('name','tariffs','id',$_GET['id']); 
                                	$new_name = str_replace(" ", "_", $names);
									$new_name = strtolower($new_name);
			                            $noarray = database::getInstance()->select_from_where('lab_test','lab_test_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {	
											$fee = $ow[$new_name];
			                            	?>
									
									
										<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Test Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Test Name" value="<?php echo $ow['lab_test'];?>" disabled>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Fee</label>
	                                                <input type="number" class="form-control" name="fee" placeholder="Fee" value="<?php echo $fee;?>">
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
				data: s('form').serialize() + "&val=" + id + "&tname="+ `<?php echo $new_name; ?>` + "&ins=editTest2",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


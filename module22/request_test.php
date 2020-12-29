<?php 
	ob_start();
	session_start();
	$pageTitle = "Upload Files";
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
                                <h4 class="title">Test List</h4>
                            </div>

                            <div class="content">
                                <form id="form">
									
									<div class="form-group">
									<label for="name" class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
									<?php  
									$noarray = database::getInstance()->select_from_ord1('lab_test_type','lab_test_type','ASC');
									foreach($noarray as $opow){
										?>
										
									<h2 style="font-size:16px;font-weight: bold;text-align: center;padding-bottom: 20px;"><?php echo $opow['lab_test_type']?></h2>
									<div class="row">
									<?php 
										$not = database::getInstance()->select_test_to($opow['lab_test_type_id']);
										foreach($not as $row){
								  ?>
								 
								 
								<span class="pal" style="padding-bottom: 10px;">
									 <input name="test[<?php echo $row['lab_test_id'] ;?>]" type="checkbox" class=""> <?php echo $row['lab_test'] ;?>
								</span>
								
								
									<?php } ?>
									</div>
									
									<?php } ?>
							
						
							</div>		
								</div>

								<div class="col-sm-12">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Send Request</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
								</div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				<div id="hideMsgd" class="alert alert-success" style="display:none ">Successfully sent</div>

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
			var doc = "<?php echo $_GET['id'];?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&doc=" + doc + "&ins=newTestRequestFront",
				url: "../func/verify.php",
				success: function(res) {
					if(res == "Done"){
						document.getElementById("load").style.display = "none";
						document.getElementById("hideMsgd").style.display = "block";
					}else{
						document.getElementById("load").style.display = "none";
						s("#get_result").html(res).fadeIn("slow");
					}
					
				}
			});
		})			
	})			
</script>


<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Bed";
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
                                <h4 class="title">Edit Bed</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											
											<?php
			                            $noarray = database::getInstance()->select_from_where('bed','bed_id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
			                            	?>
											
								
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Bed</label>
	                                                <input type="number" class="form-control" name="bed" placeholder="Bed" value="<?php echo $ow['bed'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Bed</button>
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
				data: a('#appt').serialize() +  '&val=' + val + '&ins=editBed',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


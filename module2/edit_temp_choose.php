<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Test Result Template";
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
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           

                            <div class="content">
                                <form id="editTem">
									<?php
										$noarray = database::getInstance()->select_from_where('lab_temps','id',$value);
										while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
										$t_id = $ow['id'];
										$temp_name = $ow['temp_name'];
										$temp_name = str_replace('_', ' ', $temp_name);
										$temp_name = ucwords($temp_name);
									?>
									<div class="header">
                                <h4 class="title">Edit <?php echo $temp_name; ?></h4>
                            </div>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><?php echo $temp_name;?></label>
	                                                <input type="text" class="form-control" name="name" value="<?php echo $temp_name;?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<button type="submit" class="btn btn-info btn-fill pull-right">Edit</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
								</form>	
								<?php } ?>
                        
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

<script type="text/javascript">
	var a=jQuery .noConflict();			
	a(function () {
		a('#editTem').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var val = "<?php echo $value; ?>";
			a.ajax({
				type: "POST",
				data: a('#editTem').serialize() + "&val=" + val + '&ins=editTempy',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>
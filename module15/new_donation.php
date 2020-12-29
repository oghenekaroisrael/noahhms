<?php 
	ob_start();
	session_start();
	$pageTitle = "New Donation";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		$id = $_GET['id'];
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
                                <h4 class="title">New Donation</h4>
                            </div>
                            <div class="content">
                                <form id="schedule">

                                	<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Type</label>
	                                                <select class="form-control" name="type">
	                                                		<option disabled>Select Type</option>
	                                               	<?php 
														$contt = Database::getInstance()->select_from_ord1('samples', 'id','ASC');
														foreach($contt as $ow){
														?>
														<option value="<?php echo $ow['id']?>"><?php echo $ow['sample']?></option>
														<?php } ?>
	                                                </select>
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Pint(s)</label>
	                                                <input type="number" class="form-control" name="pint">
	                                            </div>
	                                        </div>
										</div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Donation</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>
                 <a class="btn btn-info" href="donations.php?id=<?php echo $id; ?>">Donation History</a>
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
		a('#schedule').on('submit', function (e) {
			var id = "<?php echo $id;?>";
			var doc = "<?php echo $user_id;?>"
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#schedule').serialize() + '&ins=newDonation' + '&val=' + id + '&doc=' + doc,
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>


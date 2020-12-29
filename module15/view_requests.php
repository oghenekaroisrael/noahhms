<?php 
	ob_start();
	session_start();
	$pageTitle = "Antenatal Case Note";
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
<style type="text/css">
	.row{
		margin-bottom: 15px;
	}
</style>
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
                                <h4 class="title">View Request</h4>
                            </div>

                            <div class="content">
								 <?php
                            $noarray = database::getInstance()->select_from_where('blood_requests','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-3">
			                                        <label>Patient Name:</label>
			                                        <p><?php echo $ow['patient_name']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>Admission Number:</label>
			                                        <p><?php echo $ow['patient_adm_no']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>Address:</label>
			                                        <p><?php echo $ow['patient_address']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>Address:</label>
			                                        <p><?php echo $ow['patient_phone']; ?></p>
			                                </div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Sample type</label>
	                                                <p><?php echo database::getInstance()->get_name_from_id('sample',"samples",'id',$ow['sample_type']);?></p>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Urgency</label>
	                                                <p><?php echo $ow['urgency'];?></p>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Volume</label>
	                                                <p><?php echo $ow['volume'];?></p>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									</div>

									<?php } ?>
                        
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

		a('#change_ante').on('submit', function (e) {
			var ID = "<?php echo $_GET['id']; ?>";
			var staff = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAntenatal_N&edit='+ ID + '&staff='+staff,
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
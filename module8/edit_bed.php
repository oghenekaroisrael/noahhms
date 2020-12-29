<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Bed";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		$value = $_GET['edit'];
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
                                <h4 class="title">Update Bed</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
									<?php
			                            $noarray = database::getInstance()->select_from_where('beds','id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            	$type = database::getInstance()->get_name_from_id('name','bed_types','id',$ow['bed_type']);
			                            	?>		
                                	<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Bed Type</label>
	                                                <select class="form-control" name="type">
	                                                	<option selected="selected" value="<?php echo $ow['bed_type']; ?>"><?php echo $type; ?></option>
	                                                	option>
														<?php 
														$notarray = database::getInstance()->select_from_ord1('bed_types','id','DESC');
														foreach($notarray as $row):?>
                                            
														<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
														<?php endforeach; ?>
	                                                </select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Bed</label>
	                                                <input type="text" class="form-control" name="bed" placeholder="Bed" value="<?php echo $ow['bed']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Charge (Per Day)</label>
	                                                <input type="number" class="form-control" name="charge" placeholder="Charge"  value="<?php echo $ow['charge']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Description</label>
	                                                <textarea class="form-control" name="description"><?php echo $ow['description']; ?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<?php }?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
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
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&ins=editBed&val=<?php echo $value; ?>',
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


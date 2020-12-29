<?php 
	ob_start();
	session_start();
	$pageTitle = "Change Capitation Status";
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
                                <h4 class="title">Change Capitation Status</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('capitations','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            	$bk = $ow['hmo_id'];
                            	?>
							
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Amount</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Amount" value="<?php echo $ow['amount'];?>" disabled>
	                                            </div>
	                                        </div>
	                                        <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>No Of Enrollees</label>
	                                                <input type="number" class="form-control" name="staff" placeholder="Enrollees" value="<?php echo $ow['enrollees'];?>">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-12">
	                                            <div class="form-group">
	                                                <select name="status" class="form-control">
	                                                	<?php 
	                                                		$stat = database::getInstance()->get_name_from_id('status','capitations','id',$value);
	                                                		if ($stat == 0) {
	                                                			$status = "Inactive";
	                                                		}else{
	                                                			$status = "Active";
	                                                		}
	                                                	?>
	                                                	<option selected="selected"><?php echo $status; ?></option>
	                                                	<option value="1">Activate</option>
	                                                	<option value="0">Deactivate</option>
	                                                </select>
	                                            </div>
	                                        </div>
										</div>
									</div>

							<?php } ?>
                                	<a class="btn btn-info pull-left" href="capitations.php?id=<?php echo $bk; ?>">Go Back</a>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Change Status</button>
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
<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&ins=changeCstatus",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


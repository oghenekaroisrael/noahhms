<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Blood Group";
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
                                <h4 class="title">Edit Blood Group</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('blood_groups','blood_group_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
								
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Group</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Blood Group" value="<?php echo $ow['blood_group'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Blood Group</button>
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
				data: s('form').serialize() + "&val=" + id + "&ins=editBloodGroup",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


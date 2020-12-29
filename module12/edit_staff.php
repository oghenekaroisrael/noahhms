<?php 
	ob_start();
	session_start();
	$pageTitle = "Lab Results";
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
	$value= $_GET['id'];
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
                                <h4 class="title">Edit Staff</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('staff','user_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
								$role_id = $ow['role_id'];
								?>
								
                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $ow['first_name'];?>" >
                                            </div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $ow['last_name'];?>">
											</div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="<?php echo $ow['username'];?>" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Role</label>
                                                <select class="form-control" id="role" name="role">
													<?php
														$userDetails = Database::getInstance()->select_from_where('user_roles', 'id', $role_id);
														foreach($userDetails as $w):
															$idd = $w['id'];
															$named = $w['name'];
														endforeach;															
													?>
													<option value="<?php echo $idd;?>"><?php echo $named;?></option>
													<?php
														$userDetails = Database::getInstance()->select('user_roles');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
									</div> 
								
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Staff Details</button>
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
			var val = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + val + "&ins=editStaff",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


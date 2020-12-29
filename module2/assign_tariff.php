<?php 
	ob_start();
	session_start();
	$pageTitle = "Assign Tariff";
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
                                <h4 class="title">Assign A Tariff</h4>
                            </div>
                            <div class="content">
                                <form id="ediSt">
								 <?php
								 $names = database::getInstance()->select_from_where('patients','id',$value);
								 foreach ($names as $name) {
								 	$fullname = $name['title']." ".$name['surname']." ".$name['first_name']." ".$name['middle_name'];
								 }
                           ?>
                            	<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $fullname;?>"  disabled>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Tariff</label>
                                                <select class="form-control" name="tariff">
                                                	<?php
                                                	 $tar = database::getInstance()->select('tariffs');
                                                	 foreach ($tar as $tar_val) {
                                                	 	$tid = $tar_val['id'];
                                                	 	$tariff_name = $tar_val['name'];
                                                	 	?>
                                                	 	<option value="<?php echo $tid; ?>"><?php echo $tariff_name; ?></option>
                                                	 <?php	 } ?>
                                                </select>
                                            </div>
                                        </div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Assign Tariff</button>
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
		s('#ediSt').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('#ediSt').serialize() + "&id=" + id + "&ins=assignTariff",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


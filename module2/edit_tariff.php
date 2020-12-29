<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Tariff";
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
                                <h4 class="title">Edit Tariff</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('tariffs','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
								
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tariff Name</label>
	                                                <input type="text" class="form-control" name="name" placeholder="Tariff Name" value="<?php echo $ow['name'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Tariff Group</label>
                                                <select class="form-control" name="group">
                                                	<?php
                                                	 $tar2 = database::getInstance()->select_from_where('tgroup','id',$ow['tgroup']);
                                                	 
	                                                	 foreach ($tar2 as $t_val2) {
	                                                	 		if (count($t_val2) > 0) {
	                                                	 			$tid2 = $t_val2['id'];
	                                                	 			$t_name2 = $t_val2['name'];
	                                                	 ?>
	                                                	 			<option value="<?php echo $tid2; ?>"><?php echo $t_name2; ?></option>
	                                                	 <?php	
	                                                	 }else{
                                                	 	?>

																<option value="0" selected="selected"><?php echo count($tar2); ?>No Group</option>
                                                	 	<?php
                                                	 }  
	                                                		}
                                                	 ?>
                                                	
                                                	<?php
                                                	 $tar = database::getInstance()->select('tgroup');
                                                	 foreach ($tar as $t_val) {
                                                	 	$tid = $t_val['id'];
                                                	 	$t_name = $t_val['name'];
                                                	 	?>
                                                	 	<option value="<?php echo $tid; ?>"><?php echo $t_name; ?></option>
                                                	 <?php	 } ?>
                                                </select>
                                            </div>
                                        </div>

							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Tariff</button>
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
				data: s('form').serialize() + "&val=" + id + "&ins=editTariff",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>


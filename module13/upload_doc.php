<?php 
	ob_start();
	session_start();
	$pageTitle = "Upload Files";
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
	$pid =  $_GET['pid'];
	$link = $_GET['ref'];
?>

<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
       <div class="content">            
            <div class="container-fluid">
            	<div class="row">
            		<div class="col-lg-12">
            			<h3 class="title text-center"> REQUESTED XRAYs</h3>
            		</div>
            		<hr>
            	</div>

														<div id="get_resultd"></div>
            	<div class="row">            		
            		<div class="col-lg-12">
            			<?php 
								$dif = 0;
								$view_all = Database::getInstance()->select_view_xrays($link);
            			foreach ($view_all as $row):
						$labTn = Database::getInstance()->select_from_where2('xray','id', $row['name']); 
							foreach ($labTn as $rows):
							$counts = $row['id'];
            				?>
            				<div class="accordion">
            					<?php
            						 $con = mysqli_connect("localhost","root","","noahhms");
            						 $cont = $row['type'];
            						 	?>
            						 		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#con<?php echo $counts;?>" aria-expanded="false" aria-controls="con<?php echo $counts;?>" style="width: 100%;margin-bottom: 20px;">
                            			<?php echo $rows['name']; ?></button>
                            		<div class="collapse" id="con<?php echo $counts;?>">
	                            			<div class="card">
	                            				<div class="content">
	                            					<form id="resu<?php echo $dif++; ?>"  enctype="multipart/form-data">
															<div class="col-md-4">
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																		<label>Scanned Image</label>
																			<input type="file" name="scan" class="form-control-file">	
																			<input type="hidden" name="id" value="<?php echo $value; ?>">
																			<input type="hidden" name="pid" value="<?php echo $pid; ?>">
																			<input type="hidden" name="ref" value="<?php echo $link; ?>">
																			<input type="hidden" name="xray_id" value="<?php echo $counts; ?>">	
																			<input type="hidden" name="x_name" value="<?php echo $rows['name']; ?>">
																			<input type="hidden" name="category" value="<?php echo $row['type']; ?>">
																		</div>
																																			
																	</div>
																</div>
															</div>
															<div class="col-md-8">
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label>Comment</label>
																			<textarea rows="5" class="form-control" name="comment"></textarea>
																		</div>
																	</div>
																</div>
															</div>
														<div class="clearfix"></div>
					                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Result</button>
														<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
					                                    <div class="clearfix"></div>
					                                </form>
														<div class="clearTwenty"></div>
	                            				</div>
	                            			</div>
                            		</div>
            			</div>
            				<?php
            			endforeach;
            			endforeach;
            			?>
            			
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

 <div class="loader" id="load" style="display:none;">
</div>

<script type="text/javascript">
	
		 var a=jQuery .noConflict();
	 a(document).ready(function(){

        a('form').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "xrayFiles";
		var val = "<?php echo $user_id; ?>";
		var patient = "<?php echo $pid; ?>";
		 formData.append('ins',ins);
		 formData.append('val',val);
		 formData.append('patient',patient);
          a.ajax({
            type: 'post',
			data: formData,   
			cache: false,
			contentType: false,
			processData: false,
            url: '../func/verify.php',				
            success: function(data)
            {
				document.getElementById("load").style.display = "none";
				a("#get_resultd").html(data).fadeIn("slow");

            }
          });

        });

      });	
</script>


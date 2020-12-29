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
            			<h3 class="title text-center"> ADD THERAPY PLAN</h3>
            		</div>
            		<hr>
            	</div>
				<div id="get_resultd"></div>
            	<div class="row">            		
            		<div class="col-lg-12">
	                            			<div class="card">
	                            				<div class="content">
	                            					<form id="resu">
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label>Therapy Plan</label>
																			<textarea style="white-space: nowrap;" rows="5" class="form-control" name="comment"></textarea>
																		</div>
																	</div>
																</div>
														<div class="clearfix"></div>
					                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Plan</button>
														<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
					                                    <div class="clearfix"></div>
					                                </form>
														<div class="clearTwenty"></div>
	                            				</div>
	                            			</div>
            			
            		</div>
            	</div>
<button onclick="goBack()"  class="btn btn-info">Go Back</button>
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
		var ins = "therapyPlan_front";
		var val = "<?php echo $user_id; ?>";
		var patient = "<?php echo $pid; ?>";
		var app = "<?php echo $_GET['id']; ?>";
		var link_ref = "<?php $link; ?>";
		 formData.append('ins',ins);
		 formData.append('val',val);
		 formData.append('patient',patient);		 
		 formData.append('app',app);
		 formData.append('link_ref',link_ref);
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
<script>
function goBack() {
  window.history.back();
}
</script>

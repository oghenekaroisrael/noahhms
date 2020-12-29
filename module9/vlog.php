<?php 
	ob_start();
	session_start();
	$pageTitle = "Visitor's Note";
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
	$visit = $_GET['id'];
?>

<div class="wrapper" id="homesc">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
<div id="get_result"></div>
        <div class="content">
            <div class="container-fluid">
				<div class="row">
					 <div class="col-md-12">
					 	<div class="card">
					 		<div class="header">
					 			<h4 class="title"> <b>Visitor's Log</b></h4>
					 		</div>
					 		<div class="content">
					 			<form id="vlog">
					 				<?php
										$noarray = database::getInstance()->select_from_where('visitors_log','id',$visit);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
					 				<div class="col-md-4">
	                                    <div class="form-group">
			                                <label>Visitor's Name</label>
			                                <p><?php echo $row['name']; ?></p>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
	                                    <div class="form-group">
			                                <label>Visitor's Tel</label>
			                                <p><?php echo $row['tel']; ?></p>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
	                                    <div class="form-group">
			                                <label>Visitor's Sex</label>
			                                <p><?php echo $row['sex']; ?></p>
			                            </div>
			                        </div>
			                        <div class="col-md-4">
	                                    <div class="form-group">
			                                <label>Visitor's Address</label>
			                                <p><?php echo $row['address']; ?></p>
			                            </div>
			                        </div>
			                        <div class="col-md-8">
	                                    <div class="form-group">
			                                <label>Reason For Visit</label>
			                                <p><?php echo $row['reason']; ?></p>
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Response To Visit</label>
			                               <textarea class="form-control" name="reason"></textarea>
			                            </div>
			                        </div>
			                    <?php } ?>
			                        <button type="submit" class="btn btn-info btn-fill pull-right">Send</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div> 
					 			</form>
					 		</div>
					 	</div>
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


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var a=jQuery .noConflict();
	 a(document).ready(function(){

        a('#vlog').on('submit', function (e) {
        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "updateVLog";		
		var val = "<?php echo $visit; ?>";
		var user = "<?php echo $user_id; ?>";
		 formData.append('ins',ins);		 
		 formData.append('val',val);		 
		 formData.append('user',user);
          a.ajax({
            type: 'post',
			data: formData,  
			cache: false,
			contentType: false,
			processData: false,
            url: '../func/edit.php',						
            success: function(data)
            {
				document.getElementById("load").style.display = "none";
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });
      });
    </script>

<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Visitor's Log";
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
	$db = mysqli_connect("localhost","root","","noahhms");
	$value = $_GET['edit'];
	if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
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
                                <h4 class="title">Update Visitor's Log</h4>
                            </div>
                            	<?php 
                            	$data = database::getInstance()->select_from_where("visitors_log","id",$value); 
                            	foreach ($data as $row) {
                            	?>
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
		var s_id; //to make it accessible
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				s_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});


		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&s_id=' + s_id + '&ins=editLog&user=<?php echo $user_id; ?>&edit=<?php echo $value; ?>',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					if (res == "Done") {
						 console.log(res);
							window.location = "Visitor";
					}else{
						a("#get_result").html(res).fadeIn("slow");
					}
				}
			});
        });
    })
});
</script>


<?php 
	ob_start();
	session_start();
	$pageTitle = "Request Xray";
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
                                <h4 class="title">Xray List</h4>
                            </div>

                            <div class="content">
                                <form id="form">
									
									<div class="form-group">
									<label for="name" class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
									<?php  
									$noarray = database::getInstance()->select_from_ord1('xray_types','category','ASC');
									foreach($noarray as $opow){
										?>
										
									<h2 style="font-size:16px;font-weight: bold;text-align: center;padding-bottom: 20px;"><?php echo $opow['category']?></h2>
									<div class="row">
									<?php 
										$not = database::getInstance()->select_xray_to($opow['xray_cat_id']);
										foreach($not as $row){
								  ?>
								 
								 
								<span class="pal" style="padding-bottom: 10px;">
									 <input name="xray[<?php echo $row['id'] ;?>]" type="checkbox" class="chkbox"> <?php echo $row['name'] ;?>
								</span>
								
								
									<?php } ?>
									</div>
									
									<?php } ?>
							
						
							</div>		
								</div>

								<div class="col-sm-12">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Send Request</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
								</div>
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
	
		var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			var doc = "<?php echo $user_id; ?>";
			var pat = "<?php echo $_GET['pid']; ?>"
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&doc=" + doc + "&ins=newXrayRequest_progress&pat=" + pat,
				url: "../func/verify.php",
				success: function(res) {
					if(res == "Done"){
						window.location = "progress?id="+pat+"&pid2="+id+"&ipid="+<?php echo $_GET['ipid']; ?>;
					}else{
						document.getElementById("load").style.display = "none";
						s("#get_result").html(res).fadeIn("slow");
					}
					
				}
			});
		})			
	})
		
	$(document).ready(function(){
		$('.chkbox').click(function(){
			var text = "";
			$('.chkbox:checked').each(function(){
				text += $(this).val()+ ",";
			});
			text = text.substring(0,text.length-1);
			$('#checked_values').val(text);
			var count = $("input[type='checkbox']:checked").length;
			$('#count').val($("input[type='checkbox']:checked").length);
		});
	});			
</script>


<?php 
	ob_start();
	session_start();
	$pageTitle = "New Doctor's Schedule";
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
	$temp = $_GET['template'];
	$test = $_GET['test'];
	$id = $_GET['id'];
	$p_id = Database::getInstance()->get_name_from_id('patient_appointment_id','patient_test','patient_test_id', $id);
	$labTn = Database::getInstance()->get_name_from_id('lab_test','lab_test','lab_test_id', $test);
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
                                <h4 class="title">Insert test Result for <b><?php echo $labTn; ?></b></h4>
                            </div>

                            <div class="content">
                                <form id="resu">
									
									<div id="get_result"></div>
									<div class="clearfix"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Result</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
								<div class="clearTwenty"></div>
								<div id="get_resultd"></div>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<button class="btn btn-info btn-fill" onclick="history.go(-1);">Back </button>

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

			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#schedule').serialize() + '&ins=getFields' + '&temp=<?php echo $temp; ?>',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
      
    });
</script>

<script type="text/javascript">
	//Lets ajaxify this part on submit
	var j=jQuery .noConflict();
	j(function () {
		j('#resu').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var test = '<?php echo $test;?>';
			var id = '<?php echo $id;?>';
			var p_id = '<?php echo $p_id;?>';
			var temp = '<?php echo $temp;?>';
			j.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: j('#resu').serialize() + "&temp="+ temp + "&p_id="+ p_id + "&test="+ test + "&id="+ id + '&ins=insertRes',
				success: function(data){
					document.getElementById("load").style.display = "none";
					if(data === "Done"){
						j('#get_resultd').html(data);
					} else {
						j("#get_resultd").html(data).fadeIn("slow");
					} 
					console.log(data);
				}
			});
		});
	});
</script>



<?php 
	ob_start();
	session_start();
	$pageTitle = "Generate Statement";
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
	if (!isset($_POST['generate'])) {
		unset($_POST);
	}else{
		$date = $_POST['date'];
		$report = $_POST['report'];
	}
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Generate Statement Of Financial Position</h2>
                                <h5 style="color: red;">NOTE: Select For A Month Or A Year (Not More)</h5>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                	<div class="row">
                                        <div class="col-md-2"></div>
                                		<div class="col-md-8">                                			
                                        <form method="POST" action="statementf.php">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">From (Date)</label>
                                                    <input class="form-control" name="date_from" type="date" required id="example-date-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 ">                                              
                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">To (Date)</label>
                                                    <input class="form-control" name="date_to" type="date" required id="example-date-input">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="generate" value="GENERATE REPORT" class="btn btn-info" style="width: 100%;">
                                        </form>
                                		</div>
                                        <div class="col-md-2"></div>
                                	</div>

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
	var s=jQuery .noConflict();
	
    </script>

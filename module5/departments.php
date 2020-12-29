<?php 
	ob_start();
	session_start();
	$pageTitle = "Departmental Reports";
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
                                <h2>Generate And Print Transactions Report </h2>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                	<div class="row">
                                		<div class="col-md-2"></div>
                                		<div class="col-md-8">
                                			
                                        <form method="POST" action="gen2.php">
                                        	<div class="form-group">
                                            <label class="col-form-label">Select Report Type</label>
                                            <select class="form-control" required="required" name="report">
                                                <option value="minimal">Minimal Report</option>
                                                <option value="semi">Semi Report</option>
                                                <option value="full">Full Report</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Select Department</label>
                                            <select class="form-control" required="required" name="dept">
                                                <option value="all">All Departments</option>
                                                <option value="3">Pharmacy</option>
                                                <option value="2">Laboratory</option>
                                                <option value="8">Consultations</option>
                                                <option value="9">In-patients</option>
                                                <option value="5">Front Desk (Cards)</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Select Payment Type</label>
                                            <select class="form-control" required="required" name="type">
                                            	<option value="all">All Payments</option>
                                            	<option value="0">Pending Payment</option>
                                                <option value="1">Full Payment</option>
                                                <option value="2">Part Payment</option>
                                                <option value="3">Company Bill</option>
                                                <option value="4">Deffered Payment</option>
                                                <option value="5">Waved Payment</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">From (Date)</label>
                                            <input class="form-control" name="date_from" type="date" required id="example-date-input">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">To (Date)</label>
                                            <input class="form-control" name="date_to" type="date" required id="example-date-input">
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

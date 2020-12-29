<?php 
	ob_start();
	session_start();
	$pageTitle = "Company Bills";
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
	$sql = mysqli_query($db, "SELECT * FROM companies");
	$sql2 = mysqli_query($db, "SELECT SUM(amount) FROM company_bill");
	$count_all = mysqli_num_rows($sql);
	while ($amount_al = mysqli_fetch_assoc($sql2)) {
		$amount_all += $amount_al['SUM(amount)'];
	}
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
					 			<h4 class="title">New Company</h4>
					 		</div>
					 		<div class="content">
					 			<form id="company">
					 				<div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Name</label>
			                                <input type="text" class="form-control" name="name" placeholder="Company Name">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Address</label>
			                                <input type="text" class="form-control" name="address" placeholder="Company Address">
			                            </div>
			                        </div> 
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Phone Numbers</label>
			                                <input type="text" class="form-control" name="phone" placeholder="Company Phone Numbers (NOTE: Seperate Multiple With ',') ">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Email Address</label>
			                                <input type="email" class="form-control" name="email" placeholder="Company Email Address">
			                            </div>
			                        </div>  			                         
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Branch Number</label>
			                                <input type="text" class="form-control" name="branch" placeholder="Company Branch Number">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Number Of Staffs</label>
			                                <input type="text" class="form-control" name="staff_no" placeholder="Company Number Of Staff">
			                            </div>
			                        </div>
			                        <button type="submit" class="btn btn-info btn-fill pull-right">Add Company</button>
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

        a('#company').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "newCompany";
		 formData.append('ins',ins);
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
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });
      });
    </script>

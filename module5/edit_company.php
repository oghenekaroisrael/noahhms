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
	$comp_id = $_GET['id'];
	$db = mysqli_connect("localhost","root","","noahhms");
	$sql = mysqli_query($db, "SELECT * FROM companies WHERE id = ".$comp_id."");
	$get_result = mysqli_fetch_assoc($sql);
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
					 			<h4 class="title">Update Company Data For <?php echo ucwords($get_result['company_name']); ?>	</h4>
					 		</div>
					 		<div class="content">
					 			<form id="company">
					 				<div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Name</label>
			                                <input type="text" class="form-control" name="name" placeholder="Company Name" value="<?php echo $get_result['company_name']; ?>">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Address</label>
			                                <input type="text" class="form-control" name="address" placeholder="Company Address" value="<?php echo $get_result['company_addr']; ?>">
			                            </div>
			                        </div> 
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Phone Numbers</label>
			                                <input type="text" class="form-control" name="phone" placeholder="Company Phone Numbers (NOTE: Seperate Multiple With ',') " value="<?php echo $get_result['company_pn']; ?>">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Email Address</label>
			                                <input type="email" class="form-control" name="email" placeholder="Company Email Address" value="<?php echo $get_result['email']; ?>">
			                            </div>
			                        </div>  			                         
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Branch Number</label>
			                                <input type="text" class="form-control" name="branch" placeholder="Company Branch Number" value="<?php echo $get_result['branch']; ?>">
			                            </div>
			                        </div>
			                        <div class="col-md-12">
	                                    <div class="form-group">
			                                <label>Company Number Of Staffs</label>
			                                <input type="text" class="form-control" name="staff_no" placeholder="Company Number Of Staff" value="<?php echo $get_result['staff_no']; ?>">
			                            </div>
			                        </div>
			                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Company Data</button>
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
		var ins = "editCompany";		
		var val = "<?php echo $comp_id; ?>";
		 formData.append('ins',ins);		 
		 formData.append('val',val);
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

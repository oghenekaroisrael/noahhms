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
                                <h4 class="title">Upload Extra files</h4>
                            </div>

                            <div class="content">
                                <form id="form">
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Name</label>
	                                                <input type="text" class="form-control" name="namea" placeholder="Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>File(Image,doc,PDF)</label>
	                                                <input type="file" class="form-control" name="file" placeholder="File" >
	                                            </div>
	                                        </div>
										</div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add File</button>
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
	 a(document).ready(function(){

        a('#form').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "extraFile";
		var val = "<?php echo $value; ?>";
		var patient = "<?php echo $_GET['pid']; ?>";
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
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });

      });
</script>


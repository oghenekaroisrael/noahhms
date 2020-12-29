<?php
	ob_start();
	session_start();
	$pageTitle = "Tariffs";
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
	$value= $_GET['id'];
	$t_name = database::getInstance()->get_name_from_id("name","tariffs","id",$value);
?>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
    	 <?php include 'inc/main_header.php';?>

		<div class="content">
            <div class="container-fluid">
			
			
                <div class="row">
					 <div class="col-md-12">
                            <center>
                            	<h3 class="title" style="font-family: raleway;font-weight: normal;">HMO Tariff Name: <?php echo $t_name; ?></h3>
                            </center>
                            <div class="content table-responsive table-full-width">
                                <div class="row">
                                			<div class="col-lg-4">
                                				<div class="card jumbotron" id="tariff-cont">
                                					<center>
                                					<div class="title">
                                						<h3 class="h3" id="tariff-header">NHIS Capitation Fee</h3>
                                					</div>
		                                		<a class="btn btn-info btn-full" href="capitations.php?id=<?php echo $_GET['id']; ?>" target="_blank">View / Update Price</a>
                                				</center>
                                				</div>
		                                	</div>

                                			<div class="col-lg-4">
                                				<div class="card jumbotron" id="tariff-cont">
                                					<center>
                                					<div class="title">
                                						<h3 class="h3" id="tariff-header">Lab Tests</h3>
                                					</div>
		                                		<a class="btn btn-info btn-full" href="test.php?id=<?php echo $_GET['id']; ?>" target="_blank">View / Update Pricing</a>
                                				</center>
                                				</div>
		                                	</div>

		                                	<div class="col-lg-4">
                                				<div class="card jumbotron" id="tariff-cont">
                                					<center>
                                					<div class="title">
                                						<h3 class="h3" id="tariff-header">Pharmacy</h3>
                                					</div>
		                                		<a class="btn btn-info btn-full" href="stock.php?id=<?php echo $_GET['id']; ?>" target="_blank">View / Update Pricing</a>
                                				</center>
                                				</div>
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
<?php include 'notify.php'; ?>
	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From bank list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>
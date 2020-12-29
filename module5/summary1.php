<?php 
	ob_start();
	session_start();
	$pageTitle = "Financial Summary";
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
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
					 <div class="col-lg-6">
                        <div class="card" onclick="window.location='summary.php';" style="padding: 80px 0;background: #031751;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                           	Generate Financial Report
                           </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card"  onclick="window.location='monthly.php';" style="padding: 80px 0;background: #203A2C;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                           	This Month's Financial Summary
                           </div>
                        </div>
                    </div>
                 </div>

                 <div class="row">                  
                    <div class="col-lg-6">
                        <div class="card"  onclick="window.location='departments.php';" style="padding: 80px 0;background: #0e461e;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                            Departmental Report
                           </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card"  onclick="window.location='company.php';" style="padding: 80px 0;background: #094475;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                           Waved / Deffered / Company Billings
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
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delCost',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'material';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

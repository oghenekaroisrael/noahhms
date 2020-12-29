<?php 
	ob_start();
	session_start();
	$pageTitle = "View Lab Test";
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

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
				 <?php
                      $noarray = database::getInstance()->select_all_test($value);
                       while ($opow = $noarray->fetch(PDO::FETCH_ASSOC)) {
						$contt = Database::getInstance()->select_all_test2($opow['lab_test_type_id'],$opow['link_ref']);
							
				?>
				
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo $opow['lab_test_type'];?></h4>
								
                            </div>
							
							<div class="box-content padded" style="padding:20px;">
				
							 <table class="table table-bordered">
							  <thead>
									<th>Test</th>
									<th>Normal Range</th>
									<th>Normal Value</th>
									<th>Reference Range</th>
				                    <th>Result</th>
				                    <th>O</th>
				                    <th>H</th>
				                    <th>Remarks</th>      	
				              </thead>
							 <tr>
							 <?php 
							 foreach($contt as $ow){
							 ?>
								<td><b><?php echo $opow['lab_test'];?></b></td>
								<td><?php echo $ow['normal_range'];?></td>
								<td><?php echo $ow['normal_value'];?></td>
								<td><?php echo $ow['reference_range'];?></td>
								<td><?php echo $opow['lab_result'];?></td>
								<td><?php echo $opow['O'];?></td>
								<td><?php echo $opow['H'];?></td>
								<td>
								<?php if($opow['tested'] == 0){?>
								<a href = "insert_result?id=<?php echo $opow['patient_test_id'];?>"class="btn pull-left btn-flat waiSuc" style="font-size: 12px;">
												Insert Result
									</a>
								<?php }else{?>
									<?php echo $opow['remarks'];?>
								<?php }?>
								</td>
							 <?php }?>
							</tr>
							 </table>
                         </div>
						 
						  
                       </div>
                    </div>
                
				<?php } ?>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> Vitals ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delPatientVital',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'vitals';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

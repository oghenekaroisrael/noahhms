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
	Database::getInstance()->seen_result($value);
?>

<style>
			@media print {
    .no-print{display: none;}
	 @page {
           margin-top: 0;
           margin-bottom: 0;
           margin-left: 10px;
           margin-right: 10px;
         }
         body  {
           padding-top: 30px;
           padding-bottom: 30px ;
         }
}
			</style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
				 <?php
                      $noarray = database::getInstance()->select_all_test($value);
                       foreach($noarray as $opow){
						$contt = Database::getInstance()->select_all_test3($opow['lab_test_type_id'],$opow['link_ref']);
							 
				?>
					 <div class="col-md-12">
                      
                      
						<div class="clearTwenty"></div>	
                
				<?php } ?>
				
				  <div class="card">
				<table class="table table-bordered">
					<tr>
						<td colspan="4">
							<center>
								<?php
								$db =  mysqli_connect("localhost","root","","noahhms");
								$info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
								$get_hospital_info = mysqli_fetch_assoc($info);
								$name = $get_hospital_info['name'];
								$address = $get_hospital_info['address'];
								$phone = $get_hospital_info['phone'];
								$email =  $get_hospital_info['email'];
								?>
								<h2><b><?php echo $name; ?></b></h2>
							<?php echo $address; ?><br>
							<?php echo $phone; ?> <?php echo $email; ?>
							<br>
							<div class="head-cont">
								LABORATORY RESULT
							</div>
							</center>
						</td>
					</tr>
                                <?php
		                            $no = database::getInstance()->select_from_where2_some_val($value);
			                        foreach($no as $row):
			                            $t_name = $row['test_name'];
			                            $value = $row['value'];
			                            $lab_temp_id = $row['lab_temp_id'];
			                            $dt = $row['date_added'];
									$no = database::getInstance()->select_from_where2('lab_temp_name','id',$t_name);
			                        foreach($no as $row):
										$la_name = $row['name'];
									endforeach;
									
									 ?>
	                            	<tr>
										<td><p><strong><?php echo ucfirst($la_name);?></strong></p></td>
										<td><p><?php 
										$no = database::getInstance()->select_from_where2('lab_temps','id',$lab_temp_id);
											foreach($no as $row):
												$temp_name = $row['temp_name'];
												$temp_name = str_replace('_', ' ', $temp_name);
												echo ucwords($temp_name);
											endforeach;
										?></p></td>
                            			<td><p><?php echo ucfirst($value);?></p></td>
                            			<td><p><?php echo $dt; ?></p></td>
                            		</tr>	
                            	
                            	<?php endforeach; ?>
			                    </table>
								
								<div class="clearTwenty"></div>	

							<button  type="button" id="submitEP" class="btn btn-success no-print" onclick="myFunction()"> Print</button>
							
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

 function myFunction() {
    window.print();
}

    </script>

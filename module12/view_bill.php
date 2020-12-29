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
	$pid = $_GET['pid'];
	$p_name = $_GET['n'];
	$p_sex = $_GET['s'];
	$p_age = $_GET['a'];
	$doc_id = $_GET['did'];	
	$db =  mysqli_connect("localhost","root","","noahhms");
	$pat = mysqli_query($db, "SELECT patient_id FROM accounts WHERE order_id = '".$value."'");
	$pa = mysqli_fetch_assoc($pat);
	$sql_pt = mysqli_query($db, "SELECT address,dob FROM patients WHERE id = ".$pa['patient_id']."");
	$get_pt = mysqli_fetch_assoc($sql_pt);
	$p_addr = $get_pt['address'];
	$p_dob = $get_pt['dob'];
?>

<style>
			@media print {
    .no-print{display: none;}
    .content{height:inherit;}
	 @page {
           margin:0;
           width: 100%;
           margin-left: -130px;
         }
         body  {
           padding:0;
           position: absolute;
         }
    }	
			</style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content print">
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
								$p_id = database::getInstance()->get_name_from_id('patient_id','patient_appointment','id',$_GET['id']);
								$p_name = database::getInstance()->select_from_where2('patients','id',$p_id);
								foreach ($p_name as $p_name2) {
									$names = $p_name2['title']. " " .$p_name2['surname']. " " .$p_name2['middle_name']. " ".$p_name2['first_name'];
								}
								$db =  mysqli_connect("localhost","root","","noahhms");
								$info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
								$get_hospital_info = mysqli_fetch_assoc($info);
								$name = $get_hospital_info['name'];
								$address = $get_hospital_info['address'];
								$phone = $get_hospital_info['phone'];
								$email =  $get_hospital_info['email'];
								$total = 0;
								?>
								<h2><b><?php echo $name; ?></b></h2>
							<?php echo $address; ?><br>
							<?php echo $phone; ?> <?php echo $email; ?>
							<br>
							<div class="head-cont">
								IN-PATIENT INVOICE
							</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="2"><b>Name Of Patient: </b><?php echo $names; ?></td>					
					</tr>  
					<tr>
						<th style="padding-left: 50px;">DESCRIPTION</th>
						<th  class="text-center">FEE</th>
					</tr>                          
			        <?php 
			        	$bills = database::getInstance()->select_from_where2('`in-patients`','app_id',$_GET['id']);
			        	foreach ($bills as $bill) {
			        		?>
			        		<tr>
			        			<td style="padding-left: 50px;"><?php echo $bill['item']; ?></td>
			        			<td  class="text-center"><?php $total += $bill['to_pay']; echo $bill['to_pay']; ?></td>
			        		</tr>
			        		<?php
			        	}
			         ?>
			         <tr>
			         	<th></th>
			         	<th class="text-center">Total: <?php echo $total; ?></th>
			         </tr>
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

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
	$sql_pt = mysqli_query($db, "SELECT address,dob,age_type FROM patients WHERE id = ".$pa['patient_id']."");
	$get_pt = mysqli_fetch_assoc($sql_pt);
	$p_addr = $get_pt['address'];
	$p_dob = $get_pt['dob'];
	$p_age_t = $get_pt['age_type'];
	if (isset($_POST) AND !empty($_POST['result'])) {
		$ress = str_replace("\n", "<br/>", $_POST['result']);
		$ress = str_replace(" ", "&#160;", $ress);
		$ress = str_replace("\t", "&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;", $ress);
		$upl = Database::getInstance()->insert_custom_result($ress,$value);
		if ($upl == 'Done') {
			unset($_POST);
			$resp = 1;
		}else{
			unset($_POST);
		}
	}else{
		unset($_POST);
		$resp = 0;
	}
?>

<style>
			@media print {
    .no-print{display: none;}
    .content{height:inherit;}
	 @page {
           margin:10;
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
				<table class="table">
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
								<img src="../assets/images/hospital.png" style="height: 250px;width: 250px; float: left;"><h2  style="font-size: 64px;font-family: arial black;"><b><?php echo $name; ?></b></h2>
							<font style="font-size: 28px;font-family: calibri;font-weight: bold;"><?php echo $address; ?><br>
							<?php echo $phone; ?> <?php echo $email; ?></font>
							<br>
							<div class="head-cont" style="font-size: 24px; width: 50%;font-family: arial black;">
								MEDICAL LABORATORY RESULT
							</div>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="font-size: 32px;font-family: calibri;"><b style="margin:0 50px;">Patient's Name: </b><?php echo ucwords($p_name); ?>  <?php echo $p_sex; ?>  <?php echo $p_age_t; ?></td>						
					</tr>
					<tr>
						<td colspan="4" style="font-size: 24px;"><b style="margin:0 50px;">Reference: </b><?php echo $_GET['id']; ?> <font class="right" style="margin-right: 50px;"><b>Date:</b> <?php echo date('d/m/Y'); ?></font></td>
					</tr>

					<tr>
						<td colspan="4"  style="font-size: 24px;font-family:arial; font-weight:bold;"><b style="margin:0 50px;">Selected Tests:  </b>
							<?php
								$sql_al = mysqli_query($db, "SELECT lab_test_id, lab_test_type_id FROM patient_test WHERE link_ref = '".$value."'");
								while ($get_al = mysqli_fetch_assoc($sql_al)) {
									$al_lti = $get_al['lab_test_id'];
								if (!empty($al_lti)) {
									$sql_lt = mysqli_query($db, "SELECT lab_test FROM lab_test WHERE lab_test_id = ".$al_lti."");
									while ($lb = mysqli_fetch_assoc($sql_lt)) {
										echo $lb['lab_test'].", ";
									}
								}else{
									echo "Nil";
								}

								}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<form id="data" method="POST" action="view_test_lab2.php?id=<?php echo $value; ?>&pid=<?php echo $pid; ?>&n=<?php echo $p_name; ?>&a=<?php echo $p_age; ?>&s=<?php echo $p_sex; ?>&did=<?php echo $doc_id; ?>" style='<?php if ($resp == 0) {echo "display:block;";}else{echo "display:none;";} ?>'>
								<textarea name="result" class="form-control"  rows="70"></textarea>
								<button type="submit" class="btn btn-info">Upload</button>
							</form>
							<div id="ress" style='font-size:24px;font-family:arial; font-weight:bold;margin:0 100px;<?php if ($resp == 1) {echo "display:block;";}else{echo "display:none;";} ?>'>
								<?php 
								$data = Database::getInstance()->select_from_val_ord('custom_result','ref',$_GET['id'],'id','DESC');
								foreach ($data as $que) {
									echo $que['result'];
								}
								?>
							</div>
						</td>
					</tr>
					             <tfoot>

					             	<tr>
					             		<td colspan="4" style="margin-bottom: 80px;">
					             			<div style="height: 1300px;"></div>
					             			<div style="width: 500px; font-size: 32px;margin-right: 50px;" class="text-center right">
					             				<hr size="20">
					             				Medical Laboratory Scientist
					             			</div>
					             		</td>
					             	</tr>
					             </tfoot>                
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
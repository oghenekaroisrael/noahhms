
<?php
	ob_start();
	session_start();
	$pageTitle = "Payments";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
	}
	$db = mysqli_connect("localhost","root","","noahhms");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id= 'front_desk' AND strikes <= 3 AND `timer_notify` <=  '".date("Y-m-d H:i:s")."' ORDER BY id DESC");
		if (mysqli_num_rows($noti) > 0){
		$here = mysqli_fetch_assoc($noti);
		?>
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
			}
	include_once '../inc/header-index.php'; //for addding header

?>
<style type="text/css">
	.jumbotron{
  background: none;
}
#jumbotron-bg{
  background-color: green;
}
</style>
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
                                <h4 class="title">Payments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
										<th>Reference</th>
                                    	<th>Patient</th>
										<th>Payment For</th>
										<th>Status</th>
										<th>Balance</th>
										
										<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_payment4();
											foreach($notarray as $row):
											
											$id = $row['id'];
											$type = $row['GROUP_CONCAT(item)'];											
											$items = explode(',', $type);
											$rno = $row['GROUP_CONCAT(order_id)'];
											$frnt = $row['front_desk'];
											$reference = $row['order_id'];
											$appointment_id = $row['app_id'];
											$p_id = $row['patient_id'];
											$to_pay = $row['SUM(to_pay)'];
											$paid_val = $row['SUM(amount)'];										
											/*if($row['payment_status'] == 1){
												$status = "Paid";
											}elseif ($row['payment_status'] == 2) {
												$status = "Paid Part";
											}elseif($row['payment_status'] == 3){
												$status = "Company Bill";
											}elseif($row['payment_status'] == 4){
												$status = "Deffered Payment";
											}elseif($row['payment_status'] == 5) {
												$status = "Waved Payment";
											}else{
												$status = "Pending";
											}*/
											$arrays = array();
											$statuses = explode(",", $row['GROUP_CONCAT(payment_status)']);
											foreach ($statuses as $status) {
											array_push($arrays, $status);							
											}
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        	$ref_nos = explode(",", $rno);
                                        	$refno = "";
	                                        	foreach ($ref_nos as $ref_no):  
												$refno .= $ref_no. ",<br>";
                                        	endforeach;
                                        	echo substr(trim($refno), 0, -5);
											?>
                                        	</td>
                                        	<td><?php
											if (in_array(11, $items)) {
												$name = database::getInstance()->get_name_from_id('name','antenatal','id',$p_id);
												echo ucwords($name);
											}elseif (in_array(12, $items)) {
												echo ucwords($row['patient_id']);
											}else{
												$notarray = database::getInstance()->select_from_where2('patients', 'id',$p_id );
											$type2 = "";
											foreach($notarray as $row):
											echo $name = $row['title']." ".$row['surname']." ".$row['first_name'];
											endforeach;
											}
											?></td>
                                        	<td>
	                                        		<?php 
			                                        	$types = explode(",", $type);
				                                        	foreach ($types as $type):                                        		
															$notarray = database::getInstance()->select_from_where2('payment_type', 'payment_type_id',$type );
															foreach($notarray as $row):
															$type2 .= $row['payment_type']. ",<br>";
										 					endforeach;
			                                        	endforeach;
			                                        	echo substr(trim($type2), 0, -5);
														?>												
											</td>
                                        	<td><?php 
											if (in_array(0, $arrays) AND in_array(1, $arrays)) {
												echo $array = "Part Paid";
											}elseif (in_array(0, $arrays) AND in_array(2, $arrays)) {
												echo $array = "Part Paid";
											}elseif (in_array(0, $arrays) AND in_array(3, $arrays)) {
												echo $array = "Part Paid";
											}elseif (in_array(0, $arrays) AND in_array(4, $arrays)) {
												echo $array = "Part Paid";
											}elseif (in_array(0, $arrays) AND in_array(5, $arrays)) {
												echo $array = "Part Paid";
											}elseif (in_array(0, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												echo $array = "Not Paid";
											}elseif (in_array(1, $arrays) AND !in_array(5, $arrays) AND !in_array(0, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												echo $array = "Fully Paid";
											}elseif (in_array(3, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(0, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												echo $array = "Company Billed";
											}elseif(in_array(4, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(0, $arrays) AND !in_array(2, $arrays)) {
												echo $array = "Deffered Payments";
											}elseif(in_array(5, $arrays) AND !in_array(0, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												echo $array = "Invalidate";
											} ?></td>
											<td>&#x20A6;<?php echo (intval($to_pay) - intval($paid_val));?></td>
                                        	                 
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="view_payment_details?id=<?php echo $frnt;?>&amount=<?php echo $to_pay;?>&pid=<?php echo $p_id; ?>">View Details</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
	

										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
										<th>Reference</th>
                                    	<th>Patient</th>
										<th>Payment For</th>
										<th>Status</th>
										<th>Balance</th>
										
										<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>
<?php include 'pay.php'; ?>
            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>
<?php include '../notify.php'; ?>

<div class="loader" id="load" style="display:none ">
</div>
	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function update(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to accept payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='accept("+ID+")'>Accept</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
		function accept(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=1',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function cancel(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to cancel payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='canc("+ID+")'>Accept</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function canc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=0',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>

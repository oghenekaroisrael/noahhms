<?php 
	ob_start();
	session_start();
	$pageTitle = "Cost Of Drugs";
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
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Drugs Cost </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro2"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Drug Name</th>
										<th>Amount</th>
                                    	<th>Date Of Purchase</th>
                                    </thead>
                                    <tbody>
									  <?php
									  		$coun=1;
											$count = database::getInstance()->count_from_where("accounts","item",3)-1;
											$c = $count; 
											$notarray = database::getInstance()->select_from_where60('accounts','item',3,'date_paid');
											foreach($notarray as $row):
												$oid = $row['order_id'];
												$amt = $row['to_pay'];
												if($c <= $count && $c >0){
													$c--;
													$next = database::getInstance()->next_cost_of_drugs($c);
												}else{
													$next = database::getInstance()->next_cost_of_drugs($c);
												}
												
												$exp_date = $row['date_paid'];
											$drug_id = database::getInstance()->get_name_from_id2('pharm_stock_id','prescription','reference',$oid);
											$qty = database::getInstance()->get_name_from_id2('quantity_dispense','prescription','reference',$oid);
											$qty2 = database::getInstance()->get_name_from_id2('squantity_dispense','prescription','reference',$oid);
											$notarray2 = database::getInstance()->select_from_where60("pharm_stock","id",$drug_id,"id");
											foreach ($notarray2 as $ow) {
												$id = $ow['id'];
												$cost = $ow['cost_price'];
												$approver = $ow['name'];
											}
											//echo "<br> cur: ".date("Y-m-d",strtotime($row['date_paid']))." next: ".date("Y-m-d",strtotime($next));
										if(date("Y-m-d",strtotime($row['date_paid'])) !=  date("Y-m-d",strtotime($next))){
													?>
													<tr>
														<td></td>
														<td><center><b><?php echo date("Y-m-d",strtotime($row['date_paid'])); ?></b></center></td>
														<td></td>
														<td></td>
													</tr>
		                                        <tr>
		                                        	<td><?php $coun++;?></td>
		                                        	<td>
		                                        	
													<?php echo $approver; ?>
		                                        	</td>
													<td>&#x20A6;<?php if ($qty > 0) {
														echo intval($cost) * intval($qty);
													}else if ($qty2 > 0) {
														echo intval($cost) * intval($qty2);
													} ?></td>
		                                        	
													<td>
		                                        		<?php echo $exp_date;?>

		                                        	</td>
		                                        </tr>
		                                    <?php 
												}

												if (date("Y-m-d",strtotime($row['date_paid'])) ==  date("Y-m-d",strtotime($next))) {
											?>
		                                        <tr>
		                                        	<td><?php $coun++;?></td>
		                                        	<td>
		                                        	
													<?php echo $approver; ?>
		                                        	</td>
													<td>&#x20A6;<?php if ($qty > 0) {
														echo intval($cost) * intval($qty);
													}else if ($qty2 > 0) {
														echo intval($cost) * intval($qty2);
													} ?></td>
		                                        	
													<td>
		                                        		<?php echo $exp_date;?>

		                                        	</td>
		                                        </tr>
                                   			<?php 
												}
                                endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                    	<th>Drug Name</th>
										<th>Amount</th>
                                    	<th>Date Of Purchase</th>

                                    </thead>
								</table>

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
    s("#pro2").DataTable();
  });
</script>


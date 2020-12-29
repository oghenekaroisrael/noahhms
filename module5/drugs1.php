<?php 
	ob_start();
	session_start();
	$pageTitle = "General Ledger";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
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
				
				<div style="padding-bottom:45px;" class="row">
					<div class="col-lg-4">
						<a href="new_expense" class="btn btn-primary btn-flat btblack">
								<i class="entypo-plus-circled"></i> New Expense
						</a>
					</div>
					<div class="col-lg-4">
						<a href="c_balance_monthly" class="btn btn-default btn-flat" style="background-color: #1d62b9; border-color: #1d62b9;color: #fff;">
							<i class="fas fa-line-chart"></i> Monthly View
					</a>
					</div>
					<div class="col-lg-4">
						<a href="new_expense_t" class="btn btn-primary btn-flat btblack pull-right">
								<i class="entypo-plus-circled"></i> New Expense Type
						</a>
					</div>
				</div>

                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">General Ledger </h4>
                            </div>
                            <div class="content">
                            	<div class="row">
                            		<div class="col-lg-12">
                            			<div class="content table-fixed table-full-width">
                            				<table class="table table-hover table-striped">
                            					<thead>
                            						<th>#</th>
			                                    	<th>Drug Name</th>
													<th>Amount</th>
			                                    	<th>Date Of Purchase</th>
                            					</thead>
                            					<tbody>
                            						<?php
                            						$count = database::getInstance()->count_from_where2('accounts','item',3,'date_paid','ASC');
                            						$counter = 1;
                            				$bef = 0;
											$fro = 1; 
											$deb = 0;
											$cre = 0;
											$balance = 0;
											$notarray_exp = database::getInstance()->select_from_where60('accounts','item',3,'date_paid');
											foreach($notarray_exp as $row_exp):
											
											if ($count >= $fro){
											$next = database::getInstance()->select_name_from_limit_range('date_paid','accounts','id','ASC',$fro++,1);
											$prev = database::getInstance()->select_name_from_limit_range('date_paid','accounts','id','ASC',$fro--,1);
											$month = database::getInstance()->get_month('date_paid','accounts',$row_exp['date_paid']);
												$first = database::getInstance()->get_first_date('date_paid','accounts',$month);

											if ($row_exp['date_paid'] == $next && !is_null($next) && !is_null($prev) || $row_exp['date_paid'] == $prev) {
											?>
											<tr>
                                        	<td><?php echo $counter++;?></td>
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
											}else if($row_exp['date_paid'] != $next AND !is_null($next)){
												?>
												<tr>
                                        	<td><?php echo $counter++;?></td>
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
												$last = database::getInstance()->get_last_date('date_paid','accounts',$month);
												$last_id = database::getInstance()->get_last_date_id('date_paid','accounts',$month);
												if ($row_exp['id'] == $last_id) {
													?>
													<tr>
													<td><?php echo  $last; ?></td>
													<td></td>
													<th>Ending Balance</th>
													<td><b>&#8358;<?php echo  $deb; ?></b></td>
													<td><b>&#8358;<?php echo  $cre; ?></b></td>
													<td><b>&#8358;<?php echo  $balance; ?></b></td>
												</tr>
												<tr>
													<td colspan="6">-</td>
												</tr>
												<tr>
													<td colspan="6">-</td>
												</tr>

													<?php
												}
											}
										 endforeach;?>
										</tbody>
                            				</table>
                            			</div><!-- end of table content div-->
                            		</div>
                            	</div>

                            	<div class="row" style="margin:20px;">
                            		<div class="col-lg-12">
                            			<h3 class="title pull-right">Final Balance: &#8358; <?php echo $balance ; ?></h3>
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


<div class="loader" id="load" style="display:none; ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro2").DataTable();
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
            data: "val=" + val +  '&ins=delBall',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'c_balance';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

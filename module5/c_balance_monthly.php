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
		database::getInstance()->fresh_ledger();
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
						<a href="c_balance" class="btn btn-default btn-flat" style="background-color: #1d62b9; border-color: #1d62b9;color: #fff;">
							<i class="fas fa-line-chart"></i> Daily View
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
                            						<th>Month</th>
                            						<th>Reference</th>
                            						<th>Trans Description</th>
                            						<th>Debit Amt</th>
                            						<th>Credit Amt</th>
                            						<th>Balance</th>
                            					</thead>
                            					<tbody>
                            						<?php
                            				$bef = 0;
											$fro = 1; 
											$deb = 0;
											$cre = 0;
											$balance = 0;
											$notarray_exp = database::getInstance()->select_ledger_monthly('ledger_temp','date_ref','ASC');
											foreach($notarray_exp as $row_exp):
											?>
											
												<tr>
													<td><i class="fas fa-calendar"></i><font class="text-center" style="font-weight: bolder;"><?php echo $row_exp['month']; ?></font></td>
													<td><?php echo $row_exp['year']; ?></td>
													<td><?php 
														echo $row_exp['month']."'s Credits And Debits";
													 ?></td>
													<td style="color: red;">&#8358;<?php echo number_format($row_exp['debit']); $deb += $row_exp['debit']; ?></td>
													<td style="color: green;">&#8358;<?php echo number_format($row_exp['credit']); $cre += $row_exp['credit']; ?></td>
													<td  style="color: blue;">&#8358;<?php echo number_format($row_exp['balance']); $balance+= $row_exp['balance']; ?></td>
												</tr>
											<?php
											
										 endforeach;?>
										</tbody>
                            				</table>
                            			</div><!-- end of table content div-->
                            		</div>
                            	</div>

                            	<div class="row" style="margin:20px;">
                            		<div class="col-lg-12">
                            			<h3 class="title pull-right">Final Balance: &#8358; <?php echo number_format($balance); ?></h3>
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

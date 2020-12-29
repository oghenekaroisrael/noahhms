<?php 
	ob_start();
	session_start();
	$pageTitle = "Cash Flow Statement";
	// Include database class
	include_once '../inc/db.php';

	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	if (!isset($_POST['generate'])) {
		unset($_POST);
	}else{
		$date_to1 = $_POST['date_to'];
        $date_from2 = $_POST['date_from'];

        $date_from = date('Y-m-d', strtotime($date_from2));
        $date_to = date('Y-m-d', strtotime($date_to1));

	}

	include_once '../inc/header-index.php'; //for addding header
?>
<style>
	body{
		font-size: 12px;
	}
            @media print {
    .no-print{display: none;}
    .content{width: 100%;}
     @page {
           margin:0;

         }
         body  {
           padding-top: 20px;
           padding-bottom: 20px ;
         }
    }
</style>
<script src="inc/Chart.min.js"></script>
<script src="inc/jquery.min.js"></script>
<div class="wrapper">
	<button type="button" class="btn btn-info pull-right no-print" data-toggle="modal" data-target="#largeModal">Show Profit And Loss Graph</button>
	<div class="header">
		<h5 style="margin-left: 170px;font-size: 12px;">
			GROUP CHRISTAIN MEDICAL CENTRE <br>
			CASH FLOW STATEMENT FOR MONTH/YEAR ENDED <?php echo date('dS M Y', strtotime($date_to)); ?>
		</h5>
	</div>
	<table class="table table-bordered">
			<th></th>
			<th><b style="font-weight: bolder;">OPERATIONS</b></th>
			<th></th>
		<tbody>
			<tr>
				<td width="10%"></td>
				<td>Cash Reciepts From Patients</td>
				<td width="30%">
					<?php 
						$recieved = database::getInstance()->sum_where_greater_between('amount','accounts','amount','0','date_paid',$date_from,$date_to);
						if ($recieved !=0 AND !empty($recieved)) {
							echo "&#8358;".$recieved;
						}
					?>
				</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td>Recievables</td>
				<td width="30%" style="color: red;">
					<?php 
						$whole = database::getInstance()->sum_where_greater_between('to_pay','accounts','to_pay','0','date_paid',$date_from,$date_to);
						$balances = $whole - $recieved;
						if ($balances != 0 AND !empty($balances)) {
							echo " - &#8358;".intval($balances);
						}
						$tot = $recieved-$balances;
					?>
				</td>
			</tr>
				<?php 
					$tot1 = 0;
					?>
						<tr>
							<td></td>
							<td>OTHER INCOMES</td>
							<td>
								<?php 
								$oid = $other_income['id'];
									$oincomes = database::getInstance()->sum_where_greater_between('amt','other_income','amt',0,'date_added',$date_from,$date_to);
									if ($oincomes !=0 AND !empty($oincomes)) {
										echo "&#8358;".intval($oincomes);
									}
									$tot1 += $oincomes;
							 ?>
							</td>
						</tr>
			<tr>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL DIRECT AND OTHER INCOME</b></td>
				<td>
					<?php  $sales = $tot1+$tot;
					echo "&#8358;".$sales;?>
				</td>
			</tr>
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<th></th>
				<th><b style="font-weight: bolder;">COST OF SALES</b></th>
				<th></th>
				<?php 
					$cost = database::getInstance()->select("cost_types");
					$tot2 = 0;
					foreach ($cost as $cost_types) {
						?>
						<tr>
							<td></td>
							<td>
								<?php 
									echo $cost_types['name'];;
								?>
							</td>
							<td>
								<?php 
								$cid = $cost_types['id'];
									$cost_amt = database::getInstance()->sum_where1_between('amt','costs','type',$cid,'date_added',$date_from,$date_to);
									if ($cost_amt !=0 AND !empty($cost_amt)) {
										echo "&#8358;".intval($cost_amt);
									}
									$tot2 += $cost_amt;
							 ?>
							</td>
						</tr>
						<?php
					}
				?>
			<tr>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL COST OF SALES</b></td>
				<td>
					<?php  echo "&#8358;".$tot2;?>
				</td>
			</tr>

			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<tr>
				<td></td>
				<td>
					<b style="font-weight: bolder;">GROSS PROFIT</b>
				</td>
				<td>
					<?php  $gross_profit = $sales-$tot2;
							echo "&#8358;".$gross_profit;
					?>
				</td>
			</tr>

			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<tr>
				<th></th>
				<th><b style="font-weight: bolder;">EXPENSES</b></th>
				<th></th>
				<tr>
							<td></td>
							<td>
								Salary
							</td>
							<td>
								<?php 
									$Salary = database::getInstance()->sum_where1_between('net_salary','payroll','type',1,'date_added',$date_from,$date_to);
									if ($Salary !=0 AND !empty($Salary)) {
										echo "&#8358;".intval($Salary);
									}
									$tot4 += $Salary;
							 ?>
							</td>
						</tr>
				<?php 
					$exp = database::getInstance()->select("expenses_types");
					$tot3 = 0;
					foreach ($exp as $exp_types) {
						?>
						<tr>
							<td></td>
							<td>
								<?php 
									echo $exp_types['name'];;
								?>
							</td>
							<td>
								<?php 
								$eid = $exp_types['id'];
									$exp_amt = database::getInstance()->sum_where1_between('amt','daily_expense','type',$eid,'exp_date',$date_from,$date_to);
									if ($exp_amt !=0 AND !empty($exp_amt)) {
										echo "&#8358;".intval($exp_amt);
									}
									$tot3 += $exp_amt;
							 ?>
							</td>
						</tr>
						<?php
					}
				?>
			</tr>
			<tr>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL EXPENSES</b></td>
				<td>
					<?php  $expenses = $tot3+$tot4; echo "&#8358;".$expenses; ?>
				</td>
			</tr>

			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<tr>
				<td></td>
				<td>
					<b style="font-weight: bolder;">PROFIT BEFORE TAX</b>
				</td>
				<td>
					<?php  $profitbtax = $gross_profit-$tot3-$tot4;
							echo "&#8358;".$profitbtax;
					?>
				</td>
			</tr>


			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
			<tr>
				<td></td>
				<td>
					<b style="font-weight: bolder;">TAX</b>
				</td>
				<td>
					<?php 
						$taxes = database::getInstance()->sum_where1_between('percentage','taxes','status',1,'date_added',$date_from,$date_to);
						echo "&#8358;".$taxes;
					?>
				</td>
			</tr>
			<?php 
				$net_profit = $profitbtax - $taxes;
				if ($net_profit > 0) {
					$net_txt = "PROFIT";
				}else{
					$net_txt = "LOSS";
				}
			?>
			<tr>
				<td></td>
				<td>
					<b style="font-weight: bolder;">NET <?php echo $net_txt; ?></b>
				</td>
				<td>
					<?php 
						echo "&#8358;".$net_profit;
					?>
				</td>
			</tr>

			<!--space--><tr><td></td><td></td><td></td></tr><!--/space-->
		</tbody>
	</table>
</div>
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="largeModalLabel">Profit And Loss Account Graph</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               <div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
														<div class="card" id="chart-container-border" style="height: 100%;">
															<div class="card-body">
																<div id="chart-container">
														    		<canvas id="graphCanvas2" style="width: 100%;"></canvas>
																</div>
																<div style="font-family: raleway;">
																	<div class="row jumbotron" style="padding: 0px 60px;">
																	<div class="col-lg-4">
																		<b>Direct Revenue: </b><font style="color: #00adec;font-weight: bolder;"><?php echo "&#8358;".$tot; ?></font>
																	</div>
																	<div class="col-lg-4">
																		<b>Expenses: </b><font style="color: #ff7c00;font-weight: bolder;"><?php echo "&#8358;".$expenses; ?></font>
																	</div>
																	<div class="col-lg-4">
																		<b>Tax Paid: </b><font style="color: #db2218;font-weight: bolder;"><?php echo "&#8358;".$taxes; ?></font>
																	</div>
																</div>
																	<div class="row "  style="padding: 10px 60px;">
																	<div class="col-lg-4">
																		<b>Other Income: </b><font style="color: #0e3175;font-weight: bolder;"><?php echo "&#8358;".$tot1; ?></font>
																	</div>
																	<div class="col-lg-4">
																		<b>Cost Of Goods: </b><font style="color: #00bf8c;font-weight: bolder;"><?php echo "&#8358;".$tot2; ?></font>
																	</div>
																	<div class="col-lg-4">
																		<b><?php if ($net_profit > 0) {echo "Net Profit: ";}else{echo "Net Loss: ";} ?></b><font style="color: <?php if ($net_profit > 0) {echo "green";}else{echo "red";} ?>;font-weight: bolder;"><?php echo "&#8358;".$net_profit; ?></font>
																	</div>
																</div>
																</div>
															</div>
									</div>
								</div>
								<div class="col-lg-2"></div>
								</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-flat btblack" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
	<script type="text/javascript">
		var s=jQuery .noConflict();
		s(function () {
			showGraph2();
	  });
		function showGraph()
        {
            {
                s.post("data.php",
                function (data)
                {
                    console.log(data);
                    var marks = [];

                    for (var i in data) {
                        marks.push(data[i].amount);
                    }
                    var chartdata = {
                        labels: ['Admissions','Consultations','Physiotherapy','Registrations','Drugs','Lab Tests'],
                        datasets: [
                            {
                                label: 'Departmental Income',
                                backgroundColor: '#77b4a3',
                                borderColor: '#000',
                                borderWidth:0,
                                hoverBackgroundColor: 'rgba(0,0,0,0.2)',
                                hoverBorderColor: '#000',
                                data: ['<?php echo $t1; ?>','<?php echo $t2; ?>','<?php echo $t3; ?>','<?php echo $t4; ?>','<?php echo $t5; ?>','<?php echo $t6; ?>']
                            }
                        ]
                    };
                    var options = {
					    scales: {
					        xAxes: [{
					            barPercentage: 0.5,
					            barThickness: 9,
					            maxBarThickness: 10,
					            minBarLength: 2,
					            gridLines: {
					                offsetGridLines: true
					            }
					        }]
					    },
					    legend:{
					    	labels:{
					    		fontFamily: 'raleway'
					    	}
					    }
					};
                    var graphTarget = s("#graphCanvas1");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
						options: options
                    });
                });
            }
        }


         function showGraph2()
        {
                    var marks = ['<?php echo $tot; ?>','<?php echo $tot1; ?>','<?php echo $tot2; ?>','<?php echo $expenses; ?>','<?php echo $taxes; ?>'];

                    var chartdata = {
                        labels: ['Direct Revenue','Other Income','Cost Of Goods','Expenses','Tax Paid'],
                        datasets: [
                            {
                                label: 'Departmental Income',
                                backgroundColor: ['#00adec','#0e3175','#00bf8c','#ff7c00','#db2218'],
                                borderColor: '#fff',
                                hoverBackgroundColor: 'rgba(0,0,0,0.2)',
                                hoverBorderColor: '#fff',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = s("#graphCanvas2");

                    var barGraph = new Chart(graphTarget, {
                        type: 'pie',
                        data: chartdata
                    });
        }

        function showGraph3()
        {
            {
                s.post("data3.php",
                function (data)
                {
                    console.log(data);
                    var marks2 = [];

                    for (var i in data) {
                        marks2.push(data[i].amount);
                    }
                    var chartdata = {
                        labels: ['Admissions','Consultations','Registrations','Drugs','Lab Tests'],
                        datasets: [
                            {
                                label: 'Departmental Debts',
                                backgroundColor: '#a51010',
                                borderColor: '#000',
                                borderWidth:0,
                                hoverBackgroundColor: 'rgba(0,0,0,0.2)',
                                hoverBorderColor: '#000',
                                data: marks2
                            }
                        ]
                    };
                    var options = {
					    scales: {
					        xAxes: [{
					            barPercentage: 0.5,
					            barThickness: 9,
					            maxBarThickness: 10,
					            minBarLength: 2,
					            gridLines: {
					                offsetGridLines: true
					            }
					        }]
					    },
					    legend:{
					    	labels:{
					    		fontFamily: 'raleway'
					    	}
					    }
					};
                    var graphTarget = s("#graphCanvas3");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
						options: options
                    });
                });
            }
        }

    </script>
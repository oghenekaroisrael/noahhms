<?php 
	ob_start();
	session_start();
	$pageTitle = "Statement Of Financial Position";
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
		$date_to = $_POST['date_to'];
        $date_from = $_POST['date_from'];
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
	<div class="header">
		<h5 style="margin-left: 170px;font-size: 12px;">
			GROUP CHRISTAIN MEDICAL CENTRE <br>
			STATEMENT OF FINANCIAL POSITION FOR MONTH/YEAR ENDED <?php echo date('dS M Y', strtotime($date_to)); ?>
		</h5>
	</div>
	<table class="table table-bordered">
			<th></th>
			<th><b style="font-weight: bolder;"><u>CURRENT ASSETS</u></b></th>
			<th></th>

			<th></th>
			<th><b style="font-weight: bolder;"><u>CURRENT LIABILITIES</u></b></th>
			<th></th>
		<tbody>
			<tr>
				<td width="10%"></td>
				<td>CASH AND CASH EQUIVALENTS</td>
				<td width="30%">
					<?php 
						$inp = database::getInstance()->sum_no_where_between('amount','accounts','date_paid',$date_from,$date_to);
						if ($inp !=0 AND !empty($inp)) {
							echo "&#8358;".$inp;
						}
					?>
				</td>
				<td width="10%"></td>
				<td>ACCOUNT PAYABLE</td>
				<td width="30%">
					
				</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td>INVENTORY GCMC (Warehouse And Pharmacy)</td>
				<td width="30%">
					<?php 
						$drug_pharm = database::getInstance()->sum_no_where_acct('cost_price','stock','pharm_stock');

						$drug_warehouse = database::getInstance()->sum_no_where_acct('cost','cartons','warehouse_stock');
						if ($drug_pharm != 0 AND !empty($drug_pharm) || $drug_warehouse != 0 AND !empty($drug_warehouse)) {
							echo "&#8358;".($drugs = $drug_pharm+$drug_warehouse);
						}
					?>
				</td>
				<td width="10%"></td>
				<td>DR. D. E. OMODION</td>
				<td width="30%">
					
				</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td>INVENTORY MINI MART</td>
				<td width="30%">
				</td>
				<td width="10%"></td>
				<td>DR. </td>
				<td width="30%">
					
				</td>
			</tr>
			
			<tr>
				<td width="10%"></td>
				<td>HMS COOPERATIVES</td>
				<td width="30%">
					<?php 
						$cap_fee = database::getInstance()->sum_where1_between('amount','capitations','status','1','date_added',$date_from,$date_to);
						$cap_staff = database::getInstance()->sum_where1_between('enrollees','capitations','status','1','date_added',$date_from,$date_to);
						$cap = $cap_fee * $cap_staff;
						echo "&#8358;".$cap;
					 ?>
				</td>
				<td width="10%"></td>
				<td>DR. </td>
				<td width="30%">
					
				</td>
			</tr>
			<tr>
				<th></th>
				<th>
					<b style="font-weight: bolder;"><u>ACCOUNT RECIEVABLE</u></b>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td width="10%"></td>
				<td>COMPANIES</td>
				<td width="30%">
					<?php 
					$comp = database::getInstance()->sum_where_greater_between('amount','accounts','company_id','0','date_paid',$date_from,$date_to);
					if ($comp !=0 AND !empty($comp)) {
							echo "&#8358;".$comp;
						}
					?>
				</td>
				<td width="10%"></td>
				<td>DR.</td>
				<td width="30%">
					
				</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td>PRIVATE PATIENTS</td>
				<td width="30%">
					<?php 
					$immune = database::getInstance()->sum_where1_between('amount','accounts','adm','1','date_paid',$date_from,$date_to);
						if ($immune !=0 AND !empty($immune)) {
							echo "&#8358;".$immune;
						}
					?>
				</td>
				<td width="10%"></td>
				<td>GCMC WELFARE</td>
				<td width="30%">
					
				</td><td></td><td></td><td></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td>STAFF DEBTORS</td>
				<td width="30%">
					
				</td><td></td><td></td><td></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td>NHIS DEBTS</td>
				<td width="30%">
					<?php 
					$nhis_paid = database::getInstance()->sum_where_greater_between('amount','accounts','HMO','0','date_paid',$date_from,$date_to);
					$nhis_topay = database::getInstance()->sum_where_greater_between('to_pay','accounts','HMO','0','date_paid',$date_from,$date_to);
					if ($nhis_topay !=0 AND !empty($nhis_topay)) {
							$nhis = ($nhis_topay-$nhis_paid);
							echo "&#8358;".$nhis;
						}
					?>
				</td><td></td><td></td><td></td>
			</tr>
			<tr>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL CURRENT ASSETS</b></td>
				<td>
					<?php  
					//Sum everything
						$tot =$inp+$drugs+$immune+$cap+$nhis;
						echo "&#8358;".$tot;
					?>
				</td>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL CURRENT LIABILITIES</b></td>
				<td>
					
				</td>
			</tr>
			<!--space--><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><!--/space-->
			<!--space--><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><!--/space-->
				<tr>
					<th></th>
				<th><b style="font-weight: bolder;">NON CURRENT ASSETS</b></th>
				<th></th>
				<th></th>
				<th><b style="font-weight: bolder;">NON CURRENT LIABILITIES</b></th>
				<th></th>
				</tr>
				<tr>
					<td></td>
					<td>MEDICAL EQUIP</td>
					<td></td>
					<td></td>
					<td>NS/TF</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td>OFFICE EQUIP</td>
					<td></td>
					<td></td>
					<td>HMO PROF COOPERATIVE</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td>PLANT</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td>MOTOR VAN</td>
					<td></td>
					<td></td>
					<th><u>TOTAL LIABILITIES</u></th>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td>LAND & BUILD</td>
					<td></td>					
					<td></td>
					<th><u>EQUITY</u></th>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>LESS DEPRECIATION</td>
					<td></td>
					<td></td>
					<td>RETAINED EARNINGS</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>NET PROFIT / LOSS</td>
					<td></td>
				</tr>
			<tr>
				<td></td>
				<td><b style="font-weight: bolder;">TOTAL ASSETS</b></td>
				<td>
					
				</td>
					<td></td>
					<th><u>LIABILITIES AND EQUITY</u></th>
					<td></td>
			</tr>
			
			<!--space--><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><!--/space-->
		</tbody>
	</table>
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
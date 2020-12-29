<?php
	ob_start();
	session_start();
	$pageTitle = "Profit And Loss Graph";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
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
	$t1 = database::getInstance()->sum_where1_between('amount','accounts','item','9','date_paid',$date_from,$date_to);
	$t2 = database::getInstance()->sum_where1_between('amount','accounts','item','8','date_paid',$date_from,$date_to);
	$t3 = database::getInstance()->sum_where1_between('amount','accounts','item','7','date_paid',$date_from,$date_to);	
	$t4 = database::getInstance()->sum_where1_between('amount','accounts','item','6','date_paid',$date_from,$date_to);
	$t5 = database::getInstance()->sum_where1_between('amount','accounts','item','5','date_paid',$date_from,$date_to);
	$t6 = database::getInstance()->sum_where1_between('amount','accounts','item','3','date_paid',$date_from,$date_to);
	$t7 = database::getInstance()->sum_where1_between('amount','accounts','item','2','date_paid',$date_from,$date_to);

	$oi = database::getInstance()->select("income_types");
	$other_i = 0;
	foreach ($oi as $other_income) {
		$oid = $other_income['id'];
		$oincomes = database::getInstance()->sum_where1_between('amt','other_income','type',$oid,'date_added',$date_from,$date_to);
		$other_i += $oincomes;
		}
$tot_income = $t1+$t2+$t3+$t4+$t5+$t6+$t7;
$net_paid = $tot_income+$other_i;

//Cost
$cost = database::getInstance()->select("cost_types");
$tot2 = 0;
foreach ($cost as $cost_types) {
	$cid = $cost_types['id'];
	$cost_amt = database::getInstance()->sum_where1_between('amt','costs','type',$cid,'date_added',$date_from,$date_to);
	$tot2 += $cost_amt;
	}
$gross_profit = $net_paid - $tot2;
$Salary = database::getInstance()->sum_where1_between('net_salary','payroll','type',1,'date_added',$date_from,$date_to);

//Expenses
$exp = database::getInstance()->select("expenses_types");
$tot3 = 0;
foreach ($exp as $exp_types) { 
	$eid = $exp_types['id'];
	$exp_amt = database::getInstance()->sum_where1_between('amt','daily_expense','type',$eid,'exp_date',$date_from,$date_to);
	$tot3 += $exp_amt;
	}
$expenses = $Salary + $tot3;
$profitbtax = $gross_profit-$expenses;
$taxes = database::getInstance()->sum_where1_between('percentage','taxes','status',1,'date_added',$date_from,$date_to);
$net_income = $profitbtax - $taxes;
if ($net_income < 0) {
		$stat= "Net Loss: ";
		$net_income = intval($net_income);
		$color = "red";
	}else{
		$stat = "Net Profit: ";
		$net_income = intval($net_income);
		$color = "green";
	}
?>
<script src="inc/Chart.min.js"></script>
<script src="inc/jquery.min.js"></script>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
		<?php include 'inc/main_header.php';?>
			<div class="content">
				<div class="container-fluid">
					<div class="header">
		<h4 class="text-center">
			GROUP CHRISTAIN MEDICAL CENTRE <br>
			PROFIT AND LOSS GRAPH FROM <b><?php echo date('dS M Y', strtotime($date_from)); ?></b> TO <b><?php echo date('dS M Y', strtotime($date_to)); ?></b>
		</h4>
	</div>
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
											<b>Direct Revenue: </b><font style="color: #00adec;font-weight: bolder;"><?php echo "&#8358;".$tot_income; ?></font>
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
											<b>Other Income: </b><font style="color: #0e3175;font-weight: bolder;"><?php echo "&#8358;".$other_i; ?></font>
										</div>
										<div class="col-lg-4">
											<b>Cost Of Goods: </b><font style="color: #00bf8c;font-weight: bolder;"><?php echo "&#8358;".$tot2; ?></font>
										</div>
										<div class="col-lg-4">
											<b><?php echo $stat; ?></b><font style="color: <?php echo $color; ?>;font-weight: bolder;"><?php echo "&#8358;".$net_income; ?></font>
										</div>
									</div>
									</div>
								</div>
		</div>
	</div>
	<div class="col-lg-2"></div>
	</div>					
	</div>
	</div><!--end row-->
</div>
</div>
			
			<?php 
				
				ob_end_flush(); 
			?>
			
		</div>
	</div>
<script type="text/javascript">
		var s=jQuery .noConflict();
		s(function () {
			showGraph2();
	  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From states to deliver to? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
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
                    var marks = ['<?php echo $tot_income; ?>','<?php echo $other_i; ?>','<?php echo $tot2; ?>','<?php echo $expenses; ?>','<?php echo $taxes; ?>'];

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
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delState',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if (data === 'Done') {
					console.log(data);
						window.location = 'states';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
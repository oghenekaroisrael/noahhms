<?php 
	ob_start();
	session_start();
	$pageTitle = "Morgue Bill";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$aid = $_GET['id'];
	
if (isset($_POST) AND !empty($_POST['charge'])) {
	$insert = database::getInstance()->insert_mbill($aid,$_POST['charge'],$user_id);
if ($insert === 'Done') {
	unset($_POST);

}else{
	unset($_POST);
}
}
	include_once '../inc/header-index.php'; //for addding header
?>

<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                           	<?php 
                           	$id = $_GET['id'];
                           	$pname = database::getInstance()->select_from_where("morgue_index","id",$id);
		                           	foreach ($pname as $lue) {
		                           		$patient = $lue['fullname'];
		                           	}
                           	 ?>
                                <h4 class="title">Bill For <b><?php echo $patient; ?></b></h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="prepare_bill.php?id=<?php echo $_GET['id']; ?>">
                                     <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Charge</label>
                                                <select class="form-control" name="charge" id="mcharge">
                                                	<option selected>Select A Charge</option>
                                                	<?php 
														
														
														$charges = Database::getInstance()->select('morgue_charges');
														foreach($charges as $charge):

															$cid= $charge['id'];
															$charge_n = $charge['charge'];	
														
													?>
                                                		?>
                                                		<option value="<?php echo $cid; ?>"><?php echo $charge_n; ?></option>
                                                		<?php
                                                	endforeach;
                                                	 ?>
                                                </select>
                                            </div>
                                        </div>

                                       
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Item</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>	
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

                 <div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="content table-responsive table-full-width">
								<table class="table table-hover table-striped">
									<thead>
										<th>#</th>
										<th>Charge</th>
										<th>Frequency</th>
										<th>Amount</th>
										<th>Remove From List</th>
									</thead>
									<tbody>
																																							<form id="billme">
			                                    	<?php 
			                                    	$coun =1;
			                                    	$the_bill = 0;
			                                    		$tmp_sales = database::getInstance()->select_from_where2('`morgue_bills`','corpse_id',$_GET['id']);
			                                    		foreach ($tmp_sales as $vue) {
			                                    		$count_it = database::getInstance()->select_from_where2('`morgue_bills`','corpse_id',$_GET['id']);
			                                    			$dname = database::getInstance()->get_name_from_id('charge','morgue_charges','id',$vue['charge']);
			                                    			$id = $vue['id'];
			                                    			$amt = $vue['amount']; 
			                                    			$the_bill+=$amt;          			
			                                    			?>
			                                    			<input type="hidden" name="count" value="<?php echo $count_it;?>">
			                                    			<input type="hidden" name="ids[]" value="<?php echo $id;?>">
			                                    			<tr>
			                                    				<td><?php echo $count_i = $coun++; ?></td>
			                                    				<td><?php echo $dname; ?></td> 
			                                    				<td>
			                                    						<input class="form-control" name="freq[]" type="number" value="0">
			                                    				</td>
			                                    				<td>
			                                    					<input type="number" class="form-control" name="amount[]" value="<?php echo $amt; ?>">
			                                    				</td>                           
			                                    				<td><a class="btn btn-danger btn-flat" id="sale_delete" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a></td>
			                                    			</tr>
			                                    			<?php
			                                    		}
			                                    	 ?>	
			                                    	 <tr>
			                                    	 	<td colspan="4">
			                                    	 		<h3 class="pull-right">TOTAL: <?php echo '&#8358;'.number_format($the_bill); ?></h3>
			                                    	 	</td>
			                                    	 </tr>
			                                    	 <tr style="display: <?php if($count_it > 0){echo "contents";}else{echo "none";} ?>;">
			                                    	 	<td colspan="7">
			                                    	 		<button class="btn btn-danger btn-flat pull-left" id="sale_delete" onclick="cancel_all(`<?php echo $aid; ?>`);">Cancel This Transaction</button>


			                                    	 		<button type="submit" class="btn btn-success pull-right" onclick="sure2(<?php echo $aid; ?>,<?php echo $the_bill; ?>);">SEND TO ACCOUNT</button><!--vlue == 1 -->
			                                    	 	</td>
			                                    	 </tr>
			                                    	 </form>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				<div id="get_result"></div>
				

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
	var f=jQuery .noConflict();
	function cancel_all(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delMBills',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=cleared';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
function sure(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This Prepared  List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}

		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delMBill',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=deleted';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function sure2(ID,bill){ 

        	a.notify({
            	icon: 'pe-7s-info',
            	message: "Are you sure you want to Send This Bill To Account? </br><button type='button' class='btn pop-btn' onclick='pay("+ID+","+bill+")'>Send To Account  </button>"

            },{
                type:'info',
                timer: 100000
            });

    	}

		a('billme').submit(function(e){ 
		var val = <?php echo $_GET['id']; ?>;
		var bill = <?php echo $the_bill; ?>;
		e.preventDefault();
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: "POST",
            url: '../func/edit.php',
            data: "val=" + val + '&bill='+bill+'&ins=SendMBillstoAcc',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=done2';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
</script>
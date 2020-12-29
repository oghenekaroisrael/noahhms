<?php 
	ob_start();
	session_start();
	$pageTitle = "In-Patient Bill";
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
	
if (isset($_POST) AND !empty($_POST['fee']) AND $_POST['fee'] != 0 AND !empty($_POST['name'])) {
	$insert = database::getInstance()->insert_bill($aid,$_POST['fee'],$_POST['name'],$_POST['nature'],$user_id);
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
                           	$pid = database::getInstance()->get_name_from_id("patient_id","ipd_patients","appointment_id",$aid);
                           	$pname = database::getInstance()->select_from_where("patients","id",$pid);
                           	foreach ($pname as $lue) {
                           		$patient = $lue['title']." ".$lue['last_name']." ".$lue['middle_name']." ".$lue['first_name'];
                           	}

                           	 ?>
                                <h4 class="title">In-Patient Billing For <b><?php echo $patient; ?></b></h4>
                            </div>
                            <div class="content">
                            	<div class="row">
                            		<?php 
                            		$deposit = Database::getInstance()->sum_where3('`in-patients`','to_pay','nature',1,'app_id',$aid);
			                        $deduct = database::getInstance()->sum_where3("`in-patients`", "to_pay", "nature",2, "app_id", $aid);
			                        $disc = database::getInstance()->sum_where3("`in-patients`", "to_pay", "nature",4, "app_id", $aid);
			                         if ($deposit >= intval(substr($deduct, 1))) {
			                                	$refund = intval($deposit) - intval(substr($deduct, 1));
			                            }else{
			                            	$refund = 0;
			                            }
			                               ?>
                            		<div class="col-lg-4">
                            			<div class="jumbotron">
                            				<h5>Deposit:</h5>
                            				<b>&#8358; <?php echo $deposit; ?></b>
                            			</div>
                            		</div>
                            		<div class="col-lg-4">
                            			<div class="jumbotron">
                            				<h5>Bills:</h5>
                            				<b>&#8358; <?php echo $the_bill = substr(intval($deduct) + intval($disc),1); ?></b>
                            			</div>
                            		</div>
                            		<div class="col-lg-4">
                            			<div class="jumbotron">
                            				<h5>Refund:</h5>
                            				<b>&#8358; <?php echo $refund+$disc; ?></b>
                            			</div>
                            		</div>
                            	</div>
                                <form method="POST" action="prepare_bill.php?id=<?php echo $_GET['id']; ?>">
                                     <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="name" placeholder="Description" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nature</label>
                                                <select class="form-control" name="nature">
                                                	<option value="1">Deposit</option>
                                                	<option value="2">Bill</option>
                                                	<option value="4">Discount</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fee</label>
                                                <input type="number" class="form-control" name="fee" placeholder="Fee" >
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
										<th>Item</th>
										<th>Amount</th>
										<th>Remove From List</th>
									</thead>
									<tbody>
			                                    	<?php 
			                                    	$coun =1;
			                                    		$tmp_sales = database::getInstance()->select_from_where2('`in-patients`','app_id',$_GET['id']);
			                                    		foreach ($tmp_sales as $vue) {

			                                    		$count_it = database::getInstance()->select_from_where2('`in-patients`','app_id',$_GET['id']);
			                                    			$amount = $vue['to_pay'];
			                                    			$dname = $vue['item'];
			                                    			$id = $vue['id'];  
			                                    			$nature = $vue['nature'];                                  			
			                                    			?>
			                                    			<input type="hidden" name="count" value="<?php echo $count_it;?>">
			                                    			<tr>
			                                    				<td><?php echo $count_i = $coun++; ?></td>
			                                    				<td><?php echo $dname; ?></td> 
			                                    				<td style="<?php if ($nature == 1 || $nature == 4) {echo "color: green;";}else{echo "color: red;";}?>"><?php echo $amount; ?></td>                             
			                                    				<td><a class="btn btn-danger btn-flat" id="sale_delete" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a></td>
			                                    			</tr>
			                                    			<?php
			                                    		}
			                                    		$num = $tmp_sales = database::getInstance()->count_bill($aid);
			                                    	 ?>	
			                                    	 <tr style="display: <?php if($num > 0){echo "contents";}else{echo "none";} ?>;">
			                                    	 	<td colspan="7">
			                                    	 		<button class="btn btn-danger btn-flat pull-left" id="sale_delete" onclick="cancel_all(`<?php echo $aid; ?>`);">Cancel This Transaction</button>


			                                    	 		<button type="submit" class="btn btn-success pull-right" onclick="sure2(<?php echo $aid; ?>,`<?php echo $names; ?>`,<?php echo $the_bill; ?>);">SEND TO ACCOUNT</button><!--vlue == 1 -->
			                                    	 	</td>
			                                    	 </tr>
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
            data: "val=" + val +  '&ins=delInpatient_all',
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
            data: "val=" + val +  '&ins=delInpatientDet',
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

		function sure2(ID,name,bill){ 

        	a.notify({
            	icon: 'pe-7s-info',
            	message: "Are you sure you want to Send Bill To Account<b>"+name+"</b> from This Prepared  List ? </br><button type='button' class='btn pop-btn' onclick='pay("+ID+","+bill+")'>Send To Account  </button>"

            },{
                type:'info',
                timer: 100000
            });

    	}

		function pay(ID,pay){ 
		var val = ID;
		var bill = pay;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val + '&bill='+bill+'&ins=SendtoAcc',
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
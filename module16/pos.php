<?php 
	ob_start();
	session_start();
	$pageTitle = "Process sale";
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

	if (!isset($_SESSION['req'])) {
		$sales = Database::getInstance()->count_dispense() +1;
    	$sales_id = "D".date('Ymd')."$sales";
    	$_SESSION['req'] = $sales_id;
    	$value = $_SESSION['req'];
	} else {
		$value = $_SESSION['req'];
	}
	if(isset($_GET['status']) AND $_GET['status'] == 'done') {
        header("Location: pos.php");
    }elseif(isset($_GET['status']) AND $_GET['status'] == 'done2') {
    										$gol = $_SESSION['req'];
        						unset($_SESSION['req']);
														header("Location: print.php?id=$gol");

    }elseif(isset($_GET['status']) AND $_GET['status'] == 'error1' OR $_GET['status'] == 'error2' OR $_GET['status'] == 'error3') {
        ?>
        <script>
                $(document).ready(function() {
                    norem();
                });
        </script>
        <?php
    }
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
                           <div class="row">
                           	<div class="col-lg-9"></div>
                           	<div class="col-lg-3">
                           		<h5 style="font-family: quicksand;">Customer Id: <?php echo $_SESSION['req']; ?></h5>
                           	</div>
                           </div>
                            <div class="content">
									 <div>
	                            	<div class="header">
	                                <h4 class="title">Scan Or Type Name Of Items Being Dispensed</h4>
	                            </div>
								<div id="sections">
									<div class="section">
										<fieldset>

                                <form id="processPharm" autocomplete="off">
										<div class="row">
												<div class="col-lg-3"></div>
										<div class="col-lg-6">
		                            		<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Scan Or Type Name Of Item </label>
		                                                <input type="text" class="form-control" id="proName" placeholder="Type Name Or Scan Barcode " onkeypress="return saler_next(this.value,`<?php echo $_SESSION['req'];?>`)" autofocus>
		                                            </div>
		                                        </div>
											</div>
										</div>
										<div class="col-lg-3">
											
										</div>
										</div>
                                </form>
										<div class="row">
											<div class="col-lg-12">
												<div id="search">
											</div>
											</div>
										</div>

										</fieldset>
									</div><!--end class section-->	
                                </div><!--end id-->



                                <div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="content table-responsive table-full-width">
								<table class="table table-hover table-striped">
									<thead>
										<th>Item</th>
										<th>Amount</th>
										<th>Remove From List</th>
									</thead>
									<tbody>
			                                    	<?php 
			                                    	$coun =1;
			                                    	$sub = 0;
			                                    		$tmp_sales = database::getInstance()->select_from_where2('caf_sales_detail','Sales_Number',$_SESSION['req']);
			                                    		foreach ($tmp_sales as $vue) {

			                                    		$count_it = database::getInstance()->select_from_where2('caf_sales_detail','Sales_Number',$_SESSION['req']);
			                                    			$amount = $vue['Purchasing_Price'];
			                                    			$item_id = $vue['Stock_Item'];
			                                    			$sale_id = $vue['Sales_Number'];
			                                    			$id = $vue['Sales_ID'];
			                                    			$dname = database::getInstance()->get_name_from_id('name','caf_stock','id',$item_id);
			                                    			
			                                    			?>
			                                    			<input type="hidden" name="count" value="<?php echo $count_it;?>">
			                                    			<tr>
			                                    				<td><?php echo $dname; ?></td> 
			                                    				<td><?php echo $amount;$sub+=$amount; ?></td>                             
			                                    				<td><a onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-times"></i></a></td>
			                                    			</tr>
			                                    			<?php
			                                    		}
			                                    		$num = database::getInstance()->count_dispense2($_SESSION['req']);
			                                    	 ?>	
			                                    	 <?php 
			                                    	 	if ($num > 0) {
			                                    	 		?>
			                                    	 <tr>
			                                    	 	<td colspan="3">
			                                    	 			<div class="row">
			                                    	 				<div class="col-lg-4">
			                                    	 						<font class="h4 left">Total Amount</font>
			                                    	 				</div>
			                                    	 				<div class="col-lg-5"></div>
			                                    	 				<div class="col-lg-3">
			                                    	 					<font class="h3 right">&#8358; <?php echo $sub; ?></font>
			                                    	 				</div>
			                                    	 			</div>

			                                    	 			<div class="row">
			                                    	 				<div class="header">
			                                    	 						Payment Method
			                                    	 				</div>

			                                    	 				<form method="POST" action="
			                                    	 				../func/verify.php?ins=CafPayment" id="payfr">
			                                    	 					<div class="col-lg-4">
			                                    	 						<label>Cash</label>
			                                    	 						<div class="form-group">
			                                    	 								<input type="number" name="cash" class="form-control" placeholder="Cash">
			                                    	 						</div>
			                                    	 				</div>

			                                    	 				<div class="col-lg-4">
			                                    	 						<label>POS</label>
			                                    	 						<div class="form-group">
			                                    	 								<input type="number" name="pos" class="form-control" placeholder="POS">
			                                    	 						</div>
			                                    	 				</div>

			                                    	 				<div class="col-lg-4">
			                                    	 						<label>Transfer</label>
			                                    	 						<div class="form-group">
			                                    	 								<input type="number" name="transfer" class="form-control" placeholder="Transfer">
			                                    	 						</div>
			                                    	 				</div>

			                                    	 				<div class="col-lg-4">
			                                    	 					<label>Bank Used</label>
			                                    	 					<div class="form-group">
			                                    	 						<select class="form-control" name="bank">
			                                    	 							<option value="" selected="selected">No Bank</option>
			                                    	 							<option value="ACCESS">ACCESS</option>
			                                    	 							<option value="First Bank">First Bank</option>
			                                    	 							<option value="GTB">GTB</option>
			                                    	 							<option value="UBA">U.B.A</option>
			                                    	 						</select>
			                                    	 					</div>
			                                    	 				</div>

			                                    	 				<div class="col-lg-4">
			                                    	 						<label>Change</label>
			                                    	 						<div class="form-group">
			                                    	 								<input type="number" name="change" class="form-control" placeholder="Change">
			                                    	 						</div>
			                                    	 				</div>

			                                    	 				<div class="col-lg-4">
			                                    	 						<label>Discount</label>
			                                    	 						<div class="form-group">
			                                    	 								<input type="number" name="discount" class="form-control" placeholder="Discount">
			                                    	 						</div>
			                                    	 				</div>
			                                    	 				</form>

			                                    	 			</div>
			                                    	 	</td>
			                                    	 </tr>
			                                    	 
			                                    	 			<tr style="display: <?php if($num > 0){echo "contents";}else{echo "none";} ?>;">
			                                    	 	<td colspan="7">
			                                    	 		<button class="btn btn-danger btn-flat pull-left" id="sale_delete" onclick="cancel_all(`<?php echo $_SESSION['req']; ?>`);">Cancel This Transaction</button>


			                                    	 		<button type="submit" class="btn btn-success pull-right" onclick="pay(document.getElementById('payfr'),<?php echo $sub; ?>);">PAY</button><!--vlue == 1 -->
			                                    	 	</td>
			                                    	 </tr>
			                                    	 		<?php
			                                    	 	}
			                                    	  ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>



	                            </div>
                                <div class="clearfix"></div>

                                <div class="clearTwenty"></div>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				<div id="error"></div>
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

<script>
	function saler_next(str,id){
								if(str.length == 0){
								document.getElementById("search").style.display="none";
								document.getElementById("search").innerHTML=xmlhttp.responseText;
								document.getElementById("search").style.border="0px";

								}
								var xmlhttp;
								if(window.XMLHttpRequest){

								xmlhttp = new XMLHttpRequest();

								}
								else{
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

								}
								xmlhttp.onreadystatechange=function(){
								if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
									
								if(xmlhttp.responseText.length == 0){
								document.getElementById("search").style.display="none";
								document.getElementById("search").innerHTML=xmlhttp.responseText;
								document.getElementById("search").style.border="0px";
								}else{
								document.getElementById("search").style.display="block";
								document.getElementById("search").innerHTML=xmlhttp.responseText;
								}

								}



								}
								var url = "spot.php?q=" + str +"&p=" + id;

								xmlhttp.open("GET",url ,true);
								xmlhttp.send();

}

	s(document).ready(function() {
		s('form').submit(function(e){
			var val = document.getElementById('proName').value;
			e.preventDefault();
			return saler_next(val,`<?php echo $value;?>`);
		})			
	})

	function rem(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Sent To Account Successfully"

            },{
                type: 'success',
                timer: 300000
            });

    	}

   function norem(){ 

        	s.notify({
            	icon: 'pe-7s-info',
            	message: "Item Could Not Be Dispensed"

            },{
                type: 'warning',
                timer: 300000
            });

    	}
function sure(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delDispenseDet',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'pos';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}

		function cancel_all(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delDispenseDet_all',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'pos';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}

		function pay(ID,sum){ 
		var val = '<?php echo $_SESSION['req']; ?>';

		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: a(ID).serialize()  + '&ins=SendtoAcc2'+ '&val='+ val+'&sum=' + sum,
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'print.php?id='+val;
				  }
				  else {
					   
				document.getElementById("load").style.display = "none";
						a("#get_result").html(data).fadeIn("slow");
				  }
            }
          });
		}
  
</script>
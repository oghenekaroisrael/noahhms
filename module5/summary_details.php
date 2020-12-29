<?php 
	ob_start();
	session_start();
	$pageTitle = "Credit Balance";
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
	$from = $_GET['from_date'];
	$to = $_GET['to_date'];
	$val = $_GET['val'];
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
                                <h4 class="title">All Credit Balances </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Card Type</th>
                                        <th>Order Id</th>
                                        <th>Item</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											
											$userDetails = Database::getInstance()->month_date($from, $to, $val);
											foreach($userDetails as $ow):
												 $order_id = $ow['order_id'];
												 $p_id = $ow['patient_id'];
												 $item = $ow['item'];
												 $to_pay = $ow['to_pay'];
												 $p_status = $ow['payment_status'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
											<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['middle_name']." ".$qw['surname'];
														
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	<td><?php echo $order_id; ?></td>
                                        	<td><?php echo $item; ?></td>
                                        	<td><?php echo $to_pay; ?></td>
                                        	<td><?php 
												if($p_status == 0){
													echo "Pending";
												} else {
													echo "Paid";
												}
											?></td>
                                        	
                                        </tr>
										
										
					 
										<?php
									
									endforeach;
									?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Card Type</th>
                                        <th>Order Id</th>
                                        <th>Item</th>
                                        <th>Amount</th>
                                        <th>Status</th>
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
    s("#pro").DataTable();
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

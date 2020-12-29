<?php 
	ob_start();
	session_start();
	$pageTitle = "Cost Of Material";
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
			<div style="padding-bottom:45px;">
				<a href="new_cost" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
						<i class="entypo-plus-circled"></i> New Material Cost
				</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Material Costs </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <!-- <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Date</th>
                                    	<th>Description</th>
										<th>Amount</th>
                                    	<th>Approver</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('costs','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$desc = $row['description'];
											$amt = $row['amt'];
											$exp_date = strtotime($row['pdate']);
											$approver1 = $row['added_by'];

											$approve = database::getInstance()->select_from_where2('staff','user_id',$approver1);
											foreach ($approve as $vae) {
												$approver = $vae['last_name']." ".$vae['first_name'];
											}

										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	
											<td>
                                        		<?php echo date('d-m-Y', $exp_date);?>

                                        	</td>
                                        	<td><?php echo ucwords($desc); ?></td>
											<td>&#x20A6;<?php echo $amt; ?></td>
    
                                        	<td>
                                        	
											<?php echo $approver; ?>
                                        	</td>

                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_cost?id=<?php echo $id; ?>">View/Edit</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $desc; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                    	<th>Date</th>
                                    	<th>Description</th>
										<th>Amount</th>
                                    	<th>Approver</th>
                                    	<th>Action</th>
                                    </thead>
								</table> -->
								<table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Drug Name</th>
										<th>Amount</th>
                                    	<th>Date Of Purchase</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->get_material();
											
											foreach($notarray as $ow):
												$qty2  = $ow['squantity_dispense'];
												$qty  = $ow['quantity_dispense'];
												$cost = $ow['cost_price'];
												$approver = $ow['name'];					
												$exp_date = $ow['date_paid'];

										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-medkit"></i>
                                        	
											<?php echo $approver; ?>
                                        	</td>
											<td>&#x20A6;
											<?php 
												if ($qty > 0) {
													echo number_format(intval($cost) * intval($qty));
												}else if ($qty2 > 0) {
													echo number_format(intval($cost) * intval($qty2));
												} 
											?></td>
                                        	
											<td><i class="fas fa-clock-o"></i>
                                        		<?php echo $exp_date;?>

                                        	</td>
                                        </tr>
									<?php endforeach;?>
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
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delCost',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'material';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

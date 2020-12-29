
<?php 
	ob_start();
	session_start();
	$pageTitle = "Stock";
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
			<a href="new_stock" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Stock
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Stock</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
										<th>ERP<br>ID</th>
                                        <th>Drug Name</th>
                                        <th>Manufacturer</th>
                                    	<th>Generic Name</th> 
                                    	<th>Usage</th>                                   	
                                    	<th>Generic Category</th>                                    	
                                    	<th>Generic Form</th>
                                    	<th>Stock Unit Of Measure</th>
                                    	<th>Selling Price</th>
                                    	<th>Cost Price</th>
                                    	<th>Quantity</th>
                                    	<th>Batch Number</th>
                                    	<th>Exp Date</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('pharm_stock','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$erp = $row['erp'];
											$name = $row['name'];
											$mname = $row['manufacturer'];
											$gname = $row['generic'];
											$category = $row['category'];
											$form = $row['form'];
											$units = $row['units'];
											$cost = $row['price'];
											$usages = $row['s_usage'];
											$usage = Database::getInstance()->get_name_from_id('usage_name','pharm_usage','id',$usages);
											$percent = Database::getInstance()->get_name_from_id('percentage','percentage','id',2);
											$price = intval(($percent/100)*$cost)+$cost;
											$code = $row['Stock_number'];
											$tabs = $row['tabs'];
											$packs = $row['packs'];
											$cartons = $row['cartons'];
											$left = $row['c_carton'];
											$exp_date = $row['expiring'];
											$batch = $row['batch'];
											if ($cartons > 0) {
												$rem = ($left)+($tabs * $packs * $cartons);
											}else{
												$rem = $left;
											}
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php if(empty($erp)){echo "";}else{echo $erp;}?></td>
                                        	<td><?php echo $name;?></td>
                                        	<td><?php echo $mname;?></td>
                                        	<td><?php echo $gname;?></td>
                                        	<td><?php echo $usage; ?></td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_category', 'id', $category);
														foreach($userDetails as $qw):
															 echo $qw['cat_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>                                          	
                                        	<td><?php echo $forms = Database::getInstance()->get_name_from_id('form_name','pharm_form','id',$form); ?></td>
                                        	<td><?php echo $unit = Database::getInstance()->get_name_from_id('unit_name','pharm_units','id',$units);?></td>
                                        	<td>&#x20A6;<?php echo $price;?></td>                                     	
                                        	<td>&#x20A6;<?php echo $cost;?></td>
                                        	<td><?php echo $rem;?></td>
                                        	<td><?php echo $batch; ?></td>  
                                        	<td><?php echo $exp_date;?></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_stock?edit=<?php echo $row['id']; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
										<th>ERP<br>ID</th>
                                        <th>Drug Name</th>
                                        <th>Manufacturer</th>
                                    	<th>Generic Name</th>
                                    	<th>usage</th>                                    	
                                    	<th>Generic Category</th>                                    	
                                    	<th>Generic Form</th>
                                    	<th>Stock Unit Of Measure</th>
                                    	<th>Selling Price</th>
                                    	<th>Cost Price</th>
                                    	<th>Quantity</th>
                                    	<th>Batch Number</th>
                                    	<th>Exp Date</th>
                                    	<th>Action</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from pharmacy stock ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delStock',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'stock';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
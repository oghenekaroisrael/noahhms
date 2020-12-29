<meta http-equiv="refresh" content="3000">
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
				<a href="history" style="margin-bottom:10px;" class="btn btn-default pull-left btn-flat btblack">
					View Stock Update History
			</a>
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
                                        <th>Name</th>
                                    	<th>Category</th>
                                    	<th>Unit</th>
                                    	<th>Purchasing Price</th>
                                    	<th>Selling Price</th>
                                    	<th>Stock</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('pharm_stock','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$name = $row['name'];
											$category = $row['category'];
											$units = $row['units'];
											$cost = $row['cost_price'];
											$price = $row['price'];
											$stock = $row['stock'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $name;?></td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_category', 'id', $category);
														foreach($userDetails as $qw):
															 echo $qw['cat_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_units', 'id', $units);
														foreach($userDetails as $qfw):
															 echo $qfw['unit_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>                                        	
                                        	<td>&#x20A6;<?php echo $cost;?></td>
                                        	<td>&#x20A6;<?php echo $price;?></td>
                                        	<td><?php echo $stock;?></td>

                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_stock?edit=<?php echo $row['id']; ?>">Update Stock</a></li>
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
                                        <th>Name</th>
                                    	<th>Category</th>
                                    	<th>Unit</th>
                                    	<th>Purchasing Price</th>
                                    	<th>Selling Price</th>
                                    	<th>Stock</th>
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

<?php 
	ob_start();
	session_start();
	$pageTitle = "Warehouse Suppliers";
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
			<a href="new_supplier" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Supplier
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Suppliers</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Supplier's Name</th>
                                    	<th>Number</th>
                                    	<th>Address</th>
                                    	<th>Phone Number</th>
                                    	<th>Contact Person</th>
                                    	<th>Contact's Phone Number</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('pharm_suppliers','Supplier_ID','DESC');
											foreach($notarray as $row):
											$id = $row['Supplier_ID'];
											$cat_name = $row['Supplier_Name'];
											$snumb = $row['Supplier_Number'];
											$numb = $row['Phone_Number'];
											$email = $row['Email'];
											$addr = $row['Address'];
											$cont_name = $row['Contact_Person'];
											$cont_mob = $row['Mobile_Number'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-building-o"></i><?php echo $cat_name;?></td>
                                        	<td><?php echo $snumb; ?></td>
                                        	<td><?php echo $addr; ?></td>
                                        	<td><?php echo $numb; ?></td>
                                        	<td><?php echo $cont_name; ?></td>
                                        	<td><?php echo $cont_mob; ?></td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_supplier?edit=<?php echo $row['Supplier_ID']; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['Supplier_ID']; ?>,'<?php echo $cat_name; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Supplier's Name</th>
                                    	<th>Number</th>
                                    	<th>Address</th>
                                    	<th>Phone Number</th>
                                    	<th>Contact Person</th>
                                    	<th>Contact's Phone Number</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from Your list Of Suppliers ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delSupplier',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'Suppliers';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
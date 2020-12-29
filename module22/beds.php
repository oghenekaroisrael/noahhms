
<?php 
	ob_start();
	session_start();
	$pageTitle = "Bed Management";
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
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
			<div style="padding-bottom:45px;">
			<a href="new_bed_type" style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Bed Type
			</a>

			<a href="new_bed" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Bed
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Beds</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Bed</th>
                                        <th>Bed Type</th>
                                        <th>Charge</th>
                                        <th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('morgue_beds','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$type = database::getInstance()->get_name_from_id('types','morgue_bed_types','id',$row['room']);
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-bed"></i><?php echo $row['name']; ?></td>
                                        	<td><i class="fas fa-folder-o"></i><?php echo $type; ?></td> 
                                        	<td><i class="fas fa-money"></i><?php echo $row['charge']; ?></td>
                                        	<td>
                                        		<?php  
                                        			if ($row['status'] == 0) {
                                        				?>
                                        				<div class="badge badge-success">Available</div>
                                        				<?php
                                        			}else if($row['status'] == 1){?>
                                        				<div class="badge badge-info">In Use</div>
                                        				<?php
                                        			}else{?>
                                        				<div class="badge badge-danger">Decomissioned</div>
                                        				<?php
                                        			}
                                        		?>
                                        	</td>                                    	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_bed?edit=<?php echo $id; ?>">Edit</a></li>
													<?php if ($row['status'] != 0) {
														?>
														<li class="divider"></li>
													<li><a data-toggle="modal" data-target="#occupant">View Occupant</a></li>
														<?php
													} ?>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $row['name']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Bed</th>
                                        <th>Bed Type</th>
                                        <th>Charge</th>
                                        <th>Status</th>
                                    	<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>

<!-- Occupant-->
<div class="modal fade" id="occupant">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="occupantlabel">
					Bed Occupant Info
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				na here
			</div>
		</div>
	</div>
</div>
<!--/. Occupant-->
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
            	message: "Are you sure you want to delete <b>"+name+"</b>? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delMBed',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'bed';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

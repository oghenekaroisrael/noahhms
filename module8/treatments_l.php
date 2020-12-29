
<?php 
	ob_start();
	session_start();
	$pageTitle = "Treatments List";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
			if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
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
			<a href="new_treatment_i" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Treatment
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Treatments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Treatments</th>
                                        <th>Fee</th>
                                        <th>Added By</th>
                                        <th>Date Added</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('treatment_list','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$type = $row['name'];
											$fee = $row['fee'];
											$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $row['addedby']);
											foreach($userDetails as $qw):
												 $name2 = $qw['last_name']." ".$qw['first_name'];
											endforeach; 
											$date_added = $row['date_added'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-disease"></i><?php echo $type;?></td>
                                        	<td>&#8358; <?php echo number_format($fee,2); ?></td>
                                        	<td><i class="fas fa-user-nurse"></i> <?php echo $name2; ?></td>
                                        	<td><i class="fas fa-calendar"></i> <?php echo $date_added; ?></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_treatment_i?edit=<?php echo $id; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $type; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Treatments</th>
                                        <th>Fee</th>
                                        <th>Added By</th>
                                        <th>Date Added</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From Treatments? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Yes</button>"

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
            data: "val=" + val +  '&ins=delTreatment',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'treatments_i';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

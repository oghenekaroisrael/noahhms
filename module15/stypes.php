
<?php 
	ob_start();
	session_start();
	$pageTitle = "Sample Types";
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
			<a href="new_stype" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Sample Type
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Sample Types </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Sample Type</th>
                                        <th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('samples','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$type = $row['sample'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-folder-o"></i><?php echo $type;?></td>
                                        	<td>
                                        		<?php if ($row['status']==0) {
                                        			?>
                                        			<div class="badge badge-default">Deactivated</div>
                                        			<?php
                                        		}else{
                                        			?>
                                        			<div class="badge badge-success">Active</div>
                                        			<?php
                                        		} ?>
                                        	</td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_stype?edit=<?php echo $id; ?>">Edit</a></li>
													<li class="divider"></li>
													<?php 
														if ($row['status'] == 1) {
															?>
																<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $type; ?>')">Deactivate</a></li>
															<?php
														}else{
															?>
																<li><a onclick="sure1(<?php echo $id; ?>,'<?php echo $type; ?>')">Activate</a></li>
															<?php
														}
													?>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Sample Type</th>              
                                        <th>Status</th>
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
            	message: "Are you sure you want to Deactivate <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Deactivate</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}

    	function sure1(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Are you sure you want to Activate <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='act("+ID+")'>Activate</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delSample',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'stypes';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function act(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=actSample',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'stypes';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

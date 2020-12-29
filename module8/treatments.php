<?php 
	ob_start();
	session_start();
	$pageTitle = "Treatments";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
        if (!isset($_GET['page'])) {
            $pn = 1;
        }else{
            $pn=$_GET['page'];
        }
        $ipd = $_GET['ipid'];
        $patient = $_GET['id'];
        $adm = $_GET['ipd'];
	}
	include_once '../inc/header-index.php'; //for addding header
?>
<?php
    $userDetails = Database::getInstance()->select_from_where('patients', 'id',$patient);
    foreach($userDetails as $qw):
        $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
        $reg = $qw['reg_num'];
    endforeach; 
?>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <a href="new_treatment?id=<?php echo $patient; ?>&ipid=<?php echo $adm; ?>&ipd=<?php echo $ipd; ?>" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
                <i class="entypo-plus-circled"></i> New Treatment
            </a>
			<div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center" style="text-align:center;">
                                           <h4 class="text-center" style="text-align:center"><strong>Patient's Name: <?php echo $name2;?></strong></h4>
                                        <p class="text-center" style="text-align:center">Reg No: <?php echo $reg;?></p>
                                        <p class="text-center" style="text-align:center">Scheduled Date: <b><?php echo date("Y-m-d");?></b></p>
                                        </div>
                                        <br><br><br>
                            <div class="header">
                                <h4 class="title">All Treatments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Disease / Ailment</th>
                                    	<th>Symptoms</th>
                                        <th>Extra Note</th>
                                        <th>Next Checkup</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord_pn('treatments','admission_id',$adm,'id','DESC',$pn);

                                            //total pages
                                            $totalPages = database::getInstance()->select_from_where_ord_count('treatments','admission_id',$adm,'id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];

										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                                <i class="fas fa-disease"></i>
                                                <?php echo database::getInstance()->get_name_from_id("name","treatment_list","id",$row['disease']); ?>
                                        	</td>
                                        	<td>
                                                <?php echo $row['symptom']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['extra_note']; ?>
                                            </td>
                                            <td>
                                                <?php echo date("Y-m-d",$row['next_checkup']); ?>
                                            </td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="view_treatment?id=<?php echo $id; ?>">View</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Disease / Ailment</th>
                                        <th>Symptoms</th>
                                        <th>Extra Note</th>
                                        <th>Next Checkup</th>
                                        <th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <?php if (($pn > 1)) {
                                            ?>
                                        <li class="page-item">
                                            <a class="page-link" href="surgeries.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
                                        </li><?php }
                                        if (($pn - 1) > 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="surgeries.php?page=1">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link">...</a>
                                            </li>
                                        <?php
                                        }

                                        for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
                                            if ($i < 1)
                                                continue;
                                            if ($i > $totalPages)
                                                break;
                                            if ($i == $pn) {
                                                $class = "active";
                                            } else {
                                                $class = "page-link";
                                            }
                                            ?>
                                        <li class="page-item">
                                            <a href="surgeries.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
                                        </li>
                                            <?php
                                        }
                                        if (($totalPages - ($pn + 1)) >= 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link">...</a>
                                            </li>
                                        <?php
                                        }
                                        if (($totalPages - ($pn + 1)) > 0) {
                                            if ($pn == $totalPages) {
                                                $class = "active";
                                            } else {
                                                $class = "page-link";
                                            }
                                            ?>
                                            <li class="page-item">
                                            <a href="surgeries.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                            <?php
                                            if (($row > 1) && ($pn < $totalPages)) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="surgeries.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
                                                <?php
                                            }
                                            ?>
                                                                            </ul>
                                                                        </nav>
                                <!--Pagination End-->
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
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>

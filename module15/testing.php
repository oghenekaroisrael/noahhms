<?php 
	ob_start();
	session_start();
	$pageTitle = "Donated Blood Testing";
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
	$id = $_GET['id'];
	$donation = $_GET['d'];
    $ref = database::getInstance()->get_name_from_id('lab_ref','donations','id',$_GET['d']);
    $resu = database::getInstance()->get_name_from_id('awaiting_result','blood_test_group','link_ref',$ref);
    $donor = database::getInstance()->select_from_where("donors","donor_id",$id);
        foreach ($donor as $value) {
            $donor_name = $value['name'];
            $donor_father = $value['fathers_name'];
            $blood_group = $value['blood_group'];
            $sex = $value['gender'];
            $age = date_diff(strtotime($value['dob']),date("Y-m-d"));
            $weight = $value['body_weight'];
            $phone = $value['phone'];
            $email = $value['email'];
        }

    $donations = database::getInstance()->select_from_where("donations","id",$_GET['d']);
        foreach ($donations as $dona) {
            $abo_result = $dona['abo_result'];
            $abo_observation = $dona['abo_observation'];
            $rhd_result = $dona['rhd_result'];
            $rhd_observation = $dona ['rhd_observation'];
        }
	
?>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
                <div id="get_result"></div>
			    <div class="row">
                    <div class="col-md-4">
                            <div id="donor_details">
                                <div class="header">
                                <h4 class="title">Donor Details</h4>
                            </div>
                                <label>Full Name: </label> <span><?php echo $donor_name; ?></span>
                                <br>
                                <label>Gender: </label> <span><?php echo $sex; ?></span> 
                                <br>
                                <label>Blood Group: </label><span><?php echo database::getInstance()->get_name_from_id('blood_group','blood_groups','blood_group_id',$blood_group); ?></span>
                                <br>
                                <label>Weight: </label> <span><?php echo $weight; ?></span><br>
                                <label>Phone: </label><span><?php echo $phone; ?></span><br>
                                <label>Email: </label><span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                                </div>
                    </div>

                    <div class="col-md-4">
                            <div id="donor_details">
                                <div class="header">
                                    <h4 class="title">DETERMINATION OF ABO GROUP</h4>
                                </div>
                                <label>Result: </label> <span><?php echo $abo_result; ?></span>
                                <br>
                                <label>Observation: </label> <span><?php echo $abo_observation; ?></span>

                                <div class="header">
                                    <h4 class="title">DETERMINATION OF Rh(D) TYPE</h4>
                                </div>
                                <label>Result: </label> <span><?php echo $rhd_result; ?></span>
                                <br>
                                <label>Observation: </label> <span><?php echo $rhd_observation; ?></span>
                                </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header">
                                    <h4 class="title">
                                        Lab Results
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php 
                                    if ($resu == 0) {
                                        ?>
                                            <div class="badge badge-default">
                                                Pending
                                            </div>
                                        <?php
                                    }else{
                                        ?>
                                            <div class="badge badge-success">
                                                Processed
                                            </div><br><br>
                                               
                                               <?php 
                                                        $noarray = database::getInstance()->select_from_where('donations','id',$_GET['d']);
                                                        while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <form id="label_form">
                                                                        <div class="form-group">
                                                                                    <label>Assigned Label</label>
                                                                                    <input type="text" class="form-control" name="label" value="<?php echo $ow['label'];?>">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Assign</button>
                                                                        <div class="clearfix"></div>
                                                                   </form>
                                                                <?php
                                                         } ?>
                                        <?php
                                    }
                                 ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <form id="status_form">
                            <div class="header">
                                <h4 class="title">Status</h4>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="status">
                                <?php $noarray = database::getInstance()->select_from_where('donations','id',$_GET['d']);
                                    while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?php echo $status; ?>"><?php echo $ow['status']; ?></option>
                                <?php } ?>
                                <option value="Untested">Untested</option>
                                <option value="Clean">Clean</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            
                            <div class="container-fluid">
                            	<div id="accordion">
                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#abo" aria-expanded="false" aria-controls="abo" style="width: 100%;margin-bottom: 20px;">
                            			DETERMINATION OF ABO GROUP</button>
                            		<div class="collapse" id="abo" style="margin-bottom: 20px;">
                            			<form id="abo_form">
                                                <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-6">
                                                <label>Result</label>
                                                <textarea name="result" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Observation</label>
                                                <textarea name="observation" class="form-control"></textarea>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Send</button>
                                    <button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>         
                                        </form>
                            		</div>

                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#rhd" aria-expanded="false" aria-controls="rhd" style="width: 100%;margin-bottom: 20px;">
                            			DETERMINATION OF Rh(D) TYPE</button>
                            		<div class="collapse" id="rhd">
                            		      <form id="rhd_form">
                                                <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-6">
                                                <label>Result</label>
                                                <textarea name="result" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Observation</label>
                                                <textarea name="observation" class="form-control"></textarea>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Send</button>
                                    <button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>         
                                        </form>
                                    </div>

                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#records" aria-expanded="false" aria-controls="records" style="width: 100%;margin-bottom: 20px;">
                            			PREVIOUS RECORDS</button>
                            		<div class="collapse" id="records">
                                        <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Pint(s)</th>
                                        <th>ABO Result</th>
                                        <th>ABO Observation</th>
                                        <th>RhD Result</th>
                                        <th>RhD Observation</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $count = 1;
                                            $prev = database::getInstance()->select_from_where_ord("donations","donor_id",$id,'id','DESC');
                                            foreach ($prev as $pre):
                                                $row_id = $pre['id'];
                                                $type = $pre['type'];
                                                $pints = $pre['pints'];
                                                $abo_result = $pre['abo_result'];
                                                $abo_obs = $pre['abo_observation'];
                                                $rhd_result = $pre['rhd_result'];
                                                $rhd_obs = $pre['rhd_observation'];
                                        ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                            <td><?php echo database::getInstance()->get_name_from_id('sample','samples','id',$type); ?></td>
                                            <td><?php echo $pints;?></td>
                                            <td><?php echo $abo_result;?></td>
                                            <td><?php echo $abo_obs;?></td>
                                            <td><?php echo $rhd_result;?></td>
                                            <td><?php echo $rhd_obs;?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">...</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                    <li><a href="testing?id=<?php echo $id; ?>&d=<?php echo $row_id; ?>">view</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        
                     
                                        <?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Pint(s)</th>
                                        <th>ABO Result</th>
                                        <th>ABO Observation</th>
                                        <th>RhD Result</th>
                                        <th>RhD Observation</th>
                                        <th>Action</th>
                                    </thead>
                                </table>

                            </div>
                            		      
                                    </div>

                                    <button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#serum" aria-expanded="false" aria-controls="serum" style="width: 100%;margin-bottom: 20px;">
                                        TESTS FOR DETECTING UNEXPECTED ANTIBODIES IN SERUM</button>
                                    <div class="collapse" id="serum">
                                          <form id="serum_form">
                                                <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-md-6">
                                                <label>Result</label>
                                                <textarea name="result" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Observation</label>
                                                <textarea name="observation" class="form-control"></textarea>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Send</button>
                                    <button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>         
                                        </form>
                                    </div>

                                    <button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#screening" aria-expanded="false" aria-controls="screening" style="width: 100%;margin-bottom: 20px;">
                                        BLOOD SCREENING</button>
                                    <div class="collapse" id="screening">
                                          <?php
                                          $db =  mysqli_connect("localhost","root","","noahhms");
                                                $sql = mysqli_query($db, "SELECT DISTINCT test_name FROM blood_test_result WHERE ref_id = '".$ref."'");
                                                while ($get = mysqli_fetch_assoc($sql)) {
                                                    $test_name2 = $get['test_name']; 
                                                ?>
                                                <tr>
                                                <td style="font-size: 24px;"><?php 
                                                $no1 = database::getInstance()->select_from_where2('lab_temp_name','id',$test_name2);
                                                            foreach($no1 as $row1):
                                                                $la_name1 = $row1['name'];
                                                            endforeach;
                                                 ?>
                                                <div class="header">
                                                    <h3 class="title"><?php echo $la_name1; ?></h3>
                                                </div>
                                                </td>
                                                <td colspan="3" style="font-size: 24px;">
                                                            <table class="table table-bordered">
                                                    <?php
                                                        $sql21 = mysqli_query($db, "SELECT lab_temp_id,value,date_added FROM blood_test_result WHERE ref_id = '".$ref."' AND test_name = ".$test_name2."");
                                                        while ($get2 = mysqli_fetch_assoc($sql21)) {
                                                            ?>                                  
                                                                        <?php 
                                                                            $sql22 = mysqli_query($db, "SELECT temp_name FROM lab_temps WHERE id = ".$get2['lab_temp_id']."");
                                                                            while ($get3 = mysqli_fetch_assoc($sql22)) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <td width="50%"><?php echo str_replace("_", " ", ucwords($get3['temp_name'])); ?></td>
                                                                                        <td width="30%"><?php echo $get2['value']; ?></td>
                                                                                    </tr>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                            <?php
                                                        }
                                                    ?>
                                                    </table>
                                                </td>
                                            <tr>
                                                <?php
                                                }
                                                
                                            ?>
                                    </div>

                            	</div>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From In-Patient aboervation List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delabo',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
						window.location = 'abo?id=<?php echo $p_id; ?>&ipid=<?php echo $ipid; ?>';
				  }
				  else {
					   
						s('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

        s('#abo_form').on('submit', function (e) {
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST", 
                data: s('#abo_form').serialize() + '&ins=addABOGroup&id='+"<?php echo $user_id; ?>&val=<?php echo $donation; ?>",
                url: "../func/verify.php",
                success: function(data) {
                    document.getElementById("load").style.display = "none";
                      if (data === 'Done') {
                        window.Location = "testing.php?id=<?php echo $id; ?>&d=<?php echo $donation; ?>";
                        }else{
                            s('#get_result').html(data).show();
                        }
                }
            });
        });

        s('#rhd_form').on('submit', function (e) {
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST", 
                data: s('#rhd_form').serialize() + '&ins=addRhDType&id='+"<?php echo $user_id; ?>&val=<?php echo $donation; ?>",
                url: "../func/verify.php",
                success: function(data) {
                    document.getElementById("load").style.display = "none";
                      if (data === 'Done') {
                        window.Location = "testing.php?id=<?php echo $id; ?>&d=<?php echo $donation; ?>";
                        }else{
                            s('#get_result').html(data).show();
                        }
                }
            });
        });

        s('#label_form').on('submit', function (e) {
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST", 
                data: s('#label_form').serialize() + '&ins=addBlabel&id='+"<?php echo $user_id; ?>&val=<?php echo $donation; ?>",
                url: "../func/verify.php",
                success: function(data) {
                    document.getElementById("load").style.display = "none";
                      if (data === 'Done') {
                            window.Location = "testing.php?id=<?php echo $id; ?>&d=<?php echo $donation; ?>";
                        }else{
                            s('#get_result').html(data).show();
                        }
                }
            });
        });

         s('#serum_form').on('submit', function (e) {
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST", 
                data: s('#serum_form').serialize() + '&ins=addSerum&id='+"<?php echo $user_id; ?>&val=<?php echo $donation; ?>",
                url: "../func/verify.php",
                success: function(data) {
                    document.getElementById("load").style.display = "none";
                      if (data === 'Done') {
                        window.Location = "testing.php?id=<?php echo $id; ?>&d=<?php echo $donation; ?>";
                        }else{
                            s('#get_result').html(data).show();
                        }
                }
            });
        });

         s('#status_form').on('change', function (e) {
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST", 
                data: s('#status_form').serialize() + '&ins=addBStatus&id='+"<?php echo $user_id; ?>&val=<?php echo $donation; ?>",
                url: "../func/verify.php",
                success: function(data) {
                    document.getElementById("load").style.display = "none";
                      if (data === 'Done') {
                        window.Location = "testing.php?id=<?php echo $id; ?>&d=<?php echo $donation; ?>";
                        }else{
                            s('#get_result').html(data).show();
                        }
                }
            });
        });
    </script>
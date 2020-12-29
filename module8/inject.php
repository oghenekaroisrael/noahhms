<?php 
	ob_start();
	session_start();
	$pageTitle = "Give Injections";
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
	
	$value = $_GET['id'];
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Injections</h4>
                            </div>

                            <div class="container">
                                <form id="inject">
                            	<?php 
                            		$notarray2 = database::getInstance()->select_from_where2('prescription1', 'prescription_id', $value);
                            		$count = 1;
                            		foreach ($notarray2 as $injection) {
                            			$iid = $injection['prescription_id'];
                            			$inj = database::getInstance()->get_name_from_id("name","pharm_stock","id",$injection['stabs']);
                            			$dosage = $injection['sdosage'];//times per day
                            			$tabs = $injection['stabs'];//quantity per dispense
                            			$duration = $injection['sduration'];//days
                                        $stat = $injection['status'];
                            		}
                                        $dos = $stat;
                                        $dur = (intval($stat)/intval($dosage));
                                        $dur_rem = (intval($stat)%intval($dosage));
                                        if ($dosage == 1) {
                                            for ($i=1; $i <= $dos; $i++) { 
                                                ?>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                    <div class="col-lg-8">
                                                        <b>Day <?php echo $i;  ?></b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="checkbox" name="given">
                                                    </div>
                                                </div>
                                                </div>
                                                <?php
                                            }
                                        }else if ($dosage == 2) {
                                            if ($dur_rem == 0) {
                                                for ($i=1; $i <= $dur; $i++) { ?>
                                                <div class="col-lg-3">
                                                    <div class="row jumbotron" style="background-color: #29a9f7; color: #fff; margin-left: 10px;">
                                                    <h4>Day <?php echo $i; ?></h4>
                                                    <?php for ($j=1; $j <= $dosage; $j++) { 
                                                    ?>
                                                    <div class="col-lg-8">
                                                        <b>
                                                            <?php
                                                            if ($j%2 == 0) {
                                                                echo "Evening";
                                                            }else{
                                                                echo "Morning";
                                                            }
                                                            ?>
                                                        </b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="checkbox" name="given">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php
                                                }
                                            }else{
                                                //with remainders
                                                for ($i=1; $i <= $dur; $i++) { ?>
                                                <div class="col-lg-3">
                                                    <div class="row jumbotron" style="background-color: #29a9f7; color: #fff; margin-left: 10px;">
                                                    <h4>Day <?php echo $i; ?></h4>
                                                    <?php for ($j=1; $j <= $dosage; $j++) { 
                                                    ?>
                                                    <div class="col-lg-8">
                                                        <b>
                                                            <?php
                                                            if ($j%2 == 0) {
                                                                echo "Evening";
                                                            }else{
                                                                echo "Morning";
                                                            }
                                                            ?>
                                                        </b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="checkbox" name="given">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php
                                                }
                                            }
                                        }else if ($dosage == 3) {
                                            for ($i=1; $i <= $dur; $i++) { ?>
                                                <div class="col-lg-3">
                                                    <div class="row jumbotron" style="background-color: #29a9f7; color: #fff; margin-left: 10px;">
                                                    <h4>Day <?php echo $i; ?></h4>
                                                    <?php 
                                                    for ($j=1; $j <= 3; $j++) { 
                                                        ?>
                                                    <div class="col-lg-8">
                                                        <b><?php
                                                            if ($j == 1) {
                                                                echo "Morning";
                                                            }else if ($j == 2){
                                                                echo "Afternoon";
                                                            }else{
                                                                echo "Evening";
                                                            }
                                                        ?></b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="checkbox" name="given">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php
                                                }
                                        }else if ($dosage == 4) {
                                            for ($i=1; $i <= $dur; $i++) { ?>
                                                <div class="col-lg-4">
                                                    <div class="row jumbotron" style="background-color: #29a9f7; color: #fff; margin-left: 10px;">
                                                    <h4>Day <?php echo $i; ?></h4>
                                                    <?php 
                                                    for ($j=1; $j <= 4; $j++) { 
                                                        ?>
                                                    <div class="col-lg-8">
                                                        <b><?php
                                                            if ($j == 1) {
                                                                echo "First Quarter";
                                                            }else if ($j == 2){
                                                                echo "Second Quarter";
                                                            }else if ($j == 3){
                                                                echo "Third Quarter";
                                                            }else{
                                                                echo "Fourth Quarter";
                                                            }
                                                        ?></b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="checkbox" name="given">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                </div>
                                                <?php
                                                }
                                        }
                            	 ?>
                                </form>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delAdminReq',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'new_request';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#inject').on('change', 'input:checkbox', function(e) {
			e.preventDefault();
            document.getElementById("load").style.display = "block";
            f.ajax({
                type: "POST",
                data: f('#inject').serialize() + '&ins=updateInject' + '&val=<?php echo $value; ?>',
                url: "../func/edit.php",
                success: function(res) {
                    document.getElementById("load").style.display = "none";
                    a("#get_result").html(res).fadeIn("slow");
                    console.log(res);
                }
            });
		});
</script>
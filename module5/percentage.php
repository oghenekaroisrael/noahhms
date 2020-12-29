<?php 
	ob_start();
	session_start();
	$pageTitle = "Percentage";
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
    $db = mysqli_connect("localhost","root","","noahhms");
	if (!isset($_POST['edit'])) {
		unset($_POST);
	}else{
        $val = $_POST['percentage'];
        $edit = mysqli_query($db, "UPDATE `percentage` SET `percentage` = ".$val." WHERE `id` = 1");
        if ($edit) {
            header("Location: percentage?status=done");
        }else{
            header("Location: percentage?status=error");
        }
    }
    $perc = mysqli_query($db,"SELECT percentage FROM `percentage` ");
    $percent = mysqli_fetch_assoc($perc);
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <?php 
                if ($_GET['status'] == 'done') {
                    ?>
                    <div class="alert alert-success">
                        Percentage Updated Successfully!
                    </div>
                    <?php
                }elseif($_GET['status'] == 'error'){
                    ?>
                    <div class="alert alert-danger">
                        Error Updating Percentage!
                    </div>
                    <?php
                }
            ?>
            <div class="container-fluid">
                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Edit Percentage </h2>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                	<div class="row">
                                		<div class="col-md-2"></div>
                                		<div class="col-md-8">
                                			
                                        <form method="POST" action="">
                                        <div class="form-group">
                                            <label>Percentage</label>
                                            <input type="text" class="form-control" name="percentage" placeholder="Percentage" value="<?php echo $percent['percentage']; ?>">
                                        </div>
                                        <input type="submit" name="edit" value="EDIT PERCENTAGE" class="btn btn-info" style="width: 100%;">
                                        </form>
                                		</div>
                                		<div class="col-md-2"></div>
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
	
    </script>

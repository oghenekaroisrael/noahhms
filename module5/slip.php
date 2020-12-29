<?php 
	ob_start();
	session_start();
	$pageTitle = "Pay Slip";
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
<style>
      @media print {
    .no-print{display: none;}
    .content{height:inherit;}
   @page {
           margin:10;
           width: 100%;
           margin-left: -130px;
         }
         body  {
           padding:0;
           position: absolute;
         }
    }     
</style>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <table class="table">
          <tr>
            <td colspan="4">
              <center>
                <?php
                $slip = database::getInstance()->select_from_where("payroll","id",$_GET['id']);
                              foreach ($slip as $payslip) {
                                $staff = $payslip['staff_id'];
                                $basic = $payslip['basic'];
                                $housing = $payslip['housing'];
                                $trans = $payslip['transport'];
                                $cduty = $payslip['cduty'];
                                $harzard = $payslip['hazard'];
                                $feeding = $payslip['feeding'];
                                $meds = $payslip['medicals'];
                                $phol = $payslip['pholiday'];
                                $others = $payslip['others'];
                                $total_income = $payslip['total_income'];
                                $paye = $payslip['paye'];
                                $loan = $payslip['loan'];
                                $thrift = $payslip['thrift'];
                                $advance = $payslip['advance'];
                                $daycare = $payslip['daycare'];
                                $pharm = $payslip['pharmacy'];
                                $welfare = $payslip['welfare'];
                                $dothers = $payslip['dothers'];
                                $pension = $payslip['pension'];
                                $total_deductions = $payslip['total_deductions'];
                                $net_salary = $payslip['net_salary'];
                              }
                $db =  mysqli_connect("localhost","root","","noahhms");
                $info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
                $get_hospital_info = mysqli_fetch_assoc($info);
                $name = $get_hospital_info['name'];
                $address = $get_hospital_info['address'];
                $phone = $get_hospital_info['phone'];
                $email =  $get_hospital_info['email'];
                ?>
                <img src="../assets/images/hospital.png" style="height: 250px;width: 250px; float: left;"><h2  style="font-size: 24px;font-family: arial black;"><b><?php echo $name; ?></b></h2>
              <font style="font-size: 18px;font-family: calibri;font-weight: bold;"><?php echo $address; ?><br>
              <?php echo $phone; ?> <?php echo $email; ?></font>
              <br>
              <div class="head-cont" style="font-size: 18px; width: 50%;font-family: arial black;">
                GENERATED PAYSLIP
              </div>
              </center>
            </td>
          </tr>          <tr>

            <td colspan="4" style="font-size: 18px;font-family: calibri;"><b style="margin:0 50px;">Staff's Name: </b> <?php
                                                  $userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $staff);
                                                  foreach($userDetails as $ow):
                                                    $stype = $ow['role_id'];
                                                    echo $ow['last_name']." ".$ow['first_name'];
                                                  endforeach;
                                                  $des = Database::getInstance()->get_name_from_id("name","user_roles","id",$stype);
                                                ?></td>            
          </tr>
          <tr>
            <td colspan="4" style="font-size: 14px;"><b style="margin:0 50px;">Designation: </b><?php echo $des; ?> <font class="right" style="margin-right: 50px;"><b>Date:</b> <?php echo date('d/m/Y'); ?></font></td>
          </tr>
                          </table>
                            <div class="content">
									<div class="row">
										<div class="col-lg-1"></div>
										<div class="col-lg-5"><!-- Income -->
											<div class="header">
										<h4 class="title"><b>INCOME</b></h4>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Basic: </label>
                                                </div>
                                                <div class="col">
                                                  <span><?php echo $basic; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Housing: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $housing; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Transport: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $trans; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Call Duty: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $cduty; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Harzard: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $harzard; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Feeding: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $feeding; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Medicals: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $meds; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Public Holiday: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $phol; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Others: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $others; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Total Income: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $total_income; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
										</div><!-- / Income -->
										<div class="col-lg-5"><!--Deductions -->
												<div class="header">
													<h4 class="title"><b>DEDUCTIONS</b></h4>
												</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>P.A.Y.E: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $paye; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Pension (8% of BHT): </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $pension; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Loan Repayment: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $loan; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Thrift: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $thrift; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Salary Advance: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $advance; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Day Care: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $daycare; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12"><div class="row">
                                                <div class="col-lg-6">
                                                  <label>Pharmacy: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $pharm; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Welfare: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $welfare; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                        <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Others: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $dothers; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Total Deductions: </label>
                                                </div>
                                                <div class="col-lg-6">                       
                                                <span><?php echo $total_deductions; ?></span>
                                                </div>
                                            </div>
                                        </div>
									</div>
										</div><!-- /Deductions -->

										<div class="col-lg-1"></div>
									</div>
                  <div class="row"><!--net salary-->
                      <div class="col-lg-9">
                        <div class="pull-right">
                          <h4>NET SALARY : <?php echo $net_salary; ?></h4>
                        </div>
                      </div>
                  </div><!--/net salary-->
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
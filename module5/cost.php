<?php 
    ob_start();
    session_start();
    $pageTitle = "Cost And Expenses Manager";
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
            <div class="row">
                <div class="col-lg-3">
                    <div class="card" style="height: 150px;">
                        <div>
                            <span style="padding: 20px;position: absolute;top: 40px;left: 30px;color: #fff; background: #031751;">&#8358;</span>
                            <font style="position: absolute;font-weight: normal;font-size: 24px;color: #031751;top: 60px;left: 100px;font-family: raleway;"><?php include 'c1.php'; ?></font>
                            <br>
                            <font style="position: absolute;top: 110px;left: 90px;font-size: 14px;color: #7b7b7b;">Total Cost</font>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"></div>
                <div class="col-lg-3">
                    <div class="card" style="height: 150px;">
                        <div>
                            <span style="padding: 20px;position: absolute;top: 40px;left: 30px;color: #fff; background: #881313;">&#8358;</span>
                            <font style="position: absolute;font-weight: normal;font-size: 24px;color: #881313;top: 60px;left: 100px;font-family: raleway;"><?php include 'c2.php'; ?></font>
                            <br>
                            <font style="position: absolute;top: 110px;left: 90px;font-size: 14px;color: #7b7b7b;">Expenses For This Month</font>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-lg-4">
                        <a href="new_expense" class="btn btn-primary btn-flat btblack">
                                <i class="entypo-plus-circled"></i> New Expense
                        </a>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <a href="new_expense_t" class="btn btn-primary btn-flat btblack pull-right">
                                <i class="entypo-plus-circled"></i> New Expense Type
                        </a>
                    </div>
            </div>
                <div class="row">
                     <div class="col-lg-6">
                        <div class="card" onclick="window.location='material.php';" style="padding: 80px 0;background: #031751;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                            Cost Of Material
                           </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card"  onclick="window.location='drugs.php';" style="padding: 80px 0;background: #203A2C;font-family: raleway;font-weight: bolder;font-size: 24px;color: #fff;">
                           <div class="header">
                            Cost Of Drugs
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
                message: "Are you sure you want to delete <b>"+name+"</b> From List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delCost',
             success: function(data)
            {
                document.getElementById("load").style.display = "block";
                if (data === 'Done') {
                    console.log(data);
                        window.location = 'material';
                  }
                  else {
                       
                        jQuery('#get_det'+ID).html(data).show();
                  }
            }
          });
        }

    </script>

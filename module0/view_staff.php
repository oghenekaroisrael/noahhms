<?php 
    ob_start();
    session_start();
    $pageTitle = "Edit Staff Record";
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
    $value= $_GET['id'];
?>
 
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
                             <?php
                            $noarray = database::getInstance()->select_from_where('staff','user_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                                $role_id = $ow['role_id'];
                                $ward_id = $ow['ward_id'];
                                ?>
                           <div class="header">
                                <h4 class="title">Staff Details For <b><?php echo $ow['last_name']." ".$ow['first_name']." ".$ow['other_names']; ?></b></h4>
                            </div>
                            <div class="content">
                                

                                <div class="row">
                                       <div class="col-md-12">
                                            <div class="text-center">
                                                <img src="staff_img/<?php echo $ow['staff_img']; ?>" class="img img-circle" height="100" width="100">
                                            </div>
                                        </div>
                                </div>

                                <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Surname:</label>
                                                <font><?php echo $ow['last_name'];?></font>
                                            </div>
                                        </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <font><?php echo $ow['first_name'];?></font>
                                            </div>
                                        </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Other Names:</label>
                                                <font><?php echo $ow['other_names'];?></font>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Address (Land Mark): </label>
                                                <font><?php echo $ow['contact_address']; ?></font>
                                            </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number(s): </label>
                                                <font><?php echo $ow['phone_number']; ?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Birth: </label>
                                                <font><?php echo $ow['dob'];?></font>
                                            </div>
                                        </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sex: </label>
                                                <font><?php echo $ow['sex'];?></font>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Place Of Birth: </label>
                                                <font><?php echo $ow['pob'];?></font>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status: </label>
                                                <font><?php echo $ow['mstatus'];?></font>
                                            </div>
                                        </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Religion: </label>
                                                <font><?php echo $ow['religion'];?></font>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Next Of Kin: </label>
                                                <font><?php echo $ow['nok'];?></font>
                                            </div>
                                       </div>
                                </div>

                                <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number Of Kin: </label>
                                                <font><?php echo $ow['phone_nok'];?></font>
                                            </div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State Of Origin: </label>
                                                <font><?php echo $ow['state'];?></font>
                                            </div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Local Government Of Origin: </label>
                                                <font><?php echo $ow['lga'];?></font>
                                            </div>
                                       </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Employment: </label>
                                                <font><?php echo $ow['date_of_emp'];?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Starting Salary: </label>
                                                <font><?php echo $ow['starting_salary'];?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Designation: </label>
                                                <font><?php echo $ow['position'];?></font>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Weight: </label>
                                                <font><?php echo $ow['weight'];?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Of Children: </label>
                                                <font><?php echo $ow['no_of_children'];?></font>
                                            </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (1): </label>
                                                <font><?php echo $ow['child1'];?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (2: </label>
                                                <font><?php echo $ow['child2'];?></font>
                                            </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (3): </label>
                                                <font><?php echo $ow['child3'];?></font>
                                            </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (4): </label>
                                                <font><?php echo $ow['child4'];?></font>
                                            </div>
                                    </div>
                                </div>
                                    
                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Role: </label>
                                                    <?php
                                                        $userDetails = Database::getInstance()->select_from_where('user_roles', 'id', $role_id); 
                                                        foreach($userDetails as $w):
                                                            $named = $w['name'];
                                                        endforeach;                                                         
                                                    ?>
                                                    <font><?php echo $named;?></font>   
                                                </select>
                                            </div>
                                        </div>
                                    </div> 



                                    <div class="row"  style="display: none;" id="ward">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Ward: </label>
                                            </div>
                                        </div>
                                    </div>
                                    

                            <?php } ?><div class="clearfix"></div>
                            </div>
                        
                        </div>
                    </div>
                 </div>

                <div id="get_result"></div>

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
<script>    
    var s=jQuery .noConflict();
    var roles = parseInt(document.getElementById("role").value);
    s(document).ready(function() {
        s('form').submit(function(e){
            var val = "<?php echo $value; ?>";
            e.preventDefault();
            document.getElementById("load").style.display = "block";
            s.ajax({
                type: "POST",
                data: s('form').serialize() + "&val=" + val + "&ins=editStaff",
                url: "../func/edit.php",
                success: function(res) {
                    document.getElementById("load").style.display = "none";
                    s("#get_result").html(res).fadeIn("slow");
                }
            });
        })

        a('#role'). on('change', function(e) {
            var role = parseInt(document.getElementById("role").value);
            if (role == 7) {
                document.getElementById('ward').style.display = "block";
            }else{              
                document.getElementById('ward').style.display = "none";
            }
       

        });         
    })          
</script>


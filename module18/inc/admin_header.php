<div class="sidebar" data-color=""  data-image="../assets/img/sidebar-5.jpg">


        <div class="sidebar-wrapper">
        
            <?php
                $userDetails = Database::getInstance()->select_from_where2('staff','user_id',$user_id);
                foreach($userDetails as $row):
                    $name = $row['last_name']." ".$row['first_name'];
                    $role_id = $row['role_id'];
                    $urole = Database::getInstance()->get_name_from_id("name","user_roles","id",$role_id);
                endforeach;             
            ?>
            <div class="clearTwenty"></div>
            <div id="nav-login">
                <center>
                    <img width="80" height="80" src="../module0/staff_img/<?php echo $row['staff_img']; ?>" class="img img-circle"><br>
                    <b><?php echo $name; ?></b>
                    <br>
                    <span><?php echo $urole; ?></span>
                </center>
            </div>
            <div class="clearfix"></div>
           <ul class="nav" id="my-nav">
                 <?php 
                    if ($role_id == 1 || $role_id ==  17 || $role_id ==  2) {
                        ?>
                
                        <li class="<?php if ($active_page == 'new_patient') echo 'active'; ?>">
                    <a href="new_patient">
                        <i class="fas fa-user-plus"></i>
                        <p>Register New Patient</p>
                    </a>
                </li>
                
                <li class="<?php if ($active_page == 'patients' || $active_page == 'edit_patient')echo 'active'; ?>">
                    <a href="patients">
                        <i class="fas fa-users"></i>
                        <p>All Patients</p>
                    </a>
                </li>
                        <?php
                    }
                  ?>

                <?php 
                    if ($role_id == 2 || $role_id == 17 || $role_id == 1) {
                        ?>
                
                                        <?php
                    }
                 ?>

            </ul>
    	</div>
    </div>
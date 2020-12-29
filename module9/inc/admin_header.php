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
                <li class="<?php if ($active_page == 'appointment') echo 'active'; ?> ">
                    <a href="../module1/appointment.php" target="_blank">
                        <i class="entypo-layout"></i>
                        <p>Front Desk</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'appointment') echo 'active'; ?> ">
                    <a href="../module8/vitals.php" target="_blank">
                        <i class="entypo-layout"></i>
                        <p>Nurse</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index') echo 'active'; ?> ">
                    <a href="../module7/index.php" target="_blank">
                        <i class="entypo-layout"></i>
                        <p>Doctors</p>
                    </a>
                </li>
                
                 <li class="<?php if ($active_page == 'index')echo 'active'; ?>">
                    <a href="../module3/index.php">
                        <i class="entypo-layout"></i>
                        <p>Laboratory</p>
                    </a>
                </li>
				
				
                <li class="<?php if ($active_page == 'prescriptions.php') echo 'active'; ?> ">
                    <a href="../module4/prescriptions.php" target="_blank">
                        <i class="entypo-layout"></i>
                        <p>Pharmacy</p>
                    </a>
                </li>
                
                <li class="<?php if ($active_page == 'test') echo 'active'; ?> ">
                    <a href="test" target="_blank">
                        <i class="entypo-layout"></i>
                        <p>Lab Test</p>
                    </a>
                </li>

				 <li class="<?php if ($active_page == 'test_type') echo 'active'; ?> ">
                    <a href="test_type">
                        <i class="entypo-layout"></i>
                        <p>Lab Test Type</p>
                    </a>
                </li>

                
                 <li class="<?php if ($active_page == 'staff.php' || $active_page == 'edit_staff' || $active_page == 'new_staff') echo 'active'; ?> ">
                    <a href="staff">
                        <i class="entypo-layout"></i>
                        <p>Manage Staff</p>
                    </a>
                </li>
                
            </ul>
    	</div>
    </div>
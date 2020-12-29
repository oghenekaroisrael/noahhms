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
                        <li class="<?php if ($active_page == 'index' || $active_page == 'process') echo 'active'; ?>">
                            <a href="index">
                                <i class="fas fa-ambulance"></i>
                                <p>Incoming Deceased</p>
                            </a>
                        </li>

                        <li class="<?php if ($active_page == 'occupancies' || $active_page == 'occupancies') echo 'active'; ?>">
                            <a href="occupancies">
                                <i class="fas fa-cab"></i>
                                <p>Occupancies</p>
                            </a>
                        </li>

                        <li class="<?php if ($active_page == 'beds' || $active_page == 'new_bed' || $active_page == 'new_bed_type' || $active_page == 'edit_bed') echo 'active'; ?>">
                            <a href="beds">
                                <i class="fas fa-bed"></i>
                                <p>Bed Management</p>
                            </a>
                        </li>

                        <li class="<?php if ($active_page == 'charges' || $active_page == 'new_charge' || $active_page == 'edit_charge') echo 'active'; ?>">
                            <a href="charges">
                                <i class="fas fa-money"></i>
                                <p>Charges Management</p>
                            </a>
                        </li>
            </ul>
    	</div>
    </div>
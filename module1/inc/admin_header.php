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
                <li class="<?php if ($active_page == 'appointment' || $active_page == 'new_appointment' || $active_page == 'edit_appointment') echo 'active'; ?>">
                    <a href="appointment">
                        <i class="fas fa-calendar"></i>
                        <p>Appointment and Queue</p>
                    </a>
                </li>

                  <li class="<?php if ($active_page == 'visitor' || $active_page == 'new_visitor' || $active_page == 'edit_visitor') echo 'active'; ?>">
                    <a href="visitor">
                        <i class="fas fa-user"></i>
                        <p>Visitor's &nbsp Log</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'all_ipd' || $active_page =='view_note')echo 'active'; ?>">
                    <a href="all_ipd">
                        <i class="fas fa-bed"></i>
                        <p>Occupancies</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'patients' || $active_page == 'edit_patient')echo 'active'; ?>">
                    <a href="patients">
                        <i class="fas fa-users"></i>
                        <p>Out Patient Department</p>
                    </a>
                </li>
                        <?php
                    }
                  ?>
				<?php if($role_id == 17 || $role_id == 18 || $role_id == 1  || $role_id ==  2){ ?>
				<li class="<?php if ($active_page == 'payment_daily' || $active_page == 'process_prescription') echo 'active'; ?>">
                    <a href="payment_daily">
                        <i class="fas fa-dollar"></i>
                        <p>Payment</p>
                    </a>
                </li>

                <?php } ?>

                <?php 
                    if ($role_id == 2 || $role_id == 17 || $role_id == 1) {
                        ?>
                            <li class="<?php if ($active_page == 'cards' || $active_page == 'new_card' || $active_page == 'edit_card') echo 'active'; ?>">
                    <a href="cards">
                        <i class="fas fa-folder"></i>
                        <p>Card Types</p>
                    </a>
                </li>
                
                <li class="<?php if ($active_page == 'surgery' || $active_page == 'new_surgery')echo 'active'; ?>">
                    <a href="surgery">
                        <i class="fas fa-procedures"></i>
                        <p>Surgery</p>
                    </a>
                </li>
                
                <li class="<?php if ($active_page == 'antenatal' || $active_page == 'new_antenatal' || $active_page == 'edit_antenatal')echo 'active'; ?>">
                    <a href="antenatal">
                        <i class="fas fa-syringe"></i>
                        <p>Immunization</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'antenatal1' || $active_page == 'new_antenatal1' || $active_page == 'edit_antenatal1')echo 'active'; ?>">
                    <a href="antenatal1">
                        <i class="fas fa-venus-mars"></i>
                        <p>Antenatal</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'family' || $active_page == 'new_family' || $active_page == 'edit_family')echo 'active'; ?>">
                    <a href="family">
                        <i class="fas fa-users"></i>
                        <p>Family</p>
                    </a>
                </li>
                        <?php
                    }
                 ?>

            </ul>
    	</div>
    </div>
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
				<li class="<?php if ($active_page == 'index')echo 'active'; ?>">
                    <a href="index">
                        <i class="fas fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'appointment')echo 'active'; ?>">
                    <a href="appointment">
                        <i class="fas fa-users"></i>
                        <p>Appointments</p>
                    </a>
                </li>
                <li class="<?php if ($active_page == 'visitor')echo 'active'; ?>">
                    <a href="visitor">
                        <i class="fas fa-user"></i>
                        <p>Visitor's &nbsp Log</p>
                    </a>
                </li>
                <li class="<?php if ($active_page == 'in_patients')echo 'active'; ?>">
                    <a href="in_patients">
                        <i class="fas fa-bed"></i>
                        <p>In Patients</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'antenatal1')echo 'active'; ?>">
                    <a href="antenatal1">
                        <i class="fas fa-venus-mars"></i>
                        <p>Antenatal</p>
                    </a>
                </li>
				<li class="<?php if ($active_page == 'calender')echo 'active'; ?>">
                    <a href="calender">
                        <i class="fas fa-calendar"></i>
                        <p>Calender</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>
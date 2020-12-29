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
			<li class="<?php if ($active_page == 'vitals' || $active_page == 'edit_vitals' || $active_page == 'new_vitals')echo 'active'; ?>">
                    <a href="vitals">
                        <i class="fas fa-calendar"></i>
                        <p>Appointment and Queue</p>
                    </a>
                </li>
                
				
                <li class="<?php if ($active_page == 'all_ipd') echo 'active'; ?>">
                    <a href="all_ipd">
                        <i class="fas fa-procedures"></i>
                        <p>Admissions</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'new_request') echo 'active'; ?>">
                    <a href="new_request">
                        <i class="fas fa-user-md"></i>
                        <p>Doctor Admission Request</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'exam_request') echo 'active'; ?>">
                    <a href="exam_request">
                        <i class="fas fa-syringe"></i>
                        <p>Doctor Injection Request</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'surgeries') echo 'active'; ?>">
                    <a href="surgeries">
                        <i class="fas fa-cut"></i>
                        <p>Surgeries</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'antenatal1') echo 'active'; ?>">
                    <a href="antenatal1">
                        <i class="fas fa-venus-mars"></i>
                        <p>Antenatal</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'labour') echo 'active'; ?>">
                    <a href="labour">
                        <i class="fas fa-child"></i>
                        <p>Labour</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'beds' || $active_page == 'new_bed' || $active_page == 'new_bed_type' || $active_page == 'edit_bed') echo 'active'; ?>">
                    <a href="beds">
                        <i class="fas fa-bed"></i>
                        <p>Bed Management</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'new_treatment_i' || $active_page == 'treatments_l' || $active_page == 'edit_treatment_i') echo 'active'; ?>">
                    <a href="treatments_l">
                        <i class="fas fa-band-aid"></i>
                        <p>Treatment Management</p>
                    </a>
                </li>

				<li class="<?php if ($active_page == 'statistics' || $active_page == 'new_stat') echo 'active'; ?>">
                    <a href="statistics">
                        <i class="fas fa-calendar-check"></i>
                        <p>Roaster</p>
                    </a>
                </li>
				
				
                
                
            </ul>
    	</div>
    </div>
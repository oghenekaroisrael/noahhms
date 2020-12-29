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
				<!--
				<li class="<?php if ($active_page == 'index')echo 'active'; ?>">
                    <a href="index">
                        <i class="entypo-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
               
                
                <li class="<?php if ($active_page == 'patients' || $active_page == 'new_patient' || $active_page == 'edit_patient')echo 'active'; ?>">
                    <a href="patients">
                        <i class="entypo-layout"></i>
                        <p>Register New Patient</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'doc_schedule' || $active_page == 'edit_doc_schedule' || $active_page == 'new_doc_schedule')echo 'active'; ?>">
                    <a href="doc_schedule">
                        <i class="entypo-layout"></i>
                        <p>Doctor's Weekly Schedule</p>
                    </a>
                </li>-->

               
                
                <li class="<?php if ($active_page == 'vitals' || $active_page == 'edit_vitals' || $active_page == 'new_vitals')echo 'active'; ?>">
                    <a href="vitals">
                        <i class="entypo-layout"></i>
                        <p>Appointment and Queue</p>
                    </a>
                </li>
                
				
                <li class="<?php if ($active_page == 'all_ipd') echo 'active'; ?>">
                    <a href="all_ipd">
                        <i class="entypo-layout"></i>
                        <p>Admissions</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'new_request') echo 'active'; ?>">
                    <a href="new_request">
                        <i class="entypo-layout"></i>
                        <p>Doctor Admission Request</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'exam_request') echo 'active'; ?>">
                    <a href="exam_request">
                        <i class="entypo-layout"></i>
                        <p>Doctor Examination Request</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'statistics' || $active_page == 'new_stat') echo 'active'; ?>">
                    <a href="statistics">
                        <i class="entypo-layout"></i>
                        <p>Night Or Morning Duty</p>
                    </a>
                </li>
				
				
                
                
            </ul>
    	</div>
    </div>
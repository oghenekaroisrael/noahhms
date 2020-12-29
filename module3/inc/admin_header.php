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
                        <i class="fas fa-user-md"></i>
                        <p>Doctor's Requests</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'front_desk_test')echo 'active'; ?>">
                    <a href="front_desk_test">
                        <i class="fas fa-building-o"></i>
                        <p>Front Desk Requests</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'blood')echo 'active'; ?>">
                    <a href="blood">
                        <i class="fas fa-tint"></i>
                        <p>Blood Screening Requests</p>
                    </a>
                </li>

				 <li class="<?php if ($active_page == 'test') echo 'active'; ?> ">
                    <a href="test" target="_blank">
                        <i class="fas fa-book"></i>
                        <p>Lab Test</p>
                    </a>
                </li>

				 <li class="<?php if ($active_page == 'test_type') echo 'active'; ?> ">
                    <a href="test_type">
                        <i class="fas fa-folder"></i>
                        <p>Laboratory Departments</p>
                    </a>
                </li>
				
				 <li class="<?php if ($active_page == 'test_result_template' || $active_page == 'lab_test_names' || $active_page == 'edit_lab_test_names') echo 'active'; ?> ">
                    <a href="lab_test_names">
                        <i class="fas fa-file-word-o"></i>
                        <p>Lab Test Result Template</p>
                    </a>
                </li>
                
            </ul>
    	</div>
    </div>
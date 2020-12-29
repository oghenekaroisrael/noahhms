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
				<li class="<?php if ($active_page == 'scans')echo 'active'; ?>">
                    <a href="scans">
                        <i class="fas fa-video-camera"></i>
                        <p>Scan Requests</p>
                    </a>
                </li>

               <li class="<?php if ($active_page == 'scan')echo 'active'; ?>">
                    <a href="scan">
                        <i class="fas fa-file-text-o"></i>
                        <p>Scans</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'scan_types')echo 'active'; ?>">
                    <a href="scan_types">
                        <i class="fas fa-folder"></i>
                        <p>Scans Categories</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>
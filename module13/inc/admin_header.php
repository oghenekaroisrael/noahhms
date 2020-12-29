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
                        <i class="fas fa-photo"></i>
                        <p>Xray Requests</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'xray')echo 'active'; ?>">
                    <a href="xray">
                        <i class="fas fa-file-text-o"></i>
                        <p>Xray</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'types')echo 'active'; ?>">
                    <a href="types">
                        <i class="fas fa-folder"></i>
                        <p>Xray Categories</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>
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
				 <li class="<?php if ($active_page == 'prescriptions')echo 'active'; ?>">
                    <a href="prescriptions">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <p>Prescriptions</p>
                    </a>
                </li>
                <li class="<?php if ($active_page == 'return_inward')echo 'active'; ?>">
                    <a href="return_inward">
                        <i class="fas fa-history"></i>
                        <p>Return Inward</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'returns_w')echo 'active'; ?>">
                    <a href="returns_w">
                        <i class="fas fa-warehouse"></i>
                        <p>Contact Warehouse</p>

                    </a>
                </li>

                <li class="<?php if ($active_page == 'category' || $active_page == 'edit_category' || $active_page == 'new_category')echo 'active'; ?>">
                    <a href="category">
                        <i class="fas fa-folder-o"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'units' || $active_page == 'edit_unit' || $active_page == 'new_unit')echo 'active'; ?>">
                    <a href="units">
                        <i class="fas fa-list"></i>
                        <p>Units</p>
                    </a>
                </li>

                 <li class="<?php if ($active_page == 'stock' || $active_page == 'edit_stock' || $active_page == 'new_stock')echo 'active'; ?>">
                    <a href="stock">
                        <i class="fas fa-boxes"></i>
                        <p>Inventory</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'de_stock' || $active_page == 'edit_stock' || $active_page == 'new_stock')echo 'active'; ?>">
                    <a href="de_stock">
                        <i class="fas fa-folder"></i>
                        <p>Damaged/Expired</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'daily_report')echo 'active'; ?>">
                    <a href="daily_report">
                        <i class="fas fa-line-chart"></i>
                        <p>Report</p>
                    </a>
                </li>

               
            </ul>
    	</div>
    </div>
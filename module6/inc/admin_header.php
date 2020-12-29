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
                        <i class="fas fa-medkit"></i>
                        <p>Pharmacy Requests</p>

                    </a>
                </li>

                <?php 
                    if ($role_id == 15 OR $role_id == 1 OR $role_id == 9) {
                        ?>
                        <li class="<?php if ($active_page == 'approvals')echo 'active'; ?>">
                    <a href="approvals">
                        <i class="fas fa-check"></i>
                        <p>Approve Requests</p>

                    </a>
                </li>
                        <?php
                    }
                    
                    ?>

                <!--<li class="<?php if ($active_page == 'returns')echo 'active'; ?>">
                    <a href="returns">
                        <i class="fas fa-money"></i>
                        <p>Returns Inwards</p>

                    </a>
                </li>-->

                <li class="<?php if ($active_page == 'category' || $active_page == 'edit_category' || $active_page == 'new_category')echo 'active'; ?>">
                    <a href="category">
                        <i class="fas fa-folder"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'units' || $active_page == 'edit_unit' || $active_page == 'new_unit')echo 'active'; ?>">
                    <a href="units">
                        <i class="fas fa-file"></i>
                        <p>Units</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'usages' || $active_page == 'edit_usages' || $active_page == 'new_usages')echo 'active'; ?>">
                    <a href="usages">
                        <i class="fas fa-file"></i>
                        <p>Usages</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'forms' || $active_page == 'edit_form' || $active_page == 'new_form')echo 'active'; ?>">
                    <a href="forms">
                        <i class="fas fa-list"></i>
                        <p>Forms</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'suppliers' || $active_page == 'edit_suppliers' || $active_page == 'new_supplier')echo 'active'; ?>">
                    <a href="suppliers">
                        <i class="fas fa-truck"></i>
                        <p>Suppliers</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'warehouse')echo 'active'; ?>">
                    <a href="warehouse">
                        <i class="fas fa-boxes"></i>
                        <p>Warehouse Stock</p>

                    </a>
                </li>
                <li class="<?php if ($active_page == 'reciept')echo 'active'; ?>">
                    <a href="reciept">
                        <i class="fas fa-archive"></i>
                        <p>Invoices</p>

                    </a>
                </li>
                 

               
            </ul>
    	</div>
    </div>
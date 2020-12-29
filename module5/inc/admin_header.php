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
				<?php if($row['role_id'] == 18 || $row['role_id'] == 1|| $row['role_id'] == 6){ ?>
                <li class="<?php if ($active_page == 'index' || $active_page == 'view_payment_details') echo 'active'; ?>">
                    <a href="index">
                        <i class="fas fa-money"></i>
                        <p>Payment</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'in_patient' || $active_page == 'process_prescription') echo 'active'; ?>">
                    <a href="in_patient">
                        <i class="fas fa-bed"></i>
                        <p>In - Patient Bill</p>
                    </a>
                </li>

                <?php }

                if ($row['role_id'] == 1 || $row['role_id'] == 6) {
                     ?>
                     <li class="<?php if ($active_page == 'cost' || $active_page == 'new_cost' || $active_page == 'edit_cost' || $active_page == 'expense' || $active_page == 'new_expense' || $active_page == 'edit_expense')echo 'active'; ?>">
                    <a href="cost">
                        <i class="fas fa-medkit"></i>
                        <p>Cost Of Drugs / Material</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'oincome' || $active_page == 'new_cost' || $active_page == 'edit_cost')echo 'active'; ?>">
                    <a href="revenue">
                        <i class="fas fa-building"></i>
                        <p>Revenue / Other Income Management</p>
                    </a>
                </li>
                
                <li class="<?php if ($active_page == 'c_balance' || $active_page == 'new_c_balance' || $active_page == 'edit_c_balance' )echo 'active'; ?>">
                    <a href="c_balance">
                        <i class="fas fa-book"></i>
                        <p>General Ledger</p>
                    </a>
                </li>
                
                <!--<li class="<?php if ($active_page == 'monthly')echo 'active'; ?>">
                    <a href="monthly">
                        <i class="fas fa-"></i>
                        <p>Monthly <br>Financial Summary</p>
                    </a>
                </li>-->

                <li class="<?php if ($active_page == 'summary1')echo 'active'; ?>">
                    <a href="summary1">
                        <i class="fas fa-file-text"></i>
                        <p>Financial Report And Summary</p>
                    </a>
                </li>

                <!--<li class="<?php if ($active_page == 'departments')echo 'active'; ?>">
                    <a href="departments">
                        <i class="fas fa-"></i>
                        <p>Department Financial Reports</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'company')echo 'active'; ?>">
                    <a href="company">
                        <i class="fas fa-"></i>
                        <p>Billings</p>
                    </a>
                </li>-->
                <li class="<?php if ($active_page == 'view_companies')echo 'active'; ?>">
                    <a href="view_companies">
                        <i class="fas fa-building-o"></i>
                        <p>Companies</p>
                    </a>
                </li>
                <li class="<?php if ($active_page == 'payroll1')echo 'active'; ?>">
                    <a href="payroll1">
                        <i class="fas fa-file-o"></i>
                        <p>Tax, Payroll <br>And Charges</p>
                    </a>
                </li>

                 <li class="<?php if ($active_page == 'statements1' || $active_page == 'statements' || $active_page == '$statement' || $active_page == 'dashboard')echo 'active'; ?>">
                    <a href="statements1">
                        <i class="fas fa-line-chart"></i>
                        <p>Statements</p>
                    </a>
                </li>
                     <?php
                 } ?>
				
            </ul>
    	</div>
    </div>
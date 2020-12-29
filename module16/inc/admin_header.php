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
				 <li class="<?php if ($active_page == 'pos')echo 'active'; ?>">
                    <a href="pos">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Point Of Sales</p>

                    </a>
                </li>

                <li class="<?php if ($active_page == 'returns')echo 'active'; ?>">
                    <a href="returns">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Returns Inwards</p>

                    </a>
                </li>

                 <li class="<?php if ($active_page == 'stock' || $active_page == 'edit_stock' || $active_page == 'new_stock')echo 'active'; ?>">
                    <a href="stock">
                        <i class="fas fa-building"></i>
                        <p>Inventory</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'units' || $active_page == 'edit_unit' || $active_page == 'new_unit')echo 'active'; ?>">
                    <a href="units">
                        <i class="fas fa-list-alt"></i>
                        <p>Units</p>
                    </a>
                </li>

               
            </ul>
    	</div>
    </div>
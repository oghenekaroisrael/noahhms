 <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
					
					 <a href="index" class="simple-text hideLogo">                
						<img src="../assets/images/logo.png" alt=" <?php echo $site_name; ?>" />
					</a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-left">
					
					</ul>
                    <ul class="nav navbar-nav navbar-right">

                        
                       
                        <li class="dropdown">
                           <a href="#" id="notification-bell" class="dropdown-toggle" id="notif" data-toggle="dropdown">
                            <span class="label label-pill label-danger count" style="border-radius: 10px;"></span>
                            <span class="fas fa-bell" style="font-size: 18px; "></span>
                            </a>
                            <ul class="dropdown-menu notif2" style="max-height: 200px;width: 300px; overflow-y: scroll;"></ul>
                        </li>
						
                       <li>
                           <a href="logout"> 
                               <p>Logout</p>
                            </a>
                        </li>
                       
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <script src="../assets/js/push.min.js"></script>
        <script>

            var a=jQuery .noConflict();
                a(function () {
              });
            a(document).ready(function () {
                var num = 0;
                function load_unseen(view = '') {
                    var id = '<?php echo $user_id; ?>';
                    var all ='account';
                    a.ajax({
                        url: '../noti.php',
                        method: 'POST',
                        data: {view:view,id:id,all:all},
                        dataType: 'json',
                        success: function (data) {
                            a('.notif2').html(data.notification);
                            if (data.unseen_notification > 0) {
                                a('.count').html(data.unseen_notification);
                            }
                        }
                    })
                }

                function strike(view) {
                    a.ajax({
                        url: '../strike.php',
                        method: 'POST',
                        data: {view:view},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                        }
                    })
                }

                function pushNot(view = '') {
                    var id = "<?php echo $user_id; ?>";
                    var all ='account';
                    a.ajax({
                        url: '../strike.php',
                        method: 'POST',
                        data: {view:view,id:id,all:all},
                        dataType: 'json',
                        success: function (res) {
                            if (res.count > 0) {
                        Push.create(res.msg,{
                        body:res.patient,
                        timeout:10000,
                        onClick:function () {
                            window.location = res.link;
                            this.close();
                        },onShow:function (){
                            var audio = new Audio("../ping/ping.mp3");
                            audio.play();
                            strike(res.id);
                        }
                    });
                        num += 1;
                    }
                        }
                    })
                }
               
                load_unseen(); 
                a(document).on('click','notif',function () {
                    a('.count').html('');
                    load_unseen("yes");
                })
                setInterval(function(){
                    load_unseen();
                    if (num < 1) {
                        pushNot();
                    }
                },5000);
            });
        </script>
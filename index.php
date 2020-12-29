<?php
	ob_start();
	session_start();
	$pageTitle="Hospital Management Software";
	$pageDes="";
	// Include database class
	include 'inc/db.php';
	include_once 'inc/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="row">
        <div class="col-md-7" style="background-image: url('img/nav-bg.png');background-repeat: no-repeat;background-size: 100% 100%; height: 100vh;">
                        
        </div>
        <div class="col-md-5">
            <div class="container-login100">
        <div class="wrap-login100 p-b-160 p-t-50">
            <form class="validate-form" id="login">
                <?php
                $db =  mysqli_connect("localhost","root","","noahhms");
                $info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
                $get_hospital_info = mysqli_fetch_assoc($info);
                $name = $get_hospital_info['name'];
                mysqli_query("DELETE FROM `notifications` WHERE `status` = 1");
                ?>
                    <div class="header" style="position: relative;top: -70px;left: 35%;">
                        <h2 class="title text-white">
                            <img src="assets/images/logo_front.png" class="img-responsive" alt="NOAH HMS" width="200">
                            Staff Login
                        </h2>
                    </div>

                <div class="form-group validate-input" data-validate = "Enter username">
                    <input class="form-control" type="text" required autocomplete="off" name="username" placeholder="Username">
                </div>

                <div class="form-group validate-input" data-validate="Enter password">
                    <input class="form-control" id="pass" required autocomplete="off" type="password" name="password" placeholder="Password">
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="clearTwenty"></div>
                <div id="get_result"></div>
                <div class="loader" id="load" style="display:none "></div>
            </form>
        </div>
    </div>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>


<script type="text/javascript">
    var a=jQuery .noConflict();
    a(function () {
        a('#login').on('submit', function (e) {
            e.preventDefault();

            var email = a("#username").val();
            var password = a("#pass").val();
            if(email === ""){

                a('#get_result').html("<div class='alert alert-danger'>Username must not be empty</div>").show();
            } else if (password === ""){

                a('#get_result').html("<div class='alert alert-danger'>Password must not be empty</div>").show();
            } else{
                document.getElementById("load").style.display = "block";
                a.ajax({
                    type: 'post',
                    url: 'func/verify.php',
                    data: a('#login').serialize() + '&ins=login',
                    dataType: "json",
                    success: function(response)
                    {
                        document.getElementById("load").style.display = "none";
                        if (response.value === 'emptyUsername') {
                            console.log(response);
                            jQuery('#get_result').html("<div class='alert alert-danger'>Username must not be empty</div>").show();
                        }else if (response.value === 'emptyPass') {
                            console.log(response);
                            jQuery('#get_result').html("<div class='alert alert-danger'>Password must not be empty</div>").show();
                        }else if (response.value === 'no') {
                            console.log(response);
                            jQuery('#get_result').html("<div class='alert alert-danger'>Username does not exist</div>").show();
                        }else if (response.value === 'Login') {
                            console.log(response);
                            jQuery('#get_result').html("<div class='alert alert-success'>Redirecting you</div>").show();
                            window.location = response.page;
                        }else {
                            jQuery('#get_result').html(response.value2).show();
                            console.log(response);
                        }
                    }
                });
            }

        });
    });
</script>
</body>
</html>



<?php
	ob_start();
	session_start();
	$pageTitle="Login";
	$pageDes="Login to your account to start enjoying the amazing features of our website.";
	// Include database class
	include 'inc/db.php';
	include_once 'inc/header.php';
?>
<?php include_once 'inc/nav.php'; //for addding header ?>
<img class="decorationtop" src="assets/images/decup.png" />
<div id="reg" >		
		<div class="regedForm">
			<h4>Login</h4>
			<div class="clearTwenty"></div>
			<form  id="login">
						<input type="text" id="emaill" name="email" placeholder="Enter your email" required autocomplete="off" />
						<input type="password" id="pass" name="password" placeholder="Password" required autocomplete="off" />
						<div class="clear"></div>
						<input class="submit" type="submit" name="submit" value="Submit"/>				
					</form>
			<a href="forgot">Forgot Password</a> 
			<div class="clearTwenty"></div>
			<div id="get_result"></div>	
			<div class="loader" id="load" style="display:none "></div>	
		</div>
			
		
</div>
<img class="decorationtop" src="assets/images/decdown.png" />



<script type="text/javascript">
	var a=jQuery .noConflict();
	a(function () {
		a('#login').on('submit', function (e) {
			e.preventDefault();
			 
			var email = a("#emaill").val();
			var password = a("#pass").val();
			if(email === ""){
				
				a('#get_result').html("<div class='alert alert-danger'>Email must not be empty</div>").show();
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
						if (response.value === 'emptyEmail') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-danger'>Email must not be empty</div>").show();
						} else if (response.value === 'emptyPass') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-danger'>Password must not be empty</div>").show();
						} else if (response.value === 'no') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-danger'>Email does not exist</div>").show();
						}else if (response.value === 'Login') {
							console.log(response);
							jQuery('#get_result').html("<div class='alert alert-success'>Redirecting you</div>").show();
							window.location = 'members/index.php';
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
<?php include_once 'inc/footer.php'; //for addding header?>
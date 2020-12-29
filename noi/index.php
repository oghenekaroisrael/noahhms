<?php
extract($_REQUEST);
include('db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Facebook Notification Box display with sound effect</title>

<style>

body{ font-family:Tahoma, Geneva, sans-serif; color:#000; font-size:11px;  margin:0; padding:0;}

#info{ position:fixed; width:100%; height:20px;-webkit-box-shadow: 0 1px 2px #666;box-shadow: 0 1px 2px #666; top:0; padding:10px; background-color:#F60; color:#FFF; font-size:14px;}

.lessoncup{ width:300px;height:200px;margin:0 auto;margin-top:100px; margin-bottom:100px;}

.box{border:solid #09C 1px; border-radius:5px; padding:5px; resize:none; width:290px; height:100px; outline:none;}

.btn{padding:10px; border:0; margin:5px 0 0 0; background-color:#09C; color:#FFF;cursor:pointer; float:left; margin-right:5px;}

li{margin:0; padding:0; list-style:none; cursor:pointer;}

#alerts:hover{background-color:#C6D3EC;}

#loader{margin:10px;}

#alerts{ margin:5px;padding:4px; border:solid #9dabc9 1px; width:250px; height:80px;border-radius:5px; background-color:#e2e7ee}

#alertbox{position:fixed;width:250px; height:auto; left:100px; bottom:10px;}

</style>


<script type="text/javascript" src="jquery-1.10.2.min.js"></script>

<script>

$(document).ready(function(){
	
	
	$('#btn').click(function(){
		
		var post = $('#box').val();
		
		if(post==""){
			
			alert('enter please');
			
			
		}else{
		
		$('#loader').fadeIn(400).html('<img src="loader.gif" align="absmiddle">&nbsp;<span class="loading">sending</span>');
		
		var datasend = "alert="+post;
		
		$.ajax({
			
			type:'POST',
			url:'alerts.php',
			data:datasend,
			cache:false,
			success:function(msg){
				
				$('#box').val('');
				$('#loader').hide();
				$('#alertbox').fadeIn('slow').prepend(msg);
				
				$('#alerts').delay(5000).fadeOut('slow');
				
			}
			
		});
		
		}
		
	})
					
});


</script>

</head>

<body>



<div class="lessoncup">

<textarea id="box" class="box"></textarea>


<input value="POST" id="btn" class="btn" type="button" />

<div id="loader"></div>

</div>

<div id="alertbox">

</div>

</body>
</html>
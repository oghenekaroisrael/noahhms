<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head profile="http://gmpg.org/xfn/11">
		<meta name="robots" content="noindex, nofollow">
		<?php $site_name = Database::getInstance()->select_url('site_name'); ?>
		<title><?php echo $site_name;?> - <?php echo $pageTitle; ?></title>
		<meta http-equiv="description" content="invoice" />
		
		<?php $site_url = Database::getInstance()->select_url('site_url'); ?>
		<?php 
			$active_page = basename($_SERVER['PHP_SELF'], ".php");
		?>
		<script type="text/javascript" src="assets/js/jquery-3.1.0.min.js"></script>
		<link href='assets/css/jquery.fancybox.min.css' type='text/css' rel='stylesheet'/>
		<link href='assets/css/style.css' type='text/css' rel='stylesheet'/>
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href='assets/css/bootstrap.min.css' type='text/css' rel='stylesheet'/>
		
		<script src="assets/js/jquery.fancybox.min.js"></script>	
		<script src="assets/js/modernizr.custom.js"></script>
		<script src="assets/js/classie.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		
		<script type="text/javascript">
			var l=jQuery .noConflict();
			l(window).on('load',function(){
				l('#myModal').modal('show');
			});
		</script>

	</head>

<body>
	
	
		
<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head profile="http://gmpg.org/xfn/11">
		<meta name="robots" content="noindex, nofollow">
		<?php 
			include_once '../inc/db.php';
			$site = Database::getInstance()->select('site_url'); 
			foreach($site as  $row):
				$site_name = $row['site_name'];
				$site_url = $row['site_url'];
			endforeach;
		?>
		<title><?php echo $site_name;?> - <?php echo $pageTitle; ?></title>
		<meta http-equiv="description" content="invoice" />
		
		<script type="text/javascript" src="../assets/js/jquery-3.1.0.min.js"></script>
		<link href='../assets/css/jquery.fancybox.min.css' type='text/css' rel='stylesheet'/>
		
		<link href='../assets/css/style.css?v=123' type='text/css' rel='stylesheet'/>
		
		<link href='../assets/css/bootstrap.min.css' type='text/css' rel='stylesheet'/>
		<link href='../assets/css/main_style.css' type='text/css' rel='stylesheet'/>
		<link href="../assets/font-awesome/css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/scrollbars/jquery.mCustomScrollbar.css" />
		
		<link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
		<link href="../assets/css/animate.min.css" rel="stylesheet"/>
		<link href="../assets/css/elegant-icons-style.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/entypo.css">
		<link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

		<script src="../assets/js/bootstrap.min.js"></script>			
		<script src="../assets/js/jquery.fancybox.min.js"></script>	
		<script src="../assets/js/modernizr.custom.js"></script>
		<script src="../assets/js/classie.js"></script>
		<script src="../assets/js/push.min.js"></script>
		<script src="../assets/tinymce/tinymce.min.js"></script>

	</head>
	
	<body class="indexWrap cbp-spmenu-push">
	<?php
		if(!isset($_SESSION['userSession'])){
			header("Location: ../index");
			exit;
		} elseif (isset($_SESSION['userSession'])){
			$user_id = $_SESSION['userSession'];
			if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
		}
	?>
<?php
	session_start();
	require('database.inc.php');
	require('function.inc.php');
	
	if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_USERNAME']!=''){
	
	}else{
		header('Location:login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('links/links.php');?>
  <title>Voters</title>
    <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="style.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <script src="sweetalert2.all.min.js"></script>
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  
</head>
<body class="sidebar-light">
<div class="container-scroller">

	<div class="col-md-12 nav justify-content-end banner" style="background-color:black; height:40px">
		<ul class="nav justify-content-end">
			<li class="nav-item">
				<a class="nav-link active" href="#">Hi !!! <?php echo $_SESSION['USER_NAME']?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php">Logout</a>
			</li>
		</ul>
	</div>
    

     
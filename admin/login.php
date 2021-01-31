<?php 
	session_start();
	include("database.inc.php");
	include("function.inc.php");
	
	$msg = "";
	if(isset($_REQUEST['submit'])){
		$email = get_safe_value($_REQUEST['email']);
		$password = get_safe_value($_REQUEST['password']);
		
		$sql = "select * from admin where email='$email' and password='$password' ";
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$row = mysqli_fetch_assoc($res);
			$_SESSION['ADMIN_LOGIN'] = 'yes';
			$_SESSION['ADMIN_ID'] = $row['id'];
			$_SESSION['ADMIN_USERNAME'] = $email;
			//$_SESSION['USER_NAME'] = ''
			redirect('admin.php');
			die();
		}else{
			$msg = "Please enter valid login details";
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Vote App</title>
</head>
<body>
	<div class="container">
		<h1 class="text-capitalize text-light text-center mt">welcome to online voting portal</h1>
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3>Sign In</h3>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="email" class="form-control" placeholder="Email">
							
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="password">
						</div>
						<!--<div class="row align-items-center remember">
							<input type="checkbox">Remember Me
						</div>-->
						<div class="form-group">
							<input type="submit" name="submit" value="Login" class="btn btn-block float-right login_btn">
						</div>
					</form>
					<div class="text-danger text-capitalize" style="margin-top: 13px; margin-bottom: -20px"><?php echo $msg ?></div>
			</div>
</body>
</html>
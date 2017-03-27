<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Sign in - Progressus Bootstrap template</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="ss/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<?php include 'includes/header.php';?>

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">User access</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Sign in</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Sign in to your account</h3>
							<p class="text-center text-muted">If you are a new user then,<a href="signup.html">Register</a> and try to login.</p>
							<hr>
							
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	require 'includes/mysqli_connect.php';
	if(!empty($_POST['email'])){
		$e=mysqli_real_escape_string($dbcon,$_POST['email']);
	}else{
		$e=false;
		echo '<p class="text-danger">You forgot to enter your email address</p>';
	}
	
	if(!empty($_POST['psword'])){
		$p=mysqli_real_escape_string($dbcon,$_POST['psword']);
	}else{
		$p=false;
		echo '<p class="text-danger">You forgot to enter your password</p>';
	}
	if($e && $p){
		$q="select id, username, role from user where (email='$e' && password=SHA1('$p'))";
		$result=mysqli_query($dbcon,$q);
		if(mysqli_num_rows($result) == 1){
			session_start();
			$_SESSION=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$_SESSION['role']=(int)$_SESSION['role'];
			header('location:index.php');
			exit();
			mysqli_free_close($result);
			mysqli_close($dbcon);
		}else{
			echo '<p class="text-danger">The Email ID and  Password does not match,Try Again.';
		}
	}else{
		echo '<p class="text-danger">Please Try Again!';
	}
	mysqli_close($dbcon);
}
?>							
							
							
							
							
							<form action="login.php" method="post">
								<div class="top-margin">
									<label>Email ID <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="email">
								</div>
								<div class="top-margin">
									<label>Password <span class="text-danger">*</span></label>
									<input type="password" class="form-control" name="psword">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="forgot_password.php">Forgot password?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">Sign in</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	<?php include 'includes/footer.php';?>
	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>
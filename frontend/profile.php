<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Sign up - Progressus Bootstrap template</title>

	<link rel="shortcut icon" href="images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="css/bootstrap-theme.css" media="screen" >
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
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Profile</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Change the password!</h3>
							<p class="text-center text-muted">Secure your account by changing your passsword regularly. </p>
							<hr>
							
<?php 
session_start();
if (!isset($_SESSION['role'])){
header('location:login.php');
exit();
}//else echo $_SESSION['id'];
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(empty($_POST['psword1'])){
		$errors[]="please enter a valid password";
	}
	if(!preg_match('/^\w{8,12}$/',$_POST['psword1'])){
		$errors[]="Invalid password,use 8 to 12 characters and no space";
	}else{
		$p=$_POST['psword1'];
	
		if($_POST['psword1']==$_POST['psword2']){
			$p=mysqli_real_escape_string($dbcon,trim($p));
		}else{
			$errors[]="Your passwords do not match";
		}
	}
	
	if (empty($errors)){
		$id=$_SESSION['id'];
		$q="update user set password='$p' where id='$id' limit 1";
		$result=@mysqli_query($dbcon,$q);
		if($result){
			echo'<div class="top-margin"><h2>Updated Successfully</h2>
			<h2>Thank You</h2></div>.';
		}else{
			echo'<h2>System Error</h2>
			<p class=""error">Your password cant be changed due to an system error.</p>';
			echo'</p>'.mysqli_error($dbcon).'<br><br>Query:'.$q.'</p>';
		}
		mysqli_close($dbcon);
		include('includes/footer.php');
		exit();
	}
	else{
		echo'<div class="top-margin"><h2>Error!</h2>
				<p class="error">The Foolowing error has occured:<br>';
		foreach ($errors as $msg){
			echo"-$msg<br>\n</div>";
		}
	}
}
	

							
							?>

							<form action="profile.php" method="post">
								
								</div>
								<div class="top-margin">
									<label>New Password</label>
									<input type="password" class="form-control" name="psword1">
								</div>
								<div class="top-margin">
									<label>Confirm New Password</label>
									<input type="password" class="form-control" name="psword2">
								</div>

								

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											I've read the <a href="page_terms.html">Terms and Conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">Register</button>
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
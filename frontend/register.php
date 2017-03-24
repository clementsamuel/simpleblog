
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Registration-Simple Blog</title>

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


	<!-- Fixed navbar -->
<!-- 	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
<!-- 				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="sidebar-left.html">Left Sidebar</a></li>
							<li><a href="sidebar-right.html">Right Sidebar</a></li>
						</ul>
					</li>-->
<!-- 					<li><a href="contact.php">Contact</a></li>
					<li class="active"><a class="btn" href="login.php">SIGN IN / SIGN UP</a></li>
				</ul>
			</div><!--/.nav-collapse -->
<!-- 		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Registration</h1>
				</header>
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Registering a new account</h3>
							<p class="text-center text-muted">If already a user, Please <a href="signin.html">Login</a>.</p>
							<hr>							

<?php 
require 'includes/mysqli_connect.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$errors=array();
	
	$uname=trim($_POST['uname']);
	$stripped=mysqli_real_escape_string($dbcon,strip_tags($uname));
	$strlen=mb_strlen($stripped,'utf-8');
	if($strlen<1)
	{
		$errors[]='you forgot to enter your first name.';
	}else{
		$uname=$stripped;
	}
	
	$email=false;
	if(empty($_POST['email'])){
		$errrors[]="You forgot to enter the Email Address";
	}
	if(filter_var((trim($_POST['email'])),FILTER_VALIDATE_EMAIL)){
		$e=mysqli_real_escape_string($dbcon,(trim($_POST['email'])));
	}else{
		$errors[]="your email is not in the correct format";
	}
	
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
	$url=trim($_POST['imgurl']);
	$stripped=mysqli_real_escape_string($dbcon,strip_tags($url));
	$strlen=mb_strlen($stripped,'utf-8');
	if($strlen<1)
	{
		$errors[]='you forgot to enter the URL of your profile picture.';
	}else{
		$url=$stripped;
	}
	
	if (empty($errors)){
		$role=2;
		$q="insert into user(id,username,email,password,role,profile_image,created_at) values(' ','$uname','$e',SHA1('$p'),'$role','$url',NOW() )";
		$result=@mysqli_query($dbcon,$q);
		if($result){
			echo'<div class="top-margin"><h2>Registered Successfully</h2>
			<h2>Thank You</h2></div>.';
		}else{
			echo'<h2>System Error</h2>
			<p class=""error">You cant be registered due to an system error.</p>';
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
	

include 'includes/header.php';
?>
							<form action="register.php" method="post">
								<div class="top-margin">
									<label>User Name</label>
									<input type="text" class="form-control" name="uname">
								</div>
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="email">
								</div>

								<div class="row top-margin">
									<div class="col-sm-6">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="psword1">
									</div>
									<div class="col-sm-6">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="psword2">
									</div>
								</div>
								<div class="top margin">
									<label>Profile Picture</label>
									<input type="text" class="form-control" name="imgurl">
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
	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+918553386839<br>
								<a href="mailto:#">clement290695@gmail.com</a><br>
								<br>
								19, kothanur, Bangalore 560 077
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons clearfix">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Text widget</h3>
						<div class="widget-body">
							<p>the simple blog</p>
							<p>Registration of any new user and the profile picture is uploaded by pasting the url of the image.</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> 
								<a href="about.html">About</a>
								<a href="contact.html">Contact</a> 
								<b><a href="signup.html">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2014, Clement. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>	
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>
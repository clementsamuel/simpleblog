<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Forgot passowrd-Simple Blog</title>

	<link rel="shortcut icon" href="images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<script type="text/javascript">
	function checkForm(){
	var x = document.forms["myForm"]["email"].value;
	if (x==null || x=="") {
	    alert("Enter the registered email address");
	    return false;
	}
	}
	</script>

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
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					</li>
					<li><a href="contact.html">Contact</a></li>
									</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">User access</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Forgot your Password?</h1>
				</header>
				
 			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Password Retrieval.</h3>
							<p class="text-center text-muted">Enter the registerd email ID and the password will be sent to that email,Access that email to <a href="login.php">Login</a>.</p>
							<hr>

<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	require 'includes/mysqli_connect.php';
	$id=false;
	if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$email=$_POST['email'];
		$q='select id from user where email="'.mysqli_real_escape_string($dbcon,$_POST['email']).'"';
		$result=mysqli_query($dbcon,$q) or trigger_error("query:$q\n<br> MySQL Error:".mysqli_error($dbcon));
		if(mysqli_num_rows($result)==1){
			$row=mysqli_fetch_array($result,MYSQLI_NUM);
			$id=$row[0];
		}else{
			echo '<p class="text-danger">That Email Address is not registered</p>';
		}
	}if ($id){
		$p=substr(md5(uniqid(rand(),true)), 5, 10);
		$q="update user set password=SHA1('$p') where id=$id limit 1";
		$result=mysqli_query($dbcon,$q) or trigger_error("query:$q\n<br> MySQL Error:".mysqli_error($dbcon));
		if(@mysqli_affected_rows($dbcon) == 1){
			$body="Your Password has been changed to '$p'. Please login as soon as possible using the new password.Then change the password immediately.";
			//include 'includes/swiftmailer.php';
			echo'<h3>Your password has been changed.You will shortly receive the email.</h3>';
			mysqli_close($dbcon);
			include 'includes/footer.php';
			exit();
		}else{
			echo'<p class="text-danger">There was an system error,your password could not be changed.we apologize your inconvenience.</p>';
		}
	}
		mysqli_close($dbcon);
}
?>

							
							<form action="forgot_password.php" method="post" id="myForm" onsubmit="return checkForm()";>
								<div class="top-margin">
									<label>Email <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="email">
								</div>
								

								<hr>

					
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
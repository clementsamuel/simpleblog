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

	<script type="text/javascript" src="js/validation.js"></script>

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
					<h1 class="page-title">Registration</h1>
				</header>
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Registering a new account</h3>
							<p class="text-center text-muted">If already a user, Please <a href="login.php">Login</a>.</p>
							<hr>							

<?php require 'includes/mysqli_connect.php';
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
	
	$name=$_FILES['imgurl']['name'];
	$tmp_name=$_FILES['imgurl']['tmp_name'];
	if(isset($name)){
		if(!empty($name)){
			$location="images/";
			$allowed=array("imagepjepg","image/jpeg","image/png","image/gif","image/x-png","image/jpg");
			if(in_array($_FILES['imgurl']['type'],$allowed)){
				if(move_uploaded_file($tmp_name,$location.$name)){
			  // echo'uploaded successfully';
			}else{
				echo"file not uploaded";
		}
			}else{
				echo'<p class="text-danger">Not an image file</p>';
			}
		}else{
			echo'<p class="text-danger">file empty</p>';
		}
		}else{
			echo'<p class="text-danger">file not choosen</p>';
		}
	
	
	
	
	if (empty($errors)){
		$role=2;
		$url='images/'.$name;
		$q="insert into user(username,email,password,role,profile_image,created_at,updated_at) values('$uname','$e',SHA1('$p'),'$role','$url',NOW(),NOW())";
		$result=@mysqli_query($dbcon,$q);
		if($result){
			echo'<div class="top-margin"><h2>Registered Successfully</h2>
			<h2>Thank You</h2></div>';
			//goto gate;
		}else{
			echo'<h2>System Error</h2>
			<p class="text-danger">You cant be registered due to an system error.</p>';
			echo'</p>'.mysqli_error($dbcon).'<br><br>Query:'.$q.'</p>';
		}
		mysqli_close($dbcon);
		include('includes/footer.php');
		exit();
		}
	else{
		echo'<div class="top-margin"><h2>Error!</h2>
				<p class="text-danger">The Following error has occured:<br>';
				foreach ($errors as $msg){
					echo"-$msg<br>\n";
				}
				echo '</div></p><h3>Please Try again</h3>';
	}
}
?>
							<form action="register.php" id="myForm" method="POST" enctype="multipart/form-data" onsubmit="return checkForm()";>
								<div class="top-margin">
									<label>User Name</label>
									<input type="text" class="form-control"  name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname'];?>">
								</div>
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="email"  value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
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
									<input type="file" class="form-control" name="imgurl"  value="<?php if (isset($_POST['imgurl'])) echo $_POST['imgurl'];?>">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox" name="terms"> 
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
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<script src="js/template.js"></script>
</body>
</html>
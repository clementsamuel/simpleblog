<?php
session_start();
if (!isset($_SESSION['id']))
{  header("Location: login.php");
   exit();
}?>
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
			<li class="active">New blog</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">New Blog</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Add a new Blog</h3>
							<p class="text-center text-muted"></p>
							<hr>
<?php require 'includes/mysqli_connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
	$errors=array();
	if (empty($_POST['title'])){
		$title="untitled";
	}else{
		$title=$_POST['title'];
	}
	$url=trim($_POST['img']);
	$stripped=mysqli_real_escape_string($dbcon,strip_tags($url));
	$strlen=mb_strlen($stripped,'utf-8');
	if($strlen<1)
	{
		$errors[]='you forgot to enter the URL of your blog picture.';
	}else{
		$url=$stripped;
	}
	$content=trim($_POST['content']);
	$stripped=mysqli_real_escape_string($dbcon,strip_tags($content));
	$strlen=mb_strlen($stripped,'utf-8');
	if($strlen<1)
	{
		$errors[]='you forgot to enter the URL of your profile picture.';
	}else{
		$content=$stripped;
	}
	if (empty($errors)){
		$userid=$_SESSION['id'];
		$q="insert into post(id,user_id,title,content,blog_image,created_at) values(' ','$userid','$title','$content','$url',NOW() )";
		$result=mysqli_query($dbcon,$q);
		if($result){
			echo'<div class="top-margin"><h2>New Blog is added successfully</h2>
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
?>
							<form action="add_page.php" method="post" id="form1">
								<div class="top-margin">
									<label>Title</label>
									<input type="text" class="form-control" name="title">
								</div>
								<div class="top-margin">
									<label>Content</label>
									<textarea name="content" form="form1"  rows="4" cols="50" class="form-control" name="content">contents..</textarea>
								</div>
								<div class="top-margin">
									<label>Blog Image</label>
									<input type="text" class="form-control" name="img">
								</div>

								

								<hr>

								<div class="row">
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">Submit</button>
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
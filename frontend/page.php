<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>About - Progressus Bootstrap template</title>

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
<?php include 'includes/header.php'; ?>

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">About</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">About us</h1>
				</header>
				<?php     
				require 'includes/mysqli_connect.php';
				if (isset($_GET['id']) && is_numeric($_GET['id'])){
				$id=$_GET['id'];	
				}else{
					echo'<p clas="text-danger">This pages has been accessed in error.</p>';
				
				}
				$q='select id, title, content, DATE_FORMAT(created_at,"%e %M %Y") as date from post where id='.$id.' limit 1';
				$result=mysqli_query($dbcon,$q);
				if(mysqli_num_rows($result) == 1){
						$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
						echo'<h3>'.$row["title"].'</h3>';
						echo'<p>'.$row["content"].'</p>';
						echo'<p>'.$row["date"].'</p>';
						}
						?>	
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
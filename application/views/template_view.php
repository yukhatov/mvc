<html >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container" id="wrapper">
			<div id="header">
				<nav class="navbar navbar-inverse">
					<div id="menu">
						<ul>
							<a href="index.php?route=admin/index"><button type="button" class="btn btn-default navbar-btn" >Admin Panel</button></a>
							<a href="index.php?route=feedback/index"><button type="button" class="btn btn-default navbar-btn" >Home</button></a>
						</ul>
					</div>
				</nav>
			</div>
			<div id="page">
				<div id="content">
					<div class="box">
						<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			<div id="footer">
				<a href="#">Artur Yukhatov</a> &copy; 2016</a>
			</div>
		</div>

	</body>
</html>
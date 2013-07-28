<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP MVC Oders</title>
</head>
	<body>

	<?php echo $data['header'];?>
		<h1>Welcome to Our Website!</h1>
		<hr/>
		<h2>Orders</h2>
		<h4><?php echo $data['orders']['id'];?></h4>
		<p><?php echo $data['orders']['vn_id'];?></p>

    <?php echo $data['footer'];?>

	</body>
</html>

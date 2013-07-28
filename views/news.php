<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP MVC</title>
</head>
	<body>

	<?php echo $data['header'];?>
		<h1>Welcome to Our Website!</h1>
		<hr/>
		<h2>News</h2>
		<h4><?php echo $data['article']['title'];?></h4>
		<p><?php echo $data['article']['description'];?></p>

    <?php echo $data['footer'];?>

	</body>
</html>

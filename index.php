<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('client_ID', '9fef050485a24a29b5b58022c04b2257');
define('client_Secret', '7d72e590ed0e42a1b1a3f29e73627e38');
define('redirectURL', 'http://localhost:/Kenneth/index.php');
define('ImageDirectory', 'pics/');
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" contents="">
		<meta name="viewport" content="width=device=width, intial=scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="humans.txt">
	</head>
	<body>
		<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
		After getting approval we are now going to have the informationso that we can play with it.
		 -->
		<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo client_ID; ?>&redirect_url=<?php echo redirectURL?>&response_type=code">LOGIN</a>
		<script type="js/main.js"></script>
	</body>	
</html
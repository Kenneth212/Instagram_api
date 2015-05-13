<?php

//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);

session_start();

//Make Constant using define.
define('clientID', '49d565177a2f408a9988bdee6220cc46');
define('clientSecret', 'c793f86523d441219037400b93598a54');
define('redirectURI', 'http://localhost/Kenneth/index.php');
define('ImageDirectory', 'pics/');


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a>
	
</body>
</html>

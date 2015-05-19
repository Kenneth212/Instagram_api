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


//Function that is going to connect to Instagram.

function connectToInstagram($url)
{
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2

		));

	$result  = curl_exec($ch);
	curl_close($ch);
	return $result;
}

//Function to get userID because userName doesn't allow to get pictures.
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q=\"kennethprado\"&client_id=' .clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data']['0']['id'];
}

//Function to print out images onto screen
function printImages($userID)
{
	echo'<head>
		<link rel="stylesheet" href="css/instagram.css">
		</head>';
	$url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent?client_id='.clientID . '&count=5';

	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	//Parse through thet information one by one
	foreach($results['data'] as $items)
	 {
	 	$image_url = $items['images']['low_resolution']['url']; //go through all of the results and give back the url of those pictures because we want to save it in the php server.
	 	echo '<img src=" '. $image_url .' "/><br/>';
	 }
}
	// function to save images to server 
	function savePictures($image_url){
		echo'<head>
		<link rel="stylesheet" href="css/stylesheet.css">
		</head>';

		echo'<body id="body-class">';
		return 'div id=image">' .$image_url . '<br></div>';
		//echo $image_url .'<br>';
		$filename = basename($image_url);// the filename is what we are storing. Basename is the PHP bult in the method that we ere using to store $image_url
		//echo $filename . '<br>';
		echo '</body>';
		
		// making sure that the image doesnt exist in the storage
		$destination = ImageDirectory . $filename;
		// goes and grabs an imagefile and stores it into our server 
		file_put_contents($destination, file_get_contents($image_url));
	}




if (isset($_GET['code'])) {
	$code = $_GET['code'];
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings =  array('client_id' => clientID,
								   'client_secret' => clientSecret,
								   'grant_type' => 'authorization_code',
								   'redirect_uri' => redirectURI,
								   'code' => $code);

								  
//Curl is a library that lets you make HTTP requests($_GET[] or $_POST[]) in PHP.
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
}
else{
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<title></title>
</head>
<body>

    <!-- Creating a login for people to go and give approval for our web app to access their Instagram account 
	After getting approval we are now going to have the information so that we can play with it.
    -->
	<div class="container"> 
	<div class="row">
		<div id="title" class="SOMETHING col-xs-5">
		<h1>
		<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a></h1>
		<p>
			

		</p>
		</div>
		<div id="title" class=" HERRO col-xs-5">
			<h1>FIVE LETTER WORD FOR INITIALIZE</h1>
		</div>
	
</body>
</html>
<?php

}
?>



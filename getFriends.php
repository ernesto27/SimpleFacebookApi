<?php 
	require_once "config.php";
	require_once "src/SimpleFacebookApi.php";
  	$facebook = new SimpleFacebookApi(APPID, SECRECTKEY);


  	if($facebook->isLogin()){
  		$friends = $facebook->getFriends();
  		echo "<pre>";
  		var_dump($friends);
  		echo "</pre>";

  	}

?>
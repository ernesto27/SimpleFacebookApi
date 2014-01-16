<?php 

  require_once "config.php";
  require_once "src/SimpleFacebookApi.php";
  $facebook = new SimpleFacebookApi(APPID, SECRECTKEY);


  if($facebook->isLogin()){
    echo $facebook->getFullName();
    echo "<br>";
    echo $facebook->getAvatar();
  }else{

    echo $facebook->getLoginUrl();
  }


  

?>




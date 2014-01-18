SimpleFacebookApi
=================
work in progress...

Class for use the facebook api in a simple and easy way


DEMO 
http://simplefacebookapi.ap01.aws.af.cm/


## Installation

Include the facebook simple class 

`````php 
require_once "src/SimpleFacebookApi.php"; 
`````

## Usage

instanciate class with your app and secret key of your facebook app

`````php 
$facebook = new SimpleFacebookApi("yourappid", "yoursecretid");
`````

### set permissios app
You can pass a string for get your custom permissions or empty value for basic user date

https://developers.facebook.com/docs/reference/login/
`````php 
  $facebook->setPermissions("email","read_friendlists");
  echo $facebook->getLoginUrl();
`````

### get profile user
`````php 
if($facebook->isLogin()){
  echo $facebook->getFullName();
  echo "<br>";
  echo $facebook->getAvatar();
}else{
  $facebook->setPermissions("email");
  echo $facebook->getLoginUrl();
}
`````

### get user list

`````php 
if($facebook->isLogin()){
  $friends = $facebook->getFriends();
  echo "<pre>";
  var_dump($friends);
  echo "</pre>";
}
`````

### upload a photo
`````php 
if(isset($_FILES["photo"])){
  if($facebook->isLogin()){
	  $photo = $_FILES["photo"];
	  print_r($facebook->uploadPhoto($photo));
	 }
}
`````







<?php 
	require_once "config.php";
    require_once "src/SimpleFacebookApi.php";
    
    $facebook = new SimpleFacebookApi(APPID, SECRECTKEY);
  
    if(isset($_FILES["photo"])){
    	if($facebook->isLogin()){
	        $photo = $_FILES["photo"];
	        print_r($facebook->uploadPhoto($photo));
	    }
    }
?>


<html>
<head>
	<title></title>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Upload photo to to facebook</h1>
		<form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name="photo">
			</div>
			<button id="add-post" class="btn btn-primary">Add photo</button>
		</form>

	</div>

</body>
</html>
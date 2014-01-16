<?php 
	/**
	 * Class for use the facebook api in a simple and easy way.
	 * inlcude methods for get user info, post messages, upload photos, get friend lists ...
	*/
	require_once('facebook.php');

	class SimpleFacebookApi
	{
		const VERSION = '1.0';

		private $facebook;
		private $user_id;
		private $app_id;
		private $secret;
		private $user_profile;


		/**
		 * @params app key  values for the app id
		 * @return the array of the facebook class object.
		*/
		public function __construct($app_id, $secret)
		{

			if(empty($app_id) or empty($secret)){
				throw new Exception('You have to pass the appid and the secret key of your app');
			}
			
			$config = array(
		      'appId' => $app_id,
		      'secret' =>  $secret,
		      'fileUpload' => true, // optional
		      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
		  	);

			$this->facebook = new Facebook($config);
		  	$this->user_id = $this->facebook->getUser();
 			return $this->facebook;
		}

		/**
		 * @params a string.
		 * @return the object create after add a post in facebook.
		*/
		public function addPost($message)
		{
			if(empty($message)){
				throw new Exception("Insert a text to post");
			}

			$new_post = $this->facebook->api("/me/feed", 'POST',
  									array(
  										'message' => $message
  								));
			return $new_post;
		}


		/**
		 * @params A file type , $_FILES["avatar"].
		 * @return object.
		*/
		public function uploadPhoto($photo)
		{	
			$ret_obj = $this->facebook->api('/me/photos', 'POST', 
									  array(
                                      	'source' => '@' . $photo["tmp_name"]
                                      )
                                    );
			return $ret_obj;
		}


		/**
		 * @params array of fields in the fql users table or null for default fields.
		 * @return a array with the friend users.
		*/
		public function getFriends($arrayFields = null)
		{

			$params = array(
			    'method' => 'fql.query',
			    'query' => self::makeFriendsQuery($arrayFields)
			);

      		return $this->facebook->api($params);
		}


	
		private function makeFriendsQuery($arrayFields)
		{
			$begin_query = "SELECT ";
			$end_query = "FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ".self::getUserId().")" ;

			if($arrayFields == null){
				// GET DEFAULT VALUES
				$full_query = $begin_query." uid, pic, pic_square, name, sex, profile_url " . $end_query;
			}else{
				$i = 0;
				$lenArray = count($arrayFields);
				$fields = "";

				foreach($arrayFields as $field){
					$fields .= ($i == $lenArray - 1) ? $field . " "  : $field . ", ";
					$i++;
				}

				$full_query = $begin_query . $fields . $end_query;	
			}

			return $full_query;
		}

		public function validatePost($post)
		{
			$post = trim($post);
			if(!empty($post)){
				return true;
			}
			return false;
		}


		public function getLoginUrl()
		{
			$login_url = $this->facebook->getLoginUrl( array(
                    'scope' => 'publish_stream'
            ));
            return "<a href=".$login_url.">Login</a>"; 
		}

		public function isLogin()
		{
			if($this->user_id){
				try{
	  				$this->user_profile = $this->facebook->api("/me", 'GET');
					return $this->user_id;
				}catch(FacebookApiException $e){
					return false;
				}
			}
			
		}



		public function getUserProfile()
		{
			return $this->user_profile;
		}

		public function getUserId()
		{
			return $this->user_profile["id"];
		}

		public function getFullName()
		{
			return $this->user_profile["name"];
		}

		public function getFirstName()
		{
			return $this->user_profile["first_name"];			
		}

		public function getLastName()
		{
			return $this->user_profile["last_name"];			
		}

		public function getAvatar()
		{
			return "<img src='https://graph.facebook.com/".$this->user_profile["id"]."/picture' >";			
		}
	}
	
?>
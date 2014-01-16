<?php 
	

	class RemoteConnectTest extends PHPUnit_Framework_TestCase
	{
		public function setUp(){}
		public function tearDown(){}


		/**
			*
			* @expectedException Exception
			*
		*/
		public function testAppIdOrSecretKeyNotPassed()
		{
			$facebookApi = new SimpleFacebookApi('', '1222');
	       
	    }


	    public function testAppIdAndSecretKeyIsPassed()
	    {
	    	
	    }
	}
?>
<?php
	use FaceBook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\FacebookRequestException;

	class bdFacebookGraph 
	{
		private $APP_ID 			= false,
				$APP_SECRET 		= false,
				$FacebookSession 	= null
			;

		/**
		 * @param $getAppID     Facebook App ID
		 * @param $getAppSecret Facebook App Secret
		 */
		public function __construct($getAppID, $getAppSecret)
		{
			$this->APP_ID		= $getAppID;
			$this->APP_SECRET	= $getAppSecret;
			//set the facebook session
			$this->setSession();
		}

		private function setSession()
		{
			$strAccesToken = $this->APP_ID.'|'.$this->APP_SECRET;
			$this->FacebookSession = new FacebookSession($strAccesToken);
			if (! $this->FacebookSession) 
				throw new Exception("Can not set Facebook Session with access token $strAccesToken", 1);
		}

		public function fetchByRequest($getStrGraphRequest = false)
		{
			if (! $getStrGraphRequest) return ;
			try {
				$arrFBrequest = (new FacebookRequest(
					$this->FacebookSession, 
					'GET',
					$getStrGraphRequest
				))->execute()->getGraphObject()->asArray();	
				
			} catch (FacebookRequestException $e) {
				echo "Exception occured, code: " . $e->getCode();
				echo " with message: " . $e->getMessage();
			}
			return $this->convertRequestResultToArray($arrFBrequest);
		}
		private function convertRequestResultToArray($a = false)
		{
			// convert when its an object
			if (is_object($a)) {
				$a = get_object_vars($a);
			}
			// deeplink when array
			if (is_array($a)) 
				return array_map(array($this, 'convertRequestResultToArray'), $a);
			else
				return $a;
		}
		
	};
?>
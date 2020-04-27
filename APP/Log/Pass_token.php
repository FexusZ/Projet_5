<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class Pass_token extends log
	{
		private $message = array();
		
		public function __construct($array)
		{
			foreach ($array as $key => $value) 
			{
				$method = 'set'.ucfirst($key);

				if (method_exists($this, $method)) 
				{
					$this->$method($value);
				}	
			}
		}

		private function setPassword($Password)
		{
			if (empty($Password)) 
			{
				$this->message['password'] 	= '<p class="error"> Veuillez renseigner un mot de passe </p>';			
			}
		}

		public function setToken($token)
		{
			$this->token = $token;
		}

		public function send()
		{
			if (!empty($this->message)) 
			{
				return $this->message;
			}

			\APP\AppFactory::query('UPDATE client SET password = :password, pass_token = 1 WHERE token = :token',
								NULL, 'No', 
								[
									':token'		=>	$this->token,
									':password'		=>	$this->Password
								]);
			\APP\AppFactory::header('Location: http://projet5/login/signin/change_pass');
		}
	}
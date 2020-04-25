<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class Pass_token
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
				else
				{
					exit('Error.');
				}		
			}
		}

		private function setPassword($Password)
		{
			if (empty($Password)) 
			{
				$this->message['password'] 	= '<p class="error"> Veuillez renseigner un mot de passe </p>';			
			}
			$this->Password 			= $Password;
		}

		private function setConfirm_password($Confirm_password)
		{
			if (empty($Confirm_password)) 
			{
				$this->message['confirm_password'] 	= '<p class="error"> Veuillez renseigner la confirmation de mot de passe </p>';			
			}
			elseif ($this->Password === $Confirm_password) 
			{
				$this->Password = hash('sha512', $this->Password);
				$this->Password = substr($this->Password, 22, -2)?:$this->Password;
				$this->Password = substr($this->Password, 32, -3)?:$this->Password;
				$this->Password = substr($this->Password, 80, -4)?:$this->Password;
				$this->Password = substr($this->Password, 70, -6)?:$this->Password;
			}
			else
			{
				$this->message['password2'] 	= '<p class="error"> Mot de passe et confirmation différents </p>';			
			}
		}

		public function setToken($token)
		{
			$this->token = $token;
		}

		public function send()
		{

			if (!empty($this->message['email'])) 
			{
				return $this->message;
			}

			\APP\AppFactory::query('UPDATE client SET password = :password, pass_token = 1 WHERE token = :token',
								NULL, 'No', 
								[
									':token'		=>	$this->token,
									':password'		=>	$this->Password
								]);

			header('Location: http://projet5/login/signin/change_pass');
		}
	}
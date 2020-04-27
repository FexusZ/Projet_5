<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class signin
	{
		private $array = array();
		
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

		private function setUsername($Username)
		{
			$this->Username			= $Username;
		}

		private function setPassword($Password)
		{
			if (!empty($Password)) {
				$this->Password = hash('sha512', $Password);
				$this->Password = substr($this->Password, 22, -2)?:$this->Password;
				$this->Password = substr($this->Password, 32, -3)?:$this->Password;
				$this->Password = substr($this->Password, 80, -4)?:$this->Password;
				$this->Password = substr($this->Password, 70, -6)?:$this->Password;
			}else{
				$this->Password ='';
			}
		}

		public function signin()
		{
			$param = \APP\AppFactory::query('SELECT * FROM client WHERE (username = :username OR email = :username) AND password = :password',
								NULL, true, 
								[
									':username'		=>	$this->Username,
									':password'		=>	$this->Password
								]);
			return $this->hydrate($param);
		}

		private function hydrate($param)
		{
			if ($param == NULL) 
			{
				return '<p class="error"> Mauvais identifiant </p>';
			}
			if ($param->token_use == 0) 
			{
				return '<p class="error">Compte non validé </p>';
			}
			$_SESSION['login'] = $param;
			\APP\AppFactory::header('Location: http://projet5/home/index/');
		}
	}
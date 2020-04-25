<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class signup
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

		private function setFirst_name($First_name)
		{
			if (empty($First_name)) 
			{
				$this->message['firstname'] 	= '<p class="error"> Veuillez renseigner un prenom </p>';			
			}
			$this->First_name 			= $First_name;
		}

		private function setLast_name($Last_name)
		{
			if (empty($Last_name)) 
			{
				$this->message['lastname'] 	= '<p class="error"> Veuillez renseigner un nom </p>';			
			}
			$this->Last_name 			= $Last_name;
		}

		private function setUsername($Username)
		{
			$verif_username = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE username = ?',NULL, true, [$Username]);
			if (empty($Username)) 
			{
				$this->message['username'] 	= '<p class="error"> Veuillez renseigner un nom de compte </p>';			
			}elseif ($verif_username) {
				$this->message['username'] 	= '<p class="error"> Nom de compte indisponible </p>';			
			}
			$this->Username 			= $Username;
		}

		private function setEmail($Email)
		{

			$verif_email = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE email = ?',NULL, true, [$Email]);

			if (empty($Email)) 
			{
				$this->message['email'] 	= '<p class="error"> Veuillez renseigner un email </p>';			
			}
			elseif($verif_email)
			{
				$this->message['email'] 	= '<p class="error"> Email indisponible </p>';			
			}
			elseif(preg_match('#((a-zA-Z0-9\.-_)@(a-zA-Z-0-9\.-_)\.([a-z]))#',trim($Email)))
			{
				$this->message['email'] 	= '<p class="error"> Email non valide </p>';			
				
			}
			$this->Email 				= $Email;
		}

		private function setPassword($Password)
		{
			if (empty($Password)) 
			{
				$this->message['Password'] 	= '<p class="error"> Veuillez renseigner un mot de passe </p>';			
			}
			$this->Password 			= $Password;
		}

		private function setConfirm_password($Confirm_password)
		{
			if (empty($Confirm_password)) 
			{
				$this->message['Confirm_password'] 	= '<p class="error"> Veuillez renseigner la confirmation de mot de passe </p>';			
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

		public function signup()
		{

			if (!empty($this->message['firstname']) || !empty($this->message['lastname']) || !empty($this->message['username']) || !empty($this->message['email']) || !empty($this->message['Password']) || !empty($this->message['Confirm_password']) || !empty($this->message['password2'])) {
				return $this->message;
			}
			$token = bin2hex(random_bytes(64));


			\APP\AppFactory::query('INSERT INTO client(firstname, lastname, username, email, password, acces, registration, token)
								VALUES(:firstname, :lastname, :username, :email, :password, :access, :registration, :token)',
								NULL, 'No', 
								[
									':firstname'	=>	$this->First_name,
									':lastname'		=>	$this->Last_name,
									':username'		=>	$this->Username,
									':email'		=>	$this->Email,
									':password'		=>	$this->Password,
									':access'		=>	1,
									':registration'	=>	time(),
									':token'		=>	$token
								]);



			$sujet = 'Valider votre compte';
			$message = '<a href="http://projet5/login/token/'.$token.'"> Valider mon compte </a>';
			$destinataire = $this->Email;
			$headers = "From: <fexus.j.sebastien@gmail.com>\n";
			$headers .= "Reply-To: fexus.j.sebastien@gmail.com\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			mail($destinataire,$sujet,$message,$headers);

			header('Location: http://projet5/login/signin/validate');
		}
	}
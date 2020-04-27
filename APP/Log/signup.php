<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class signup extends log
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

		private function setFirst_name($First_name)
		{
			if (empty($First_name)) 
			{
				$this->message['firstname'] 	= '<p class="error"> Veuillez renseigner un prenom </p>';			
			}
			else
			{
				$this->First_name = htmlspecialchars($First_name);
				
			}
		}

		private function setLast_name($Last_name)
		{
			if (empty($Last_name)) 
			{
				$this->message['lastname'] 	= '<p class="error"> Veuillez renseigner un nom </p>';			
			}
			else
			{
				$this->Last_name = htmlspecialchars($Last_name);
				
			}
		}

		private function setUsername($Username)
		{

			$verif_username = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE username = ?',NULL, true, [$Username]);
			if (empty($Username)) 
			{
				$this->message['username'] 	= '<p class="error"> Veuillez renseigner un nom de compte </p>';			
			}elseif ($verif_username->nb !== '0') {
				$this->message['username'] 	= '<p class="error"> Nom de compte indisponible </p>';			
			}
			else
			{
				$this->Username = htmlspecialchars($Username);
				
			}
		}

		private function setEmail($Email)
		{

			$verif_email = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE email = ?',NULL, true, [$Email]);

			if (empty($Email)) 
			{
				$this->message['email'] 	= '<p class="error"> Veuillez renseigner un email </p>';			
			}
			elseif($verif_email->nb !== '0')
			{
				$this->message['email'] 	= '<p class="error"> Email indisponible </p>';			
			}
			elseif(preg_match('#^(([a-zA-Z0-9\.-_])+)@(([a-zA-Z-0-9\.-_])+)\.(([a-z])+)$#',trim($Email)) === 0)
			{
				$this->message['email'] 	= '<p class="error"> Email non valide </p>';			
			}
			else
			{
				$this->Email = htmlspecialchars($Email);
				
			}
		}

		private function setPassword($Password)
		{
			if (empty($Password)) 
			{
				$this->message['Password'] 	= '<p class="error"> Veuillez renseigner un mot de passe </p>';			
			}
			else
			{
				$this->Password = htmlspecialchars($Password);
			}
		}

		public function signup()
		{
			if (!empty($this->message)) {
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
			\APP\AppFactory::mail($destinataire,$sujet,$message,$headers);
			\APP\AppFactory::header('Location: /login/signin/validate');
		}
	}
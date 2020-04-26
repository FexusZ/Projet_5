<?php
	namespace APP\Log;
	/**
	 * 
	 */
	class Forgout_pass
	{
		private $message = array();
		
		public function __construct($email)
		{
			$this->setEmail($email);
		}

		private function setEmail($Email)
		{
			$verif_email = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE email = ?',NULL, true, [$Email]);

			if (empty($Email)) 
			{
				$this->message['email'] 	= '<p class="error"> Veuillez renseigner un email </p>';			
			}
			elseif(!$verif_email)
			{
				$this->message['email'] 	= '<p class="error"> Cette email ne correspond a aucun compte </p>';			
			}
			elseif(preg_match('#((a-zA-Z0-9\.-_)@(a-zA-Z-0-9\.-_)\.([a-z]))#',trim($Email)))
			{
				$this->message['email'] 	= '<p class="error"> Email non valide </p>';			
			}
		}

		public function send()
		{
			if (!empty($this->message['email'])) {
				return $this->message;
			}
			$token = bin2hex(random_bytes(64));
			\APP\AppFactory::query('UPDATE client SET token = :token, pass_token = 0 WHERE email = :email',
								NULL, 'No', 
								[
									':email'		=>	$this->Email,
									':token'		=>	$token
								]);
			$sujet = 'Modification de mot de passe';
			$message = '<a href="http://projet5/login/token_pass/'.$token.'"> Modifier mon mot de passe </a>';
			$destinataire = $this->Email;
			$headers = "From: <fexus.j.sebastien@gmail.com>\n";
			$headers .= "Reply-To: fexus.j.sebastien@gmail.com\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			\APP\AppFactory::mail($destinataire,$sujet,$message,$headers);
			\APP\AppFactory::header('Location: http://projet5/login/signin/validate_pass');
		}
	}
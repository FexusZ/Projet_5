<?php
	namespace APP\Contact;
	/**
	 * 
	 */
	class Contact
	{
		private $name;
		private $email;
		private $subject;
		private $content;
		private $message = array(
									'name'		=> '',
									'email'		=> '',
									'subject'	=> '',
									'content'	=> '',
									'success'	=> ''
								);
		function __construct($array)
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

		function setName($name)
		{
			if (!empty($name)) {
				$this->name = $name;
			}else{
				$this->message['name'] .='<p class="error"> Merci de remplir le champs de nom/prenom </p>';
			}
		}

		function setEmail($email)
		{
			if (!empty($email) && preg_match('#((a-zA-Z0-9\.-_)@(a-zA-Z-0-9\.-_)\.([a-z]))#',trim($Email))) {
				$this->email = $email;
			}elseif (!empty($email)) {
				$this->message['email'] .='<p class="error"> Merci de remplir un Email valide </p>';
			}else{
				$this->message['email'] .='<p class="error"> Merci de remplir le champs Email </p>';
			}
		}

		function setSubject($subject)
		{
			if (!empty($subject)) {
				$this->subject = $subject;
			}else{
				$this->message['subject'] .='<p class="error"> Merci de d\'indiquer un sujet </p>';
			}
		}

		function setContent($content)
		{
			if (!empty($content)) {
				$this->content = '<p> Nom : '.$this->name.'</p><p> Email : '.$this->email.'</p><p> Message : '.$content.'</p>';
			}else{
				$this->message['content'] .='<p class="error"> Veuillez ecrire un message </p>';
			}
		}


		function send(){
			if (!empty($this->message['content']) || !empty($this->message['subject']) || !empty($this->message['email']) || !empty($this->message['name'])) {
				return $this->message;
			}
			$this->message['success'] .= '<p class="success" style="text-align:center;"> Mail envoyé. </p>';

			$headers = "From: <".$this->email.">\n";
			$headers .= "Reply-To: ".$this->email."\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";

			mail('fexus.j.sebastien@gmail.com',$this->subject,$this->content,$headers);

			// header('Location: http://projet5/login/signin/');
			return $this->message;
		}
	}


			
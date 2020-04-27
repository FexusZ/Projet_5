<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Login extends \Core\MVC\Controllers
	{
		function signin()
		{
			$this->render('signin');
		}

		function signup()
		{
			$this->render('signup');
		}

		function forgot_pass()
		{
			$this->render('forgot_pass');
		}

		function logout()
		{
			$this->render('logout');
		}

		function token_pass($token)
		{
			$test_token = \APP\AppFactory::query('SELECT pass_token FROM client WHERE token = :token', NULL, true, 
									[':token'	=>	$token]);
			if ($test_token) 
			{
				if ($test_token->pass_token == 0) 
				{
					$message = '';
				}
				else
				{
					$message = '<p class="error">Mot de passe déjà changé</p>';
				}
			}
			else
			{
				$message = '<p class="error">Le token indiqué ne correspond a aucun compte</p>';
			}
			$param['message'] = $message;
			$param['token'] = $token;
			$this->set($param);
			$this->render('token_pass');
		}

		function token($token)
		{
			$test_token = \APP\AppFactory::query('SELECT token_use FROM client WHERE token = :token', NULL, true, 
									[
										':token'	=>	$token
									]);
			if ($test_token) 
			{
				if ($test_token->token_use == 0) 
				{
					$message = '<p class="success">Compte Validé </p>';
					\APP\AppFactory::query('UPDATE client SET token_use = 1 WHERE token = :token', NULL, 'No', 
									[
										':token'	=>	$token
									]);
				}
				else
				{
					$message = '<p class="error">Compte déjà validé</p>';
				}
			}
			else
			{
				$message = '<p class="error">Le token indiqué ne correspond a aucun compte</p>';
			}

			$param['token'] = $message;
			$this->set($param);
			$this->render('signin');
		}
	}
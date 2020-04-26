<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Moderator extends \Core\MVC\Controllers
	{
		protected $models = array('Moderator');

		function check_comment()
		{
			$param['comment'] = $this->Moderator->getNotValidateComment();
			$this->set($param);			
			$this->render('check_comment');
		}

		function check_user()
		{
			$this->render('check_user');
		}
	}
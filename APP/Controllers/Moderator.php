<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Moderator extends \Core\MVC\Controllers
	{
		protected $models = array('Post', 'Comment');

		function check_comment()
		{
			$this->render('check_comment');
		}

		function check_user()
		{
			$this->render('check_user');
		}
	}
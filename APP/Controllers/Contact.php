<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Contact extends \Core\MVC\Controllers
	{
		protected $models = array('Post', 'Comment');

		function contact()
		{
			$this->render('contact');
		}
	}
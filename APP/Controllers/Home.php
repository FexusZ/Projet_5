<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Home extends \Core\MVC\Controllers
	{

		protected $models = array('Post');

		function index()
		{
			$param['last_post'] = $this->Post->getLast();
			$this->set($param);
			$this->render('index');
		}
	}
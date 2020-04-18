<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Post extends \Core\MVC\Controllers
	{
		protected $models = array('Post');

		function index()
		{
			$param['all'] = $this->Post->getAll();
			$this->set($param);
			$this->render('index');
		}

		function post($id)
		{
			$param['post'] = $this->Post->getPost($id);
			$this->set($param);
			$this->render('post');
		}
	}
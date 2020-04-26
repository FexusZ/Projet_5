<?php
	namespace APP\Controllers;

	/**
	 * 
	 */
	class Post extends \Core\MVC\Controllers
	{
		protected $models = array('Post', 'Comment');

		function index()
		{
			$param['all'] = $this->Post->getAll();
			$this->set($param);
			$this->render('index');
		}

		function post($id)
		{
			$param['post'] = $this->Post->getPost($id);
			$param['comment'] = $this->Comment->getAll($id);
			$this->set($param);
			$this->render('post');
		}
		
		function create()
		{
			$this->render('create');
		}
		
		function update($id)
		{
			$param['post'] = $this->Post->getPost($id);
			$this->set($param);
			$this->render('update');
		}
	}
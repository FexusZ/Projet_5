<?php
    namespace APP\Controllers;

    /**
     * 
     */
    class Post extends \Core\MVC\Controllers
    {
        protected $models = array('Post', 'Comment');

        public function index()
        {
            $param['all'] = $this->Post->getAll();
            $this->set($param);
            $this->render('index');
        }

        public function post($id)
        {
            $param['article'] = $this->Post->getPost($id);
            $param['comment'] = $this->Comment->getAll($id);
            $this->set($param);
            $this->render('post');
        }
        
        public function create()
        {
            $this->render('create');
        }
        
        public function update($id)
        {
            $param['article'] = $this->Post->getPost($id);
            $this->set($param);
            $this->render('update');
        }
    }
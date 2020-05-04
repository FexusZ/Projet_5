<?php

namespace APP\Controllers;
/**
 * Class Post
 * @package APP\Controllers
 */
class Post extends \Core\MVC\Controllers
{
    /**
     * @var string[]
     */
    protected $models = array('Post', 'Comment');

    /**
     *
     */
    public function index()
    {
        $param['all'] = $this->Post->getAll();
        $this->set($param);
        $this->render('index');
    }

    /**
     * @param $id
     */
    public function post($id)
    {
        $param['article'] = $this->Post->getPost($id);
        $param['comment'] = $this->Comment->getAll($id);
        $this->set($param);
        $this->render('post');
    }

    /**
     *
     */
    public function create()
    {
        $this->render('create');
    }

    /**
     * @param $id
     */
    public function update($id)
    {
        $param['article'] = $this->Post->getPost($id);
        $this->set($param);
        $this->render('update');
    }
}
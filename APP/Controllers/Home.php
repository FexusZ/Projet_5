<?php

namespace APP\Controllers;

/**
 * Class Home
 * @package APP\Controllers
 */
class Home extends \Core\MVC\Controllers
{
    /**
     * @var string[]
     */
    protected $models = array('Post');

    /**
     *
     */
    public function index()
    {
        $param['last_post'] = $this->Post->getLast();
        $this->set($param);
        $this->render('index');
    }

    /**
     *
     */
    public function curriculum()
    {
        $this->render('curriculum');
    }

    /**
     *
     */
    public function conditionUtilisation()
    {
        $this->render('conditionUtilisation');
    }

    /**
     *
     */
    public function error()
    {
        $this->render('error');
    }
}
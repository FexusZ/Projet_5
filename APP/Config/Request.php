<?php

namespace APP\Config;

/**
 * Class Request
 * @package APP\Config
 */
class Request
{
    /**
     * @var Parameter
     */
    private $get;
    /**
     * @var Parameter
     */
    private $post;
    /**
     * @var Parameter
     */
    private $session;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->post = new Parameter($_POST);
        $this->session = new Session($_SESSION);
    }

    /**
     * @return Parameter
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return Parameter
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return Parameter
     */
    public function getSession()
    {
        return $this->session;
    }
}
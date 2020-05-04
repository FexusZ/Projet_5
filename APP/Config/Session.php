<?php

namespace APP\Config;

/**
 * Class Session
 * @package APP\Config
 */
class Session
{
    /**
     * @var
     */
    private $session;

    /**
     * Session constructor.
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        if (isset($this->session[$name])) {
            return $this->session[$name];
        }
    }


    /**
     * @param $name
     * @param $value
     */
    public function setLogin($name, $value)
    {
        $_SESSION['login']->$name = $value;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        if (!empty($this->session)) {
            return $this->session;
        }
    }

}
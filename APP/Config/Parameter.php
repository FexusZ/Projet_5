<?php

namespace APP\Config;

/**
 * Class Parameter
 * @package APP\config
 */
class Parameter
{
    /**
     * @var
     */
    private $parameter;

    /**
     * Parameter constructor.
     * @param $parameter
     */
    public function __construct($parameter)
    {
        $this->setParameter($parameter);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        if (isset($this->parameter[$name])) {
            return $this->parameter[$name];
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->parameter[$name] = $value;
    }

    /**
     * @return mixed
     */
    public function getParameter()
    {
        if (!empty($this->parameter)) {
            return $this->parameter;
        }
    }

    private function setParameter($parameter)
    {
        foreach ($parameter as $key => $value) {
            $this->parameter[$key] = htmlentities($value, ENT_QUOTES);
        }
    }


}
<?php

namespace Core\MVC;

/**
 * Class Models
 * @package Core\MVC
 */
class Models
{
    /**
     * @param $key
     * @return mixed
     */
    public function __GET($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return '<p>' . $this->author . ' le : ' . date('d-m-Y', $this->post_date) . '</p>';
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return '<p>' . nl2br($this->comment) . '</p>';
    }
}
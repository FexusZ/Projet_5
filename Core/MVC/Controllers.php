<?php

namespace Core\MVC;

use \APP\Config\Request;

/**
 * Class Controllers
 * @package Core\MVC
 */
class Controllers
{
    /**
     * @var array
     */
    protected $vars = array();
    /**
     * @var string
     */
    protected $template = 'default';

    /**
     * Controllers constructor.
     */
    public function __construct()
    {
        if (isset($this->models)) {
            foreach ($this->models as $model) {
                $this->loadModel($model);
            }
        }

        $Request = new Request();
        $param['get'] = $Request->getGet();
        $param['post'] = $Request->getPost();
        $param['session'] = $Request->getSession();
        $this->set($param);
    }

    /**
     * @param $filename
     */
    protected function render($filename)
    {
        extract($this->vars);
        ob_start();
        $require = str_replace('\\', '/', str_replace('Controllers', 'Views', get_class($this))) . '/' . $filename . '.php';
        require $require;

        $content = ob_get_clean();

        if (!$this->template) {
            echo $content . "\n";
            return;
        }
        $require = 'APP/Views/template/' . $this->template . '.php';
        require $require;
    }

    /**
     * @param $array
     */
    protected function set($array)
    {
        $this->vars = array_merge($this->vars, $array);
    }

    /**
     * @param $model
     */
    protected function loadModel($model)
    {
        $models = '\\APP\\Models\\' . $model;
        $this->$model = new $models();
    }
}
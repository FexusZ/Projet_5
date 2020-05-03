<?php
    namespace Core\MVC;

    use \APP\Config\Request;

    /**
     * 
     */
    class Controllers
    {
        protected $vars = array();
        protected $template = 'default';

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

        protected function render($filename)
        {
            extract($this->vars);
            ob_start();
            require str_replace('\\', '/', str_replace('Controllers', 'Views',get_class($this))).'/'.$filename.'.php';

            $content = ob_get_clean();

            if (!$this->template) {
                echo $content;
            } else {
                require 'APP/Views/template/'.$this->template.'.php';
            }
        }

        protected function set($array)
        {
            $this->vars = array_merge($this->vars, $array);
        }

        protected function loadModel($model)
        {
            $models = '\\APP\\Models\\'.$model;
            $this->$model = new $models();
        }
    }
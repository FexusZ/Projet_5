<?php
	namespace Core\MVC;
	/**
	 * 
	 */
	class Controllers
	{
		public $vars = array();
		public $template = 'default';

		public function __construct(){
			if (isset($this->models)) {
				foreach ($this->models as $model) {
					$this->loadModel($model);
				}
			}
		}

		function render($filename)
		{
			extract($this->vars);
			ob_start();

			require ROOT.str_replace('\\', '/', str_replace('Controllers', 'Views',get_class($this))).'/'.$filename.'.php';

			$content = ob_get_clean();

			if (!$this->template) 
			{
				echo $content;
			}
			else
			{
				require ROOT.'APP/Views/template/'.$this->template.'.php';
			}
		}

		function set($array)
		{
			$this->vars = array_merge($this->vars, $array);
		}

		function loadModel($model)
		{
			$models = '\\APP\\Models\\'.$model;
			$this->$model = new $models();
		}
	}
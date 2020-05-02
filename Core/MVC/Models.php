<?php
	namespace Core\MVC;

	/**
	 * 
	 */
	class Models
	{
		function __GET($key)
 		{
 			$method = 'get'.ucfirst($key);
 			$this->$key = $this->$method();
 			return $this->$key;
 		}
 		function getAuthor()
 		{
 			return '<p>'.$this->author.' le : '.date('d-m-Y', $this->post_date).'</p>';
 		}

 		function getContent()
 		{
 			return '<p>'. nl2br($this->comment) .'</p>';
 		}
	}
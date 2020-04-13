<?php
	namespace APP\Table;
	use APP\AppFactory;

	class Post
	{
		protected $db;
		protected $table;

		public static function getAll()
		{
			return AppFactory::query("SELECT * FROM post", __CLASS__);
		}

		public static function getLast()
		{
			return AppFactory::query("SELECT * FROM post LIMIT 5", __CLASS__);
		}

		public static function getPost($id)
		{
			return AppFactory::query('SELECT * FROM post WHERE id = ?', __CLASS__, true, [$id]);
		}

 		/**
 		* Permet d'hydrater les données a envoyer en bdd
 		* @param array
 		*/
 		function __GET($key)
 		{
 			$method = 'get'.ucfirst($key);
 			$this->$key = $this->$method();
 			return $this->$key;
 		}

 		function getUrl()
 		{

 			return 'index.php?page=post&id='. $this->ID;
 		}

 		function getPost_chapo()
 		{
 			return '<p>'. $this->content . '<a href='. $this->getUrl() .'>... </a>';
 		}
 		function getPost_title()
 		{

 		}
	}
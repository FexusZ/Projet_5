<?php
	namespace APP\Models;
	use APP\AppFactory;

	class Post extends \Core\MVC\Models
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
 			return 'http://projet5/post/post/'. $this->ID;
 		}

 		function getPost_chapo()
 		{
 			return '<p>'. $this->chapo . '... <a href='. $this->getUrl() .'>Voir la suite</a>';
 		}

 		function getPost_title()
 		{
 			return '<h2>'. $this->title .'</h2>';
 		}

 		function getAuthor()
 		{
 			$author = AppFactory::query('SELECT concat(firstname, " ", lastname) as author FROM client WHERE ID = :ID', NULL, true, [':ID'	=>	$this->ID_user])->author;
 			$update_author = AppFactory::query('SELECT concat(firstname, " ", lastname) as author FROM client WHERE ID = :ID', NULL, true, [':ID'	=>	$this->update_ID_user])->author;
 			return '<p> Publication faite par : '.$author.' </br> Derniere modification faite le : '.date('d-m-Y', $this->last_update).', par : '.$update_author.'</p>';
 		}

 		function getPost_content()
 		{
 			return '<p>'.$this->chapo.'</p><p>'. $this->content .'</p>';
 		}
	}
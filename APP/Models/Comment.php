<?php
	namespace APP\Models;
	use APP\AppFactory;

	class Comment extends \Core\MVC\Models
	{
		protected $db;
		protected $table;

		public static function getAll($id_post)
		{
			return AppFactory::query("SELECT * FROM comment WHERE ID_post = ? AND validate = 1", __CLASS__, false, [$id_post]);
		}

		public static function getNotValidate(){
			return AppFactory::query("SELECT c.ID as id_comment, p.ID as id_post, p.title, c.comment, c.Id_user FROM comment as c
									JOIN post as p
										ON c.ID_post = p.ID
									WHERE c.validate = 0
									ORDER BY p.ID, c.ID", __CLASS__);
		}

		function __GET($key)
 		{
 			$method = 'get'.ucfirst($key);
 			$this->$key = $this->$method();
 			return $this->$key;
 		}

 		function getAuthor()
 		{
 			$author = AppFactory::query('SELECT concat(firstname, " ", lastname) as author FROM client WHERE ID = :ID', NULL, true, [':ID'	=>	$this->ID_user])->author;


 			return '<p>'.$author.' le : '.date('d-m-Y', $this->post_date).'</p>';
 		}

 		function getContent()
 		{
 			return '<p>'. nl2br($this->comment) .'</p>';
 		}
	}
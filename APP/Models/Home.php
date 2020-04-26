<?php
	namespace APP\Models;
	use APP\AppFactory;

	class Home extends \Core\MVC\Models
	{
		protected $db;
		protected $table;

		public static function getAll()
		{
			return AppFactory::query("SELECT * FROM post", __CLASS__);
		}

		public static function getLast()
		{
			return AppFactory::query("SELECT * FROM post LIMIT 4", __CLASS__);
		}

		public static function getPost($id)
		{
			return AppFactory::query('SELECT * FROM post WHERE id = ?', __CLASS__, true, [$id]);
		}
	}
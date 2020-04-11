<?php
	namespace APP\Table;
	use APP\AppFactory;

	class Post
	{
		protected $db;
		protected $table;

		public static function getAll()
		{
			return AppFactory::query("SELECT * FROM post");
		}

		public static function getLast()
		{
			return AppFactory::query("SELECT * FROM post LIMIT 5");
		}

		public static function getPost($id)
		{
			return AppFactory::query('SELECT * FROM post WHERE id = ?', true, [$id]);
		}
	}
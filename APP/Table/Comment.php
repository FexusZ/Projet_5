<?php
	namespace APP\Table;
	use APP\AppFactory;

	class Post
	{
		protected $db;
		protected $table;

		public static function getAll($id_post)
		{
			return AppFactory::query("SELECT * FROM comment WHERE ID_post = ?", false, [$id_post]);
		}

		public static function getNotValidate(){
			return AppFactory::query("SELECT * FROM comment
									JOIN post 
										ON comment.ID_post = post.ID
									WHERE comment.validate = 0
									ORDER BY post.ID, comment.ID");
		}
	}
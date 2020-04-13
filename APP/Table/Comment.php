<?php
	namespace APP\Table;
	use APP\AppFactory;

	class Comment
	{
		protected $db;
		protected $table;

		public static function getAll($id_post)
		{
			return AppFactory::query("SELECT * FROM comment WHERE ID_post = ?", __CLASS__, false, [$id_post]);
		}

		public static function getNotValidate(){
			return AppFactory::query("SELECT c.ID as id_comment, p.ID as id_post, p.title, c.comment, c.Id_user FROM comment as c
									JOIN post as p
										ON c.ID_post = p.ID
									WHERE c.validate = 0
									ORDER BY p.ID, c.ID", __CLASS__);
		}
	}
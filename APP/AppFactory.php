<?php
	namespace APP;
	use Core\Database\Database;
	include 'Private/config.php';
	class AppFactory
	{

		private static $db;
		private static $response;

		public static function getDbQuery($statement, $fetch = false, $array = array())
		{
			if (is_null(self::$db)) 
			{
				self::$db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
			}

			if (empty($array))
			{
				self::$response = self::$db->query($statement, $fetch);
			}else{
				self::$response = self::$db->execute($statement, $array, $fetch);
			}
			return self::$response;
		}
	}
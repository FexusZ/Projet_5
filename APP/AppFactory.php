<?php
	namespace APP;
	use Core\Database\Database;
	include 'Private/config.php';
	class AppFactory
	{

		private static $db;
		private static $response;
		private static $page;
		/**
		* Créer un instance de la classe Database
		* @return Database
		*/
		private static function getDb()
		{
			if (self::$db === NULL) {
				self::$db = new Database(DB_NAME, DB_USER, DB_PASS, DB_HOST);
			}
			return self::$db;
		}

		/**
		* Retourne une requete SQL query ou execute de la classe Database
		* @param string $statement
		* @param bool $fetch
		* @param array $array
		* @return mixed
		*/
		public static function query($statement, $class_name = NULL, $fetch = false, $array = array())
		{
			if (empty($array)) {
				self::$response = self::getDb()->query($statement, $class_name, $fetch);
			} else {
				self::$response = self::getDb()->execute($statement, $class_name, $fetch, $array);
			}
			return self::$response;
		}

		public static function getMenu($page)
		{
			$menu = array(
				'Accueil'	=>	array(
					'lien'		=>	'/home/index/'
				),

				'Article'	=>	array(
					'lien'		=>	'/post/index/',
					'sub_menu'	=>	array(
						
						
					)
				),

				'Contact'	=>	array(
					'lien'		=>	'/contact/contact/'
				)
			);
			if (isset($_SESSION['login']) && $_SESSION['login']->acces == 10) {
				$menu['Article']['sub_menu'] = array(
												'Tous les articles'	=>	array(
													'lien'		=>	'/post/index/',
												),
												'Creation d\'article'	=>	array(
													'lien'	=>	'/post/create/'
												),
											);
				$menu['Moderation'] = array(
											'lien'	=>	"",
											'sub_menu'	=>	array(
												'Confirmer les commentaires'	=>	array(
												'lien'	=>	'/moderator/check_comment/'
												),
											)
										);
			}

			self::$page = $page?:'Accueil';
			return 	self::ExpandMenu($menu, false);
		}

		private static function ExpandMenu($menu, $children = true)
		{	
			$return = '';
			if (!$children) {
				$return = "
				<div class='navbar navbar-inverse navbar-fixed-top headroom'>
				    <div class='container'>
				      	<div class='navbar-header'>
				        	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='icon-bar'></span> <span class='icon-bar'></span> <span class='icon-bar'></span> </button>
				        	<a class='navbar-brand' href='/home/index/''><img src='../../public/images/logo_test.png' alt='Progressus HTML5 template'></a>
				      	</div>
				      	<div class='navbar-collapse collapse'>		
							<ul class='nav navbar-nav pull-right'>";
			}

			foreach ($menu as $key => $value) 
			{
				$active='';
				if ($key == self::$page) {
					$active = 'active';
				}
				if (isset($value['sub_menu']) && !empty($value['sub_menu'])) {
					$return.= 			"<li class='dropdown ".$active."'>
			            					<a href='".$value['lien']."' class='dropdown-toggle' data-toggle='dropdown'>".$key." <b class='caret'></b></a>
			            					<ul class='dropdown-menu'>";
					$return .=  				self::ExpandMenu($value['sub_menu']);
					$return .=				"</ul>
										</li>";
				} else {
					$return .= 			"<li class='".$active."'><a href='".$value['lien']."'>".$key."</a></li>";
				}
			}

			if (!$children) {
				$active = '';
				if (empty($_SESSION)) {
					if (self::$page=='Login') {
						$active = 'active';
					}
					$return.= 			"<li class='".$active."'><a class='btn' href='/login/signin/'>SIGN IN / SIGN UP</a></li>";
				} else {
					$return.= 			"<li><a class='btn' href='/login/logout/'>LOG OUT</a></li>";
				}

				$return.= "			</ul>
							</div>
				    	</div>
					</div>";
			}

			return $return;
		}

		public static function header($header)
		{
			header($header);
		}

		public static function mail($to, $subject, $message, $header)
		{
			mail($to, $subject, $message, $header);
		}	
	}
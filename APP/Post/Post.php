<?php
	namespace APP\Post;
	use APP\AppFactory;

	/**
	 * 
	 */
	class Post
	{
		protected $ID;
		protected $title;
		protected $chapo;
		protected $content;
		protected $ID_user;
		protected $last_update;
		protected $post_date;

		function __construct()
		{
			# code...
		}

		protected function setTitle($title)
		{
			if ($title != NULL && $title != '' && strlen($title) <= 32) 
			{
				$this->title = $title;
			}
			elseif($title == NULL && $title == '')
			{
				exit('Veuillez ajouter un titre.');
			}
			else
			{
				exit('Titre trop long, 32 Caractere maximum.');
			}
		}

		protected function setChapo($chapo)
		{
			if ($chapo != NULL && $chapo != '' && strlen($chapo) <= 100) 
			{
				$this->chapo = $chapo;
			}
			elseif($chapo == NULL && $chapo == '')
			{
				$this->chapo = substr($this->content, 0 , 100);
			}
			else
			{
				exit('Chapo trop long, 100 Caractere maximum.');
			}
			$this->chapo = $chapo;
		}

		protected function setContent($content)
		{
			if ($content != NULL && $content != '') 
			{
				$this->content = $content;
			}
			else
			{
				exit('Veuillez ajouter un titre.');
			}
		}

		protected function setId($id)
		{
			$test_id = AppFactory::query('SELECT * FROM post WHERE ID = :id', NULL, true, 
				[
					':id' => $id,
				]);
			if (is_int($id) && !empty($test_id)) 
			{
				$this->ID = $id;
			}
			else
			{
				exit('ID de post incorrect.');
			}
		}

		protected function setId_user($id)
		{
			$test_id = AppFactory::query('SELECT * FROM client WHERE ID = :id', 
				 NULL, true, [':id' => $id]);
			if (is_int($id) && !empty($test_id)) 
			{
				$this->ID_user = $id;
			}
			else
			{
				exit('ID d\'utilisateur incorrect.');
			}
		}

		protected function setLast_update()
		{
			$this->last_update = time();
		}

		protected function setPost_date()
		{
			$this->post_date = time();
		}
	}
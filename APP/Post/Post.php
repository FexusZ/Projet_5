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
		protected $message;

		function __construct()
		{
			# code...
		}

		protected function setTitle($title)
		{
			if ($title !== NULL && $title !== '' && strlen($title) <= 32) 
			{
				$this->title = $title;
			}
			elseif($title === NULL && $title === '')
			{
				$this->message['title'] = '<p class="error">Veuillez ajouter un titre.</p>';
			}
			else
			{
				$this->message['title'] = '<p class="error">Titre trop long, 32 Caractere maximum.</p>';
			}
		}

		protected function setChapo($chapo)
		{
			if ($chapo !== NULL && $chapo !== '' && strlen($chapo) <= 100)  
			{
				$this->chapo = $chapo;
			}
			elseif($this->content !== NULL && $this->content !== '')
			{
				$this->chapo = substr($this->content, 0 , 100);
			}
			elseif($chapo === NULL || $chapo === '' || $this->content === NULL || $this->content === '')
			{
				$this->message['chapo'] = '<p class="error">Veuillez remplir le chapo et/ou le contenu.</p>';
			}
			else
			{
				$this->message['chapo'] = '<p class="error">Chapo trop long, 100 Caractere maximum.</p>';
			}
		}

		protected function setContent($content)
		{
			if ($content !== NULL && $content !== '') 
			{
				$this->content = $content;
			}
			else
			{
				$this->message['content'] = '<p class="error">Veuillez ajouter du contenu.</p>';
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
				$this->message['id_post'] = '<p class="error">ID de post incorrect.</p>';
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
				$this->message['id_user'] = '<p class="error">ID d\'utilisateur incorrect.</p>';
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
<?php
	namespace APP\Post;
	use APP\AppFactory;
	/**
	 * 
	 */
	class PostCreate extends Post
	{
		
		function __construct($title, $chapo, $content, $id)
		{
			$this->setTitle();

			$this->setContent();

			$this->setChapo();

			$this->setId_user();

			$this->setLast_update();

			$this->setPost_date();
		}

		function setTitle($title)
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

		function setChapo($chapo)
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

		function setContent($content)
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

		function setId_user($id)
		{
			$test_id = AppFactory::query('SELECT * FROM client WHERE ID = :id', 
				 __CLASS__, true, array(':id' => $id));
			if (is_int($id) && $test_id) {
				$this->ID_user = $id;
			}else{
				exit('ID d\'utilisateur incorrect.');
			}
		}

		function setLast_update()
		{
			$this->last_update = time();
		}

		function setPost_date()
		{
			$this->post_date = time();
		}

		function setInsert_post()
		{
			AppFactory::query('INSERT INTO post 
				(title, chapo, content, ID_user, last_update, post_date)
				VALUES
				(:title, :chapo, :content, :ID_user, :last_update, :post_date)',
				[
					':title'		=>	$this->title,
					':chapo'		=>	$this->chapo,
					':content'		=>	$this->content,
					':ID_user'		=>	$this->ID_user,
					':last_update'	=>	$this->last_update,
					':post_date'	=>	$this->post_date
				]);
		}
	}
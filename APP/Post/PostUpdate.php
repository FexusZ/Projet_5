<?php
	namespace APP\Post;
	use APP\AppFactory;
	
	/**
	 * 
	 */
	class PostUpdate extends Post
	{
		
		function __construct($title, $chapo, $content, $id, $ID_user)
		{
			$this->setTitle($title);

			$this->setContent($content);

			$this->setChapo($chapo);

			$this->setId_user($ID_user);

			$this->setId($id);

			$this->setLast_update();

			$this->setPost_date();
		}

		public function update()
		{
			AppFactory::query('UPDATE post SET title = :title, chapo = :chapo, content = :content, update_ID_user = :ID_user, last_update = :last_update, post_date = :post_date WHERE ID = :id',
				NULL, 'No',
				[
					':title'		=>	$this->title,
					':chapo'		=>	$this->chapo,
					':content'		=>	$this->content,
					':ID_user'		=>	$this->ID_user,
					':last_update'	=>	$this->last_update,
					':post_date'	=>	$this->post_date,
					':id'			=>	$this->ID
				]);
		}
	}
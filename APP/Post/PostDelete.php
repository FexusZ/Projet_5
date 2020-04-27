<?php
	namespace APP\Post;
	use APP\AppFactory;

	/**
	 * 
	 */
	class PostDelete extends Post
	{
		
		function __construct($id, $id_user)
		{
			$this->setId_user($id_user);
			$this->setId($id);
		}
		
		public function delete()
		{

			if (!empty($this->message['id_user']) || !empty($this->message['id_post'])) 
			{
				return $this->message;
			}
			else
			{
				AppFactory::query('DELETE FROM post WHERE ID = :id',
				NULL, 'No',
				[
					':id'	=>	$this->ID
				]);
				AppFactory::header('Location: /home/index');
			}

		}
	}
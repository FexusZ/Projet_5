<?php
	namespace APP\Post;
	use APP\AppFactory;
	
	/**
	 * 
	 */
	class PostComment extends Post
	{
		function __construct($comment, $ID_user, $ID_post)
		{
			$this->setComment($comment);

			$this->setId_user($ID_user);

			$this->setPost_date();

			$this->setID($ID_post);
		}

		public function SetComment($comment)
		{
			if (!empty($comment)) 
			{
				$this->comment = $comment;
			}
			else
			{
				$this->message['comment'] = '<p class="error">Merci d\'ajouter un commentaire avant d\'envoyer</p>';
			}
		}

		public function send()
		{

			if (!empty($this->message['comment']) || !empty($this->message['id_user']) || !empty($this->message['id_post'])) 
			{
				return $this->message;
			}
			else
			{

				AppFactory::query('INSERT INTO comment(ID_post, comment, ID_user, post_date)
				VALUES(:ID_post, :comment, :ID_user, :post_date)',
				NULL, 'No',
				[
					':ID_post'			=>	$this->ID,
					':comment'			=>	$this->comment,
					':ID_user'			=>	$this->ID_user,
					':post_date'		=>	$this->post_date
				]);
				$this->message['success'] = '<p class="success"> Commentaire envoyé en validations </p>';
				return $this->message;
			}
		}
	}
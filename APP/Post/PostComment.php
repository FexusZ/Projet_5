<?php

namespace APP\Post;

use APP\App;

/**
 * Class PostComment
 * @package APP\Post
 */
class PostComment extends Post
{
    /**
     * PostComment constructor.
     * @param $comment
     * @param $ID_user
     * @param $ID_post
     */
    function __construct($comment, $ID_user, $ID_post)
    {
        $this->setComment($comment);

        $this->setId_user($ID_user);

        $this->setPost_date();

        $this->setID($ID_post);
    }

    /**
     * @param $comment
     */
    private function SetComment($comment)
    {
        if (!empty($comment)) {
            $this->comment = $comment;
            return;
        }
        $this->message['comment'] = '<p class="error">Merci d\'ajouter un commentaire avant d\'envoyer</p>';
    }

    /**
     * @return mixed
     */
    public function send()
    {

        if (!empty($this->message)) {
            return $this->message;
        }
        App::query('INSERT INTO comment(ID_post, comment, ID_user, post_date)
                VALUES(:ID_post, :comment, :ID_user, :post_date)',
            null, 'No',
            [
                ':ID_post' => $this->ID,
                ':comment' => $this->comment,
                ':ID_user' => $this->ID_user,
                ':post_date' => $this->post_date
            ]);
        $this->message['success'] = '<p class="success"> Commentaire envoyé en validations </p>';
        return $this->message;
    }
}
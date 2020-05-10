<?php

namespace APP\Post;

use APP\App;

/**
 * Class PostCreate
 * @package APP\Post
 */
class PostCreate extends Post
{

    /**
     * PostCreate constructor.
     * @param $title
     * @param $chapo
     * @param $content
     * @param $id
     */
    public function __construct($title, $chapo, $content, $id)
    {
        $this->setTitle($title);

        $this->setContent($content);

        $this->setChapo($chapo);

        $this->setId_user($id);

        $this->setLast_update();

        $this->setPost_date();
    }

    /**
     * @return mixed
     */
    public function insert()
    {

        if (!empty($this->message)) {
            return $this->message;
        }
        App::query('INSERT INTO post(title, chapo, content, ID_user, update_ID_user, last_update, post_date)
                VALUES(:title, :chapo, :content, :ID_user, :ID_user, :last_update, :post_date)',
            null, 'No',
            [
                ':title' => $this->title,
                ':chapo' => $this->chapo,
                ':content' => $this->content,
                ':ID_user' => $this->ID_user,
                ':last_update' => $this->last_update,
                ':post_date' => $this->post_date
            ]);
        $last_id = App::query('SELECT MAX(ID) as ID FROM post', null, true)->ID;
        App::header('Location: /post/post/' . $last_id);
    }
}
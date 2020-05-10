<?php

namespace APP\Post;

use APP\App;

/**
 * Class PostUpdate
 * @package APP\Post
 */
class PostUpdate extends Post
{

    /**
     * PostUpdate constructor.
     * @param $title
     * @param $chapo
     * @param $content
     * @param $id
     * @param $ID_user
     */
    public function __construct($title, $chapo, $content, $id, $ID_user)
    {
        $this->setTitle($title);

        $this->setContent($content);

        $this->setChapo($chapo);

        $this->setId_user($ID_user);

        $this->setId($id);

        $this->setLast_update();
    }

    /**
     * @return mixed
     */
    public function update()
    {
        if (!empty($this->message)) {
            return $this->message;
        }
        App::query('UPDATE post SET title = :title, chapo = :chapo, content = :content, update_ID_user = :ID_user, last_update = :last_update WHERE ID = :id',
            null, 'No',
            [
                ':title' => $this->title,
                ':chapo' => $this->chapo,
                ':content' => $this->content,
                ':ID_user' => $this->ID_user,
                ':last_update' => $this->last_update,
                ':id' => $this->ID
            ]);
        App::header('Location: /post/post/' . $this->ID);
    }
}
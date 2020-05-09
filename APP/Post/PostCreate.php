<?php

namespace APP\Post;

use APP\AppFactory;

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
     * @param $id
     */
    protected function setId_user($id)
    {
        $test_id = AppFactory::query('SELECT * FROM client WHERE ID = :id', null, true, array(':id' => $id));
        if (is_int($id) && $test_id) {
            $this->ID_user = $id;
            return;
        }
        $this->message['id_user'] = '<p class="error">ID d\'utilisateur incorrect.</p>'."\n";
    }

    /**
     * @return mixed
     */
    public function insert()
    {

        if (!empty($this->message)) {
            return $this->message;
        }
        AppFactory::query('INSERT INTO post(title, chapo, content, ID_user, update_ID_user, last_update, post_date)
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
        $last_id = AppFactory::query('SELECT MAX(ID) as ID FROM post', null, true)->ID;
        AppFactory::header('Location: /post/post/' . $last_id);
    }
}
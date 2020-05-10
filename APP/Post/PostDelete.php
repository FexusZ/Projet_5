<?php

namespace APP\Post;

use APP\App;

/**
 * Class PostDelete
 * @package APP\Post
 */
class PostDelete extends Post
{

    /**
     * PostDelete constructor.
     * @param $id
     * @param $id_user
     */
    public function __construct($id, $id_user)
    {
        $this->setId_user($id_user);
        $this->setId($id);
    }

    /**
     * @return mixed
     */
    public function delete()
    {

        if (!empty($this->message['id_user']) || !empty($this->message['id_post'])) {
            return $this->message;
        }
        App::query('DELETE FROM post WHERE ID = :id',
            null, 'No',
            [
                ':id' => $this->ID
            ]);
        App::header('Location: /home/index');
    }
}
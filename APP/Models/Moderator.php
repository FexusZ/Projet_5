<?php

namespace APP\Models;

use \APP\App;


/**
 * Class Moderator
 * @package APP\Models
 */
class Moderator extends \Core\MVC\Models
{
    /**
     * @return mixed
     */
    public static function getNotValidatePost()
    {
        return App::query("SELECT p.ID as id_post, p.title
                                    FROM comment as c
                                    JOIN post as p
                                        ON c.ID_post = p.ID
                                    WHERE c.validate = 0
                                    GROUP BY id_post
                                    ORDER BY p.ID, c.ID", __CLASS__);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getNotValidateComment($id)
    {
        return App::query("SELECT c.ID as id_comment, c.comment, c.comment, c.Id_user, concat(cl.firstname, ' ', cl.lastname) as author, c.post_date
                                    FROM comment as c
                                    JOIN post as p
                                        ON c.ID_post = p.ID
                                    JOIN client as cl
                                        ON c.Id_user = cl.ID
                                    WHERE c.validate = 0
                                        AND p.ID = :id
                                    ORDER BY p.ID, c.ID", __CLASS__, false, [':id' => $id]);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return '<h2>' . $this->title . '</h2>';
    }
}
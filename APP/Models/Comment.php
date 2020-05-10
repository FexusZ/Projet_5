<?php

namespace APP\Models;

use APP\App;

/**
 * Class Comment
 * @package APP\Models
 */
class Comment extends \Core\MVC\Models
{
    /**
     * @param $id_post
     * @return mixed
     */
    public static function getAll($id_post)
    {
        return App::query("SELECT c.*, concat(cl.firstname, ' ', cl.lastname) as author
                                        FROM comment as c
                                        JOIN client as cl
                                            ON c.Id_user = cl.ID
                                        WHERE ID_post = ? 
                                            AND validate = 1", __CLASS__, false, [$id_post]);
    }
}
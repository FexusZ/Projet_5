<?php

namespace APP\Models;

use APP\AppFactory;

/**
 * Class Comment
 * @package APP\Models
 */
class Comment extends \Core\MVC\Models
{
    /**
     * @var
     */
    protected $db;
    /**
     * @var
     */
    protected $table;

    /**
     * @param $id_post
     * @return mixed
     */
    public static function getAll($id_post)
    {
        return AppFactory::query("SELECT c.*, concat(cl.firstname, ' ', cl.lastname) as author
                                        FROM comment as c
                                        JOIN client as cl
                                            ON c.Id_user = cl.ID
                                        WHERE ID_post = ? 
                                            AND validate = 1", __CLASS__, false, [$id_post]);
    }

    /**
     * @return mixed
     */
    public static function getNotValidate()
    {
        return AppFactory::query("SELECT c.ID as id_comment, p.ID as id_post, p.title, c.comment, c.Id_user FROM comment as c
                                    JOIN post as p
                                        ON c.ID_post = p.ID
                                    WHERE c.validate = 0
                                    ORDER BY p.ID, c.ID", __CLASS__);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __GET($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }
}
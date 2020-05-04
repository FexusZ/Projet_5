<?php

namespace APP\Moderator;

/**
 * Class ValideComment
 * @package APP\Moderator
 */
class ValideComment extends Comment
{

    /**
     * @return mixed
     */
    public function valide()
    {
        if (!empty($this->message)) {
            return $this->message;
        }
        \APP\AppFactory::query('UPDATE comment SET validate = 1 WHERE ID = :id', NULL, 'No', [':id' => $this->ID_comment]);
    }
}
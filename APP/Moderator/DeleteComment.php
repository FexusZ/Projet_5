<?php

namespace APP\Moderator;
/**
 * Class DeleteComment
 * @package APP\Moderator
 */
class DeleteComment extends Comment
{

    /**
     * @return mixed
     */
    public function delete()
    {
        if (!empty($this->message)) {
            return $this->message;
        }
        \APP\App::query('DELETE FROM comment WHERE ID = :id', null, 'No', [':id' => $this->ID_comment]);
    }
}
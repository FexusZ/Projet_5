<?php

namespace APP\Moderator;

use APP\AppFactory;

/**
 * Class Comment
 * @package APP\Moderator
 */
class Comment
{
    /**
     * @var
     */
    protected $ID_comment;
    /**
     * @var
     */
    protected $message;

    /**
     * Comment constructor.
     * @param $id_comment
     */
    public function __construct($id_comment)
    {
        $this->setId_comment($id_comment);
    }

    /**
     * @param $id
     */
    protected function setId_comment($id)
    {
        $test_id = AppFactory::query('SELECT * FROM comment WHERE ID = :id', NULL, true,
            [
                ':id' => $id,
            ]);
        if (is_int($id) && !empty($test_id)) {
            $this->ID_comment = $id;
            return;
        }
        $this->message['id_comment'] = '<p class="error">ID de commentaire incorrect.</p>';
    }
}
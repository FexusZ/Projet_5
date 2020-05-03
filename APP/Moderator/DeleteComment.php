<?php
    namespace APP\Moderator;

    /**
     * 
     */
    class DeleteComment extends Comment
    {
        
        public function delete()
        {
            if (!empty($this->message)) {
                return $this->message;
            }
            \APP\AppFactory::query('DELETE FROM comment WHERE ID = :id', NULL, 'No', [':id' => $this->ID_comment]);
        }
    }
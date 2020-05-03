<?php
    namespace APP\Controllers;

    /**
     * 
     */
    class Moderator extends \Core\MVC\Controllers
    {
        protected $models = array('Moderator');

        public function checkComment()
        {
            $param['article'] = $this->Moderator->getNotValidatePost();
            $this->set($param);         
            $this->render('checkComment');
        }
    }
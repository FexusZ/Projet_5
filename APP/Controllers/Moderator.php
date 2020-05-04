<?php

namespace APP\Controllers;
/**
 * Class Moderator
 * @package APP\Controllers
 */
class Moderator extends \Core\MVC\Controllers
{
    /**
     * @var string[]
     */
    protected $models = array('Moderator');

    /**
     *
     */
    public function checkComment()
    {
        $param['article'] = $this->Moderator->getNotValidatePost();
        $this->set($param);
        $this->render('checkComment');
    }
}
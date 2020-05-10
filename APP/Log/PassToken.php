<?php

namespace APP\Log;

/**
 * Class PassToken
 * @package APP\Log
 */
class PassToken extends Log
{
    /**
     * @param $token
     */
    protected function setToken($token)
    {
        $this->token = htmlspecialchars($token);
    }

    /**
     * @return array
     */
    public function send()
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        \APP\App::query('UPDATE client SET password = :password, pass_token = 1 WHERE token = :token AND pass_token = 0',
            null, 'No',
            [
                ':token' => $this->token,
                ':password' => $this->password
            ]);
        \APP\App::header('Location: /login/signin/change_pass');
    }
}
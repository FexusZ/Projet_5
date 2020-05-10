<?php

namespace APP\Controllers;

/**
 * Class Login
 * @package APP\Controllers
 */
class Login extends \Core\MVC\Controllers
{
    /**
     *
     */
    public function signin()
    {
        $this->render('signin');
    }

    /**
     *
     */
    public function signup()
    {
        $this->render('signup');
    }

    /**
     *
     */
    public function forgotPass()
    {
        $this->render('forgotPass');
    }

    /**
     *
     */
    public function logout()
    {
        $this->render('logout');
    }

    /**
     * @param $token
     */
    public function tokenPass($token)
    {
        $test_token = \APP\App::query('SELECT pass_token FROM client WHERE token = :token', null, true,
            [':token' => $token]);
        if ($test_token) {
            if ($test_token->pass_token == 0) {
                $message = '';
            } else {
                $message = '<p class="error">Mot de passe déjà changé</p>';
            }
        } else {
            $message = '<p class="error">Le token indiqué ne correspond a aucun compte</p>';
        }

        $param['message'] = $message;
        $param['token'] = $token;
        $this->set($param);
        $this->render('tokenPass');
    }

    /**
     * @param $token
     */
    public function token($token)
    {
        $test_token = \APP\App::query('SELECT token_use FROM client WHERE token = :token', null, true,
            [
                ':token' => $token
            ]);
        if ($test_token) {
            if ($test_token->token_use == 0) {
                $message = '<p class="success">Compte Validé </p>';
                \APP\App::query('UPDATE client SET token_use = 1 WHERE token = :token', null, 'No',
                    [
                        ':token' => $token
                    ]);
            } else {
                $message = '<p class="error">Compte déjà validé</p>';
            }
        } else {
            $message = '<p class="error">Le token indiqué ne correspond a aucun compte</p>';
        }

        $param['token'] = $message;
        $this->set($param);
        $this->render('signin');
    }
}
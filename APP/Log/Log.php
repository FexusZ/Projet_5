<?php

namespace APP\Log;
/**
 * Class Log
 * @package APP\Log
 */
class Log
{
    /**
     * @var array
     */
    protected $message = array();
    /**
     * @var
     */
    protected $username;
    /**
     * @var
     */
    protected $password;
    /**
     * @var
     */
    protected $email;
    /**
     * @var
     */
    protected $first_name;
    /**
     * @var
     */
    protected $last_name;
    /**
     * @var
     */
    protected $token;

    /**
     * Log constructor.
     * @param $array
     */
    public function __construct($array)
    {
        foreach ($array as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param $password
     */
    protected function setConfirm_password($password)
    {
        if ($password === $this->password) {
            if (!empty($password)) {
                $this->password = hash('sha512', $password);
                $this->password = substr($this->password, 22, -2) ?: $this->password;
                $this->password = substr($this->password, 32, -3) ?: $this->password;
                $this->password = substr($this->password, 80, -4) ?: $this->password;
                $this->password = substr($this->password, 70, -6) ?: $this->password;
                return;
            }
        }elseif(empty($this->password)){
            $this->message['confirm_password'] = '<p class="error"> Confirmation vide </p>';
            return;
        }
        $this->message['confirm_password'] = '<p class="error"> Mot de passe et confirmation différent </p>';
    }

    /**
     * @param $password
     */
    protected function setPassword($password)
    {
        if (empty($password) || strlen($password) < 8) {
            $this->message['password'] = '<p class="error"> Veuillez renseigner un mot de passe valide </p>';
            return;
        }
        $this->password = htmlspecialchars($password);
    }
}
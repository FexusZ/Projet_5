<?php

namespace APP\Log;

/**
 * Class Signin
 * @package APP\Log
 */
class Signin
{

    private $session;
    /**
     * Signin constructor.
     * @param $array
     */
    public function __construct($array)
    {
        $this->session = new \APP\Config\Request();
        foreach ($array as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param $username
     */
    private function setUsername($username)
    {
        $this->username = htmlspecialchars($username);
    }

    /**
     * @param $password
     */
    private function setPassword($password)
    {
        if (!empty($password)) {
            $this->password = hash('sha512', $password);
            $this->password = substr($this->password, 22, -2) ?: $this->password;
            $this->password = substr($this->password, 32, -3) ?: $this->password;
            $this->password = substr($this->password, 80, -4) ?: $this->password;
            $this->password = substr($this->password, 70, -6) ?: $this->password;
            return;
        }
        $this->password = '';
    }

    /**
     * @return string
     */
    public function signin()
    {
        $param = \APP\AppFactory::query('SELECT * FROM client WHERE (username = :username OR email = :username) AND password = :password',
            null, true,
            [
                ':username' => $this->username,
                ':password' => $this->password
            ]);
        return $this->hydrate($param);
    }


    /**
     * Permet d'hydrater les données a envoyer en session
     * @param $param
     * @return string
     */
    private function hydrate($param)
    {
        if ($param == null) {
            return '<p class="error"> Mauvais identifiant </p>';
        }
        if ($param->token_use == 0) {
            return '<p class="error">Compte non validé </p>';
        }
        $this->session->getSession()->setLogin('ID', (int)$param->ID);
        $this->session->getSession()->setLogin('acces', (int)$param->acces);

        $ticket = bin2hex(random_bytes(64));
        
        $this->session->getSession()->setLogin('ticket', $ticket);

        \APP\AppFactory::query('UPDATE client SET ticket = :ticket WHERE ID = :ID', NULL, 'No', 
            [':ID'  =>  (int)$param->ID, ':ticket'  =>  $ticket]);

        sleep(1);
        \APP\AppFactory::header('Location: /home/index/');
    }
}
<?php
    namespace APP\Log;
    /**
     * 
     */
    class Signin
    {
        private $array = array();
        
        public function __construct($array)
        {
            foreach ($array as $key => $value) {
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }   
            }
        }

        private function setUsername($username)
        {
            $this->username         = htmlspecialchars($username);
        }

        private function setPassword($password)
        {
            if (!empty($password)) {
                $this->password = hash('sha512', $password);
                $this->password = substr($this->password, 22, -2)?:$this->password;
                $this->password = substr($this->password, 32, -3)?:$this->password;
                $this->password = substr($this->password, 80, -4)?:$this->password;
                $this->password = substr($this->password, 70, -6)?:$this->password;
            } else {
                $this->password ='';
            }
        }

        public function signin()
        {
            $param = \APP\AppFactory::query('SELECT * FROM client WHERE (username = :username OR email = :username) AND password = :password',
                                NULL, true, 
                                [
                                    ':username'     =>  $this->username,
                                    ':password'     =>  $this->password
                                ]);
            return $this->hydrate($param);
        }

        /**
        * Permet d'hydrater les données a envoyer en session
        * @param array
        */
        private function hydrate($param)
        {
            if ($param == NULL) {
                return '<p class="error"> Mauvais identifiant </p>';
            }
            if ($param->token_use == 0) {
                return '<p class="error">Compte non validé </p>';
            }
            $_SESSION['login']->ID = (int) $param->ID;
            $_SESSION['login']->acces = (int) $param->acces;
            sleep(2);
            \APP\AppFactory::header('Location: /home/index/');
        }
    }
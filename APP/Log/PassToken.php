<?php
    namespace APP\Log;
    /**
     * 
     */
    class PassToken extends Log
    {
        public function __construct($array)
        {
            foreach ($array as $key => $value) {
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }   
            }
        }

        private function setPassword($password)
        {
            if (empty($password) && strlen($password) > 8) {
                $this->message['password']  = '<p class="error"> Veuillez renseigner un mot de passe valide </p>';
                return; 
            }
            $this->password = $password;
        }

        private function setToken($token)
        {
                $this->token = htmlspecialchars($token);
        }

        public function send()
        {
            if (!empty($this->message)) {
                return $this->message;
            }

            \APP\AppFactory::query('UPDATE client SET password = :password, pass_token = 1 WHERE token = :token AND pass_token = 0',
                                NULL, 'No', 
                                [
                                    ':token'        =>  $this->token,
                                    ':password'     =>  $this->password
                                ]);
            \APP\AppFactory::header('Location: /login/signin/change_pass');
        }
    }
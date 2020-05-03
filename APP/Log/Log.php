<?php
    namespace APP\Log;
    /**
     * 
     */
    class Log
    {
        protected $message = array();
        protected $username;
        protected $password;
        protected $email;
        protected $first_name;
        protected $last_name;
        protected $token;

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
                $this->message['confirm_password'] = '<p class="error"> Confirmation vide </p>';
            }
            $this->message['confirm_password'] = '<p class="error"> Mot de passe et confirmation différent </p>';
        }
    }
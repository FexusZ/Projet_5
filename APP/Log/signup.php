<?php

namespace APP\Log;

/**
 * Class Signup
 * @package APP\Log
 */
class Signup extends Log
{
    /**
     * @var array
     */
    private $message = array();

    /**
     * Signup constructor.
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
     * @param $first_name
     */
    private function setFirst_name($first_name)
    {
        if (empty($first_name)) {
            $this->message['firstname'] = '<p class="error"> Veuillez renseigner un prenom </p>';
            return;
        }
        $this->first_name = htmlspecialchars($first_name);
    }

    /**
     * @param $last_name
     */
    private function setLast_name($last_name)
    {
        if (empty($last_name)) {
            $this->message['lastname'] = '<p class="error"> Veuillez renseigner un nom </p>';
            return;
        }
        $this->last_name = htmlspecialchars($last_name);
    }

    /**
     * @param $username
     */
    private function setUsername($username)
    {
        $verif_username = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE username = ?', NULL, true, [$username]);
        if (empty($username)) {
            $this->message['username'] = '<p class="error"> Veuillez renseigner un nom de compte </p>';
        } elseif ($verif_username->nb !== '0') {
            $this->message['username'] = '<p class="error"> Nom de compte indisponible </p>';
        }
        $this->username = htmlspecialchars($username);
    }

    /**
     * @param $email
     */
    private function setEmail($email)
    {
        $verif_email = \APP\AppFactory::query('SELECT count(*) as nb FROM client WHERE email = ?', NULL, true, [$email]);

        if (empty($email)) {
            $this->message['email'] = '<p class="error"> Veuillez renseigner un email </p>';
        } elseif ($verif_email->nb !== '0') {
            $this->message['email'] = '<p class="error"> Email indisponible </p>';
        } elseif (preg_match('#^(([a-zA-Z0-9\.-_])+)@(([a-zA-Z-0-9\.-_])+)\.(([a-z])+)$#', trim($email)) === 0) {
            $this->message['email'] = '<p class="error"> Email non valide </p>';
        }
        $this->email = htmlspecialchars($email);
    }

    /**
     * @param $password
     */
    private function setPassword($password)
    {
        if (empty($password) && strlen($password) > 8) {
            $this->message['password'] = '<p class="error"> Veuillez renseigner un mot de passe valide </p>';
            return;
        }
        $this->password = htmlspecialchars($password);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function signup()
    {
        if (!empty($this->message)) {
            return $this->message;
        }
        $token = bin2hex(random_bytes(64));
        \APP\AppFactory::query('INSERT INTO client(firstname, lastname, username, email, password, acces, registration, token)
                                VALUES(:firstname, :lastname, :username, :email, :password, :access, :registration, :token)',
            NULL, 'No',
            [
                ':firstname' => $this->first_name,
                ':lastname' => $this->last_name,
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password,
                ':access' => 1,
                ':registration' => time(),
                ':token' => $token
            ]);
        $sujet = 'Valider votre compte';
        $message = '<a href="http://projet5/login/token/' . $token . '"> Valider mon compte </a>';
        $destinataire = $this->email;
        $headers = "From: <fexus.j.sebastien@gmail.com>\n";
        $headers .= "Reply-To: fexus.j.sebastien@gmail.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        \APP\AppFactory::mail($destinataire, $sujet, $message, $headers);
        \APP\AppFactory::header('Location: /login/signin/validate');
    }
}
<?php

namespace APP\Log;
/**
 * Class ForgoutPass
 * @package APP\Log
 */
class ForgotPass
{
    /**
     * ForgoutPass constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $this->setEmail($email);
    }

    /**
     * @param $email
     */
    protected function setEmail($email)
    {
        $verif_email = \APP\App::query('SELECT count(*) as nb FROM client WHERE email = ?', null, true, [$email]);
        if (empty($email)) {
            $this->message['email'] = '<p class="error"> Veuillez renseigner un email </p>';
        } elseif ((int)$verif_email->nb === 0) {
            $this->message['email'] = '<p class="error"> Cette email ne correspond a aucun compte </p>';
        } elseif (preg_match('#((a-zA-Z0-9\.-_)@(a-zA-Z-0-9\.-_)\.([a-z]))#', trim($email))) {
            $this->message['email'] = '<p class="error"> Email non valide </p>';
        }
        $this->email = $email;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function send()
    {
        if (!empty($this->message['email'])) {
            return $this->message;
        }
        $token = bin2hex(random_bytes(64));
        \APP\App::query('UPDATE client SET token = :token, pass_token = 0 WHERE email = :email',
            null, 'No',
            [
                ':email' => $this->email,
                ':token' => $token
            ]);
        $sujet = 'Modification de mot de passe';
        $message = '<a href="http://projet5/login/tokenPass/' . $token . '"> Modifier mon mot de passe </a>';
        $destinataire = $this->email;
        $headers = "From: <fexus.j.sebastien@gmail.com>\n";
        $headers .= "Reply-To: fexus.j.sebastien@gmail.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        \APP\App::mail($destinataire, $sujet, $message, $headers);
        \APP\App::header('Location: /login/signin/validate_pass');
    }
}
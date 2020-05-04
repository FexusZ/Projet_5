<?php

namespace APP\Contact;

/**
 * Class Contact
 * @package APP\Contact
 */
class Contact
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $subject;
    /**
     * @var
     */
    private $content;
    /**
     * @var array
     */
    private $message = array();

    /**
     * Contact constructor.
     * @param $array
     */
    public function __construct($array)
    {
        foreach ($array as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
                continue;
            }
            $this->message['error'] = '<p class="error">Modification de champs interdite</span>';
        }
    }

    /**
     * @param $name
     */
    private function setName($name)
    {
        if (!empty($name)) {
            $this->name = $name;
            return;
        }
        $this->message['name'] = '<p class="error"> Merci de remplir le champs de nom/prenom </p>';
    }

    /**
     * @param $email
     */
    private function setEmail($email)
    {
        if (!empty($email) && preg_match('#^(([a-zA-Z0-9\.-_])+)@(([a-zA-Z-0-9\.-_])+)\.(([a-z])+)$#', trim($email)) === 1) {
            $this->email = $email;
        } elseif (empty($email)) {
            $this->message['email'] = '<p class="error"> Merci de remplir un Email valide </p>';
        } else {
            $this->message['email'] = '<p class="error"> Merci de remplir le champs Email </p>';
        }
    }

    /**
     * @param $subject
     */
    private function setSubject($subject)
    {
        if (!empty($subject)) {
            $this->subject = $subject;
            return;
        }
        $this->message['subject'] = '<p class="error"> Merci de d\'indiquer un sujet </p>';
    }

    /**
     * @param $content
     */
    private function setContent($content)
    {
        if (!empty($content)) {
            $this->content = '<p> Nom : ' . $this->name . '</p><p> Email : ' . $this->email . '</p><p> Message : ' . $content . '</p>';
            return;
        }
        $this->message['content'] = '<p class="error"> Veuillez ecrire un message </p>';
    }

    /**
     * @return array
     */
    public function send()
    {
        if (!empty($this->message)) {
            return $this->message;
        }
        $this->message['success'] = '<p class="success" style="text-align:center;"> Mail envoyé. </p>';

        $headers = "From: <" . $this->email . ">\n";
        $headers .= "Reply-To: " . $this->email . "\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";

        \APP\AppFactory::mail('fexus.j.sebastien@gmail.com', $this->subject, $this->content, $headers);
        return $this->message;
    }
}


            
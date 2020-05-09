<?php

namespace APP\Post;

use APP\AppFactory;

/**
 * Class Post
 * @package APP\Post
 */
class Post
{
    /**
     * @var
     */
    protected $ID;
    /**
     * @var
     */
    protected $title;
    /**
     * @var
     */
    protected $chapo;
    /**
     * @var
     */
    protected $content;
    /**
     * @var
     */
    protected $ID_user;
    /**
     * @var
     */
    protected $last_update;
    /**
     * @var
     */
    protected $post_date;
    /**
     * @var
     */
    protected $message;

    /**
     * @param $title
     */
    protected function setTitle($title)
    {
        if ($title !== null && $title !== '' && strlen($title) <= 32) {
            $this->title = $title;
        } elseif ($title === null || $title === '') {
            $this->message['title'] = '<p class="error">Veuillez ajouter un titre.</p>';
        } else {
            $this->message['title'] = '<p class="error">Titre trop long, 32 Caractere maximum.</p>';
        }
    }

    /**
     * @param $chapo
     */
    protected function setChapo($chapo)
    {
        if ($chapo && strlen($chapo) <= 100) {
            $this->chapo = $chapo;
        } elseif ($this->content) {
            $this->chapo = substr($this->content, 0, 100);
        } elseif (!$chapo && !$this->content) {
            $this->message['chapo'] = '<p class="error">Veuillez remplir le chapo et/ou le contenu.</p>';
        } else {
            $this->message['chapo'] = '<p class="error">Chapo trop long, 100 Caractere maximum.</p>';
        }
    }

    /**
     * @param $content
     */
    protected function setContent($content)
    {
        if ($content !== null && $content !== '') {
            $this->content = $content;
            return;
        }
        $this->message['content'] = '<p class="error">Veuillez ajouter du contenu.</p>';
    }

    /**
     * @param $id
     */
    protected function setId($id)
    {
        $test_id = AppFactory::query('SELECT * FROM post WHERE ID = :id', null, true,
            [
                ':id' => $id,
            ]);
        if (is_int($id) && !empty($test_id)) {
            $this->ID = $id;
            return;
        }
        $this->message['id_post'] = '<p class="error">ID de post incorrect.</p>';
    }

    /**
     * @param $id
     */
    protected function setId_user($id)
    {
        $test_id = AppFactory::query('SELECT * FROM client WHERE ID = :id',
            null, true, [':id' => $id]);
        if (is_int($id) && !empty($test_id)) {
            $this->ID_user = $id;
            return;
        }
        $this->message['id_user'] = '<p class="error">ID d\'utilisateur incorrect.</p>';
    }

    /**
     *
     */
    protected function setLast_update()
    {
        $this->last_update = time();
    }

    /**
     *
     */
    protected function setPost_date()
    {
        $this->post_date = time();
    }
}
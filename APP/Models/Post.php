<?php
    namespace APP\Models;
    use APP\AppFactory;

    class Post extends \Core\MVC\Models
    {
        protected $db;
        protected $table;

        public static function getAll()
        {
            return AppFactory::query("SELECT * FROM post", __CLASS__);
        }

        public static function getLast()
        {
            return AppFactory::query("SELECT * FROM post LIMIT 5", __CLASS__);
        }

        public static function getPost($id)
        {
            return AppFactory::query('SELECT * FROM post WHERE id = ?', __CLASS__, true, [$id]);
        }

        public function getUrl()
        {
            return '/post/post/'. $this->ID;
        }

        public function getChapo()
        {
            str_replace("\n", '</br>', $this->chapo);
            return '<p>'. $this->chapo . '... <a href='. $this->getUrl() .'>Voir la suite</a>';
        }

        public function getTitle()
        {
            return '<h2>'. $this->title .'</h2>';
        }

        public function getAuthor()
        {
            $author = AppFactory::query('SELECT concat(firstname, " ", lastname) as author FROM client WHERE ID = :ID', NULL, true, [':ID'  =>  $this->ID_user])->author;
            $update_author = AppFactory::query('SELECT concat(firstname, " ", lastname) as author FROM client WHERE ID = :ID', NULL, true, [':ID'   =>  $this->update_ID_user])->author;

            return '<p> Publication faite le : '.date('d-m-Y', $this->post_date).', par : '.$author.'  </br> Derniere modification faite le : '.date('d-m-Y', $this->last_update).', par : '.$update_author.'</p>';
        }

        public function getContent()
        {
            return '<p>'.nl2br($this->chapo).'</p><p>'. nl2br($this->content) .'</p>';
        }
    }
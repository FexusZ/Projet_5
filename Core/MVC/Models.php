<?php
    namespace Core\MVC;

    /**
     * 
     */
    class Models
    {
        public function __GET($key)
        {
            $method = 'get'.ucfirst($key);
            $this->$key = $this->$method();
            return $this->$key;
        }
        
        public function getAuthor()
        {
            return '<p>'.$this->author.' le : '.date('d-m-Y', $this->post_date).'</p>';
        }

        public function getContent()
        {
            return '<p>'. nl2br($this->comment) .'</p>';
        }
    }
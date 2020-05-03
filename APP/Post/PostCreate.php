<?php
    namespace APP\Post;
    use APP\AppFactory;
    /**
     * 
     */
    class PostCreate extends Post
    {
        
        public function __construct($title, $chapo, $content, $id)
        {
            $this->setTitle($title);

            $this->setContent($content);

            $this->setChapo($chapo);

            $this->setId_user($id);

            $this->setLast_update();

            $this->setPost_date();
        }

        private function setId_user($id)
        {
            $test_id = AppFactory::query('SELECT * FROM client WHERE ID = :id', NULL, true, array(':id' => $id));
            if (is_int($id) && $test_id) {
                $this->ID_user = $id;
                return;
            }
            $this->message['id_user'] = '<p class="error">ID d\'utilisateur incorrect.</p>';
        }

        public function insert()
        {

            if (!empty($this->message)) {
                return $this->message;
            }
            AppFactory::query('INSERT INTO post(title, chapo, content, ID_user, update_ID_user, last_update, post_date)
                VALUES(:title, :chapo, :content, :ID_user, :ID_user, :last_update, :post_date)',
                NULL, 'No',
                [
                    ':title'        =>  $this->title,
                    ':chapo'        =>  $this->chapo,
                    ':content'      =>  $this->content,
                    ':ID_user'      =>  $this->ID_user,
                    ':last_update'  =>  $this->last_update,
                    ':post_date'    =>  $this->post_date
                ]);
                $last_id = AppFactory::query('SELECT MAX(ID) as ID FROM post', NULL, true)->ID;
                AppFactory::header('Location: /post/post/'.$last_id);
        }
    }
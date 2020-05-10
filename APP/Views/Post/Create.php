<?php
if (empty($session->get('login')) || $session->get('login')->acces !== 10) {

    APP\App::header('Location: /home/error/');
} else {

    if (!empty($post->getParameter()) && $post->get('token') === $session->get('login')->token) {

        $title = htmlspecialchars($post->get('title') ?: '');
        $chapo = htmlspecialchars($post->get('chapo') ?: '');
        $content = htmlspecialchars($post->get('content') ?: '');
        $id_session = (int)$session->get('login')->ID ?: 0;

        $post = new APP\Post\PostCreate($title, $chapo, $content, $id_session);
        $message = $post->insert();
    }
    ?>

    <style type="text/css">
        .title {
            margin-top: 20px;
            width: 70%;
            /*width: 270px;*/
            text-align: center;
            font-size: 20px;
        }

        .chapo {
            font-size: 20px;
        }

        .content {
            margin-top: 20px;
            font-size: 20px;
            min-height: 250px !important;
        }

        .post {
            text-align: center;
        }

        #input_post {
            margin-top: 20px;
        }
    </style>

    <div class="container container3 post">
        <div class="row">
            <form method="post">
                <h2>Création d'un Post</h2>
                <input type="text" name="title" class="form-control title" placeholder="Titre">
                <?php if (!empty($message['title'])) echo $message['title'] . "\n"; ?>

                <h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu.">
                    Chapô : </h3>
                <textarea name='chapo' class="form-control chapo" aria-label="With textarea"></textarea>
                <?php if (!empty($message['chapo'])) echo $message['chapo'] . "\n"; ?>


                <textarea name='content' class="form-control content" aria-label="With textarea"></textarea>
                <?php if (!empty($message['content'])) echo $message['content'] . "\n"; ?>

                <p id='input_post'>
                    <input type="submit" value="Créer" class='btn'>
                </p>
                <?php if (!empty($message['id_user'])) echo $message['id_user'] . "\n"; ?>
                <input type="hidden" name="token" value='<?= $session->get('login')->token ?>'>
            </form>
        </div>
    </div>
    <?php
}
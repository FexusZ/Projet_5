<?php

if (empty($session->get('login')) || $session->get('login')->acces !== 10) {

    \APP\AppFactory::header('Location: /home/error/');
} else {

    if (!empty($post->getParameter())) {

        $title = htmlspecialchars($post->get('title') ?: '');
        $chapo = htmlspecialchars($post->get('chapo') ?: '');
        $content = htmlspecialchars($post->get('content') ?: '');
        $id = (int)$article->ID ?: 0;
        $id_session = (int)$session->get('login')->ID ?: 0;
        if (!empty($post->get('update'))) {

            $update = new APP\Post\PostUpdate($title, $chapo, $content, $id, $id_session);
            $message = $update->update();
        } elseif (!empty($post->get('delete'))) {

            $delete = new APP\Post\PostDelete($id, $id_session);
            $message = $delete->delete();
        }
    }
    ?>

    <style type="text/css">
        .title {
            margin-top: 20px;
            width: 70%;
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

    <div class="container post container3">
        <div class="row">
            <form method="post">
                <h2>Modification d'un Post</h2>

                <input type="text" name="title" class="form-control title" placeholder="Titre"
                       value='<?= $article->title . "\n"; ?>'>
                <?php if (!empty($message['title'])) echo $message['title'] . "\n"; ?>

                <h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu.">
                    Chapô : </h3>
                <textarea name='chapo' class="form-control chapo"
                          aria-label="With textarea"><?= $article->chapo . "\n"; ?></textarea>
                <?php if (!empty($message['chapo'])) echo $message['chapo'] . "\n"; ?>

                <textarea name='content' class="form-control content"
                          aria-label="With textarea"><?= $article->content . "\n"; ?></textarea>
                <?php if (!empty($message['content'])) echo $message['content'] . "\n"; ?>

                <?php if (!empty($message['id_post'])) echo $message['id_post'] . "\n"; ?>
                <?php if (!empty($message['id_user'])) echo $message['id_user'] . "\n"; ?>

                <p id='input_post'>
                    <input type="submit" name='update' value="Modifier" class='btn'>
                    <input type="submit" name='delete' value="Supprimer" class='btn'>
                </p>
            </form>
        </div>
    </div>
    <?php
}
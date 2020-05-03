<?php
    if (empty($article)) {

        APP\AppFactory::header('Location: /home/error/');
    } else {

        if (!empty($post->getParameter()) && !empty($session->get('login'))) {

            $comment = htmlspecialchars($post->get('comment') ?: 0);
            $id_session = (int) $session->get('login')->ID ?: 0;
            $id = intval($post->ID ?: 0);
            
            $new_comment = new APP\Post\PostComment($comment, $id_session, $id);
            $message = $new_comment->send();
        }
?>

<style type="text/css">
    hr
    {
        border-top: 1px solid #000;
    }
</style>
<!-- /.navbar -->
<div class="container container3">
    <div class="row">
        <div class='col-sm-12'>
            <?= $article->Title."\n"; ?>
            <?= $article->Content."\n"; ?>
            <?= $article->Author."\n"; ?>
            <?php if (!empty($session->get('login')) && $session->get('login')->acces) echo "<a href='/post/update/".$article->ID."'> Modifier le post </a>\n"; ?>
        </div>  
    </div>
    <hr>
    <div class="row">
        <div class='col-sm-12'>

            <h3>Commentaires : </h3>
            <?php 
            if (!empty($comment)) {
                foreach ($comment as $key => $value) : ?>
                    <div style="border:solid 1px; margin-bottom: 10px;background-color: rgba(50,50,50,0.1);">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $value->Author."\n"; ?>
                                    <?= $value->content."\n"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; 
            }
            if (!empty($session->get('login'))) {
            ?>
                <form method="post">
                    <p><strong> Nouveau commentaire : </strong></p>
                    <p>
                        <textarea name='comment' style="min-width: 100%;max-width: 100%;height: 100px;"></textarea>
                    </p>
                    <p style='text-align: right;'>
                        <input type="submit" name="" class="btn" value="Envoyer">
                    </p>
                    <?php if (!empty($message['success'])) echo $message['success']."\n"; ?>
                    <?php if (!empty($message['comment'])) echo $message['comment']."\n"; ?>
                    <?php if (!empty($message['id_user'])) echo $message['id_user']."\n"; ?>
                    <?php if (!empty($message['id_post'])) echo $message['id_post']."\n"; ?>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
    }
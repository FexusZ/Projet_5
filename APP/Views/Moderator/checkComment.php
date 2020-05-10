<?php
if (empty($session->get('login')) || $session->get('login')->acces !== 10) {

    APP\App::header('Location: /home/error/');
} else {

    if (!empty($post->getParameter()) && $post->get('token') === $session->get('login')->token) {

        $id = (int)$post->get('id_comment') ?: 0;

        if (!empty($post->get('valide_comment'))) {

            $valide = new APP\Moderator\ValideComment($id);
            $message = $valide->valide();
        } elseif (!empty($post->get('delete_comment'))) {

            $delete = new APP\Moderator\DeleteComment($id);
            $message = $delete->delete();
        }
    }
    ?>

    <div class="container container3">
        <div class="row">
            <div class="col-sm-12">
                <?php foreach ($article as $comment): ?>
                    <?= $comment->Title . "\n"; ?>
                    <?php foreach (APP\Models\Moderator::getNotValidateComment($comment->id_post) as $value): ?>
                        <div style="border:solid 1px; margin-bottom: 10px;background-color: rgba(100,100,100,0.1);">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?= $value->Author . "\n"; ?>
                                        <?= $value->Content . "\n"; ?>
                                        <form style="text-align: center;" method="post">
                                            <input type="hidden" name="id_comment" value='<?= $value->id_comment."\n" ?>'>
                                            <input type="submit" name="valide_comment" class="btn"
                                                   value="Valider le commentaire">
                                            <input type="submit" name="delete_comment" class="btn"
                                                   value="Supprimer le commentaire">
                                            <input type="hidden" name="token" value='<?= $session->get('login')->token ?>'>
                                        </form>
                                        <?php if (isset($message['id_comment'])) echo $message['id_comment'] . "\n"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}
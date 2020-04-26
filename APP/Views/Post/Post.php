<?php
    if (empty($post)) 
    {
        header('Location: http://projet5/home/index/');
    }
    else
    {


        if (!empty($_SESSION['login']) && isset($_POST['comment'])) 
        {
            $new_comment = new APP\Post\PostComment($_POST['comment'], intval($_SESSION['login']->ID), intval($post->ID));
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
    		<?= $post->post_title ?>
    		<?= $post->post_content ?>
    		<?= $post->author ?>

            <?php
                if (isset($_SESSION['login']) && $_SESSION['login']->acces == 10) {
                    echo "<a href='http://projet5/post/update/".$post->ID."'> Modifier le post </a>";
                }
            ?>
        </div>  
	</div>
    <hr>
    <div class="row">
        <div class='col-sm-12'>

            <h3>Commentaires : </h3>
            
            <?php 
            if (!empty($comment)) {
                var_dump($comment);
                foreach ($comment as $key => $value) : ?>
                <?= $value->author ?>
                <?= $value->content ?>
            
            <?php endforeach; 
            }
            ?>

            <form method="post">
                <p><strong> Nouveau commentaire : </strong></p>
                <p>
                    <textarea name='comment' style="min-width: 100%;max-width: 100%;height: 100px;"></textarea>
                </p>
                <p style='text-align: right;'>
                    <input type="submit" name="" class="btn" value="Envoyer">
                </p>
                <?php if (!empty($message['success'])) echo $message['success']; ?>
                <?php if (!empty($message['comment'])) echo $message['comment']; ?>
                <?php if (!empty($message['id_user'])) echo $message['id_user']; ?>
                <?php if (!empty($message['id_post'])) echo $message['id_post']; ?>
            </form>
        </div>
    </div>
</div>
<?php
    }
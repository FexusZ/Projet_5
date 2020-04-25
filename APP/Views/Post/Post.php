<style type="text/css">
    hr
    {
        border-top: 1px solid #000;
    }
</style>
<!-- /.navbar -->
<div class="container" style='padding-top: 120px;'>
	<div class="row">
		<?= $post->post_title ?>
		<?= $post->post_content ?>
		<?= $post->author ?>

        <?php
            if (isset($_SESSION['login']) && $_SESSION['login']->acces == 10) {
                echo "<a href='http://projet5/post/update/".$post->ID."'> Modifier le post </a>";
            }
        ?>
            
	</div>
    <hr>
    <div class="row">
        <h3>Commentaires : </h3>
            
    </div>
</div>
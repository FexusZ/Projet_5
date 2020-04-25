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
        </div>
    </div>
</div>
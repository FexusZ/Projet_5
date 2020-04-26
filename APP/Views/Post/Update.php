<?php

	if (!isset($_SESSION['login']) || $_SESSION['login']->acces != 10 || empty($post)) 
    {
        header('Location: http://projet5/home/index/');
    }
    else
    {
		if (isset($_POST) && !empty($_POST)) 
		{
			if (isset($_POST['update'])) 
			{
				$update = new APP\Post\PostUpdate($_POST['title'],$_POST['chapo'],$_POST['content'],intval($post->ID),intval($_SESSION['login']->ID));
				$message = $update->update();
			}
			elseif(isset($_POST['delete']))
			{
				$delete = new APP\Post\PostDelete(intval($post->ID),intval($_SESSION['login']->ID));
				$message = $delete->delete();

			}
		}
	?>
	
	<style type="text/css">
		.title
		{
			margin-top: 20px;
			width: 70%;
			text-align: center;
			font-size: 20px;
		}
		.chapo
		{
			font-size: 20px;
		}
		.content
		{
			margin-top: 20px;
			font-size: 20px;
			min-height: 250px !important;
		}
		.post
		{
			text-align: center;
		}
		#input_post
		{
			margin-top:20px;
		}
	</style>

	<div class="container post container3">
		<div class="row">
			<form method="post">
				<h2>Modification d'un Post</h2>

				<input type="text" name="title" class="form-control title" placeholder="Titre" value='<?= $post->title ?>'>
				<?php if (!empty($message['title'])) echo $message['title']; ?>

				<h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu."> Chapô : </h3>
		  		<textarea name='chapo' class="form-control chapo" aria-label="With textarea"><?= $post->chapo ?></textarea>
				<?php if (!empty($message['chapo'])) echo $message['chapo']; ?>

		  		<textarea name='content' class="form-control content" aria-label="With textarea"><?= $post->content ?></textarea>
				<?php if (!empty($message['content'])) echo $message['content']; ?>

				<?php if (!empty($message['id_post'])) echo $message['id_post']; ?>
				<?php if (!empty($message['id_user'])) echo $message['id_user']; ?>

		  		<p id='input_post'>
		  			<input type="submit" name='update' value="Modifier" class='btn'>
		  			<input type="submit" name='delete' value="Supprimer" class='btn'>
		  		</p>
		  	</form>
		</div>
	</div>
	<?php
    }
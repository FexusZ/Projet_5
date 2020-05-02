<?php

	if (!isset($_SESSION['login']) || $_SESSION['login']->acces != 10) {
        APP\AppFactory::header('Location: /home/index/');
    } else {
		if (isset($_POST) && !empty($_POST)) {
			$title 		= htmlspecialchars($_POST['title']?:'');
			$chapo 		= htmlspecialchars($_POST['chapo']?:'');
			$content 		= htmlspecialchars($_POST['content']?:'');
			$id_session 		= intval($_SESSION['login']->ID?:'');

			$post = new APP\Post\PostCreate($title ,$chapo , $content, $id_session);
			$message = $post->insert();
		}
	?>

	<style type="text/css">
		.title
		{
			margin-top: 20px;
			width: 70%;
			/*width: 270px;*/
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

	<div class="container container3 post">
		<div class="row">
			<form method="post">
				<h2>Création d'un Post</h2>
				<input type="text" name="title" class="form-control title" placeholder="Titre">
				<?php if (!empty($message['title'])) echo $message['title']; ?>

				<h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu."> Chapô : </h3>
		  		<textarea name='chapo' class="form-control chapo" aria-label="With textarea"></textarea>
				<?php if (!empty($message['chapo'])) echo $message['chapo']; ?>


		  		<textarea name='content' class="form-control content" aria-label="With textarea"></textarea>
				<?php if (!empty($message['content'])) echo $message['content']; ?>

		  		<p id='input_post'>
		  			<input type="submit" value="Créer" class='btn'>
		  		</p>
				<?php if (!empty($message['id_user'])) echo $message['id_user']; ?>

	  		</form>
		</div>
	</div>
	<?php
	}
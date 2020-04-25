<?php

	if (!isset($_SESSION['login']) || $_SESSION['login']->acces != 10) 
    {
        header('Location: http://projet5/home/index/');
    }else{
		if (isset($_POST) && !empty($_POST)) {
			$post = new APP\Post\PostCreate($_POST['title'],$_POST['chapo'],$_POST['content'],intval($_SESSION['login']->ID));
			$last_id = $post->insert();
			header('Location:http://projet5/post/post/'.$last_id);
		}
	?>

	<style type="text/css">
		
		.title{
			margin-top: 20px;
			width: 270px;
			text-align: center;
			font-size: 20px;
		}
		.chapo{
			font-size: 20px;
		}
		.content{
			margin-top: 20px;
			font-size: 20px;
			min-height: 250px !important;

		}
		.post{
			text-align: center;
		}
		#input_post{
			margin-top:20px;
		}
	</style>

	<div class="container container3 post">
		<div class="row">
			<form method="post">
				<h2>Création d'un Post</h2>
				<input type="text" name="title" class="form-control title" placeholder="Titre">

				<h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu."> Chapô : </h3>
		  		<textarea name='chapo' class="form-control chapo" aria-label="With textarea"></textarea>


		  		<textarea name='content' class="form-control content" aria-label="With textarea"></textarea>
		  		<p id='input_post'>
		  			<input type="submit" value="Créer" class='btn'>
		  		</p>
	  		</form>
		</div>
	</div>
	<?php
	}
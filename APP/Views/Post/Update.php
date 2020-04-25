<?php
	if (isset($_POST) && !empty($_POST)) 
	{
		if (isset($_POST['update'])) 
		{
			$update = new APP\Post\PostUpdate($_POST['title'],$_POST['chapo'],$_POST['content'],intval($_POST['id']),1);
			$update->update();
			// var_dump(ROOT);
			header('Location: http://projet5/post/post/'.$_POST['id']);
		}
		elseif(isset($_POST['delete']))
		{
			$delete = new APP\Post\PostDelete(intval($_POST['id']),1);
			$delete->delete();
			header('Location: http://projet5/home/index');

		}
	}
?>

<style type="text/css">
	
	.title{
		margin-top: 20px;
		width: 30%;
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
		padding-top: 120px;
		text-align: center;
	}
	#input_post{
		margin-top:20px;
	}
</style>

<div class="container post">
	<div class="row">
		<form method="post">
			<h2>Modification d'un Post</h2>

			<input type="text" name="title" class="form-control title" placeholder="Titre" value='<?= $post->title ?>'>

			<h3 Title="Le chapô est un résumé du contenu de l'article, si il n'est pas rempli il reprendra les 150 premier caractere du contenu."> Chapô : </h3>

	  		<textarea name='chapo' class="form-control chapo" aria-label="With textarea"><?= $post->chapo ?></textarea>

	  		<textarea name='content' class="form-control content" aria-label="With textarea"><?= $post->content ?></textarea>

	  		<input type="hidden" name="id" value="<?= $post->ID?>">
	  		<p id='input_post'>
	  			<input type="submit" name='update' value="Modifier" class='btn'>
	  			<input type="submit" name='delete' value="Supprimer" class='btn'>
	  		</p>
	  	</form>
	</div>
</div>
<?php
	if (!isset($_SESSION['login']) || $_SESSION['login']->acces != 10) {
        APP\AppFactory::header('Location: /home/index/');
    } else {
		if (isset($_POST) && !empty($_POST['id_comment'])) {
			if (isset($_POST['valide_comment'])) {
				$valide = new APP\Moderator\ValideComment(intval($_POST['id_comment']));
				$message = $valide->valide();
			} elseif (isset($_POST['delete_comment'])) {
				$delete = new APP\Moderator\DeleteComment(intval($_POST['id_comment']));
				$message = $delete->delete();
			}
		}
?>

<div class="container container3">
	<div class="row">
		<div class="col-sm-12">
			<?php foreach ($post as $comment): ?>
				<?= $comment->Title ?>
				<?php foreach (APP\Models\Moderator::getNotValidateComment($comment->id_post) as $value): ?>
					<div style="border:solid 1px; margin-bottom: 10px;background-color: rgba(100,100,100,0.1);">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<?= $value->Author ?>
									<?= $value->Content ?>
									<form style="text-align: center;" method="post">
										<input type="hidden" name="id_comment" value='<?= $value->id_comment?>'>
										<input type="submit" name="valide_comment" class="btn" value="Valider le commentaire">
										<input type="submit" name="delete_comment" class="btn" value="Supprimer le commentaire">
									</form>
									<?php
									if (isset($message['id_comment'])) {
									 	echo $message['id_comment'];
									} 
									?>
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
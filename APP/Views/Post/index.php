
<div class="container container3">
	<div class="row">
		<?php foreach ($all as $key => $value):?>
			<div class="col-md-6" style="border:solid 1px;">
				<?= $value->post_title ?>
				<?= $value->post_chapo ?>
				<?= $value->Author ?>
			</div>
		<?php endforeach;?>
		</div>
</div>
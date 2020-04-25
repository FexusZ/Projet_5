

<!-- Header -->
<header id="head">
<div class="container">
  <div class="row">
    <h1 class="lead">Jean-Sébastien Neuhart, le développeur qu'il vous faut !</h1>
    <p class="tagline"></p>
    <p><a class="btn btn-default btn-lg" role="button">CV</a> <a class="btn btn-action btn-lg" role="button">Post</a></p>
  </div>
</div>
</header>
<!-- /Header -->

<div class="container">
	<div class="row">
    	<?php foreach ($last_post as $key => $value):?>
    		<div class="col-sm-6">
				<?= $value->post_chapo ?>
			</div>
		<?php endforeach;?>
		</div>
</div>
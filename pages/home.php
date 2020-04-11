  	<!-- Header -->
	<header id="head">
		<div class="container">
			<div class="row">
	        	<h1 class="lead">Jean-Sébastien le développeur qu'il vous faut ! </h1>
				<p class="tagline"></p>
        		<p><a class="btn btn-default btn-lg" role="button">Me contacter</a> <a class="btn btn-action btn-lg" role="button"> CV </a></p>
      		</div>
    	</div>
  	</header>
  	<!-- /Header -->

<?php foreach (APP\table\Post::getLast() as $value): ?>

	<?php var_dump($value); ?>

<?php endforeach; ?>
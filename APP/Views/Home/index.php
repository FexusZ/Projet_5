<!-- Header -->
<header id="head">
    <div class="container">
        <div class="row">
            <h1 class="lead">Jean-Sébastien Neuhart, le développeur qu'il vous faut !</h1>
            <p class="tagline"></p>
            <p> <a class="btn btn-default btn-lg" href='/home/curriculum' role="button">CV</a> 
            <a class="btn btn-action btn-lg" href='/home/conditionUtilisation/'role="button">Conditions d'utilisatation</a></p>
        </div>
    </div>
</header>
<!-- /Header -->

<div class="container container2">
    <div class="row">
        <?php foreach ($last_post as $key => $value):?>
            <div class="col-md-6" style="border:solid 1px;">
                <?= $value->Title."\n"; ?>
                <?= $value->Chapo."\n"; ?>
                <?= $value->Author."\n"; ?>
            </div>
        <?php endforeach;?>
    </div>
</div>
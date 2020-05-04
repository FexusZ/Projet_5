<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sergey Pozhilov (GetTemplate.com)">

    <title>Blog</title>

    <link rel="shortcut icon" href="../../public/images/gt_favicon.png">
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">

    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="../../public/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/blog.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home">
<main style="min-height: 75vh;">
    <?= $content . "\n"; ?>
</main>
<!-- Social links. @TODO: replace by link/instructions in template -->
<section id='social'>
    <div class="container">
        <div class="wrapper clearfix">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_linkedin_counter"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            </div>
            <!-- AddThis Button END -->
        </div>
    </div>
</section>
<!-- /social links -->
<footer id="footer">
    <div class="footer1">
        <div class="container">
            <div class="row">

                <div class="col-md-6 widget">
                    <h3 class="widget-title">Me contacter</h3>
                    <div class="widget-body">
                        <p> 06********<br>
                            <a href="mailto:#">jseb.1999@outlook.fr</a><br>
                    </div>
                </div>

                <div class="col-md-6 widget">
                    <h3 class="widget-title">Mes réseaux sociaux :</h3>
                    <div class="widget-body">
                        <p class="follow-me-icons">
                            <a href="https://github.com/FexusZ"><i class="fa fa-github fa-2"></i></a>
                            <a href="https://www.linkedin.com/in/jean-s%C3%A9batien-neuhart-152830194/"><i
                                        class="fa fa-linkedin fa-2"></i></a>
                        </p>
                    </div>
                </div>
            </div> <!-- /row of widgets -->
        </div>
    </div>
    <div class="footer2">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 widget">
                    <div class="widget-body">
                        <p class="simplenav">
                            <a href="/home/index">Accueil</a> |
                            <a href="/home/condition_utilisation">Conditions d'utilisation</a> |
                            <a href="/contact/contact">Me contacter</a> |
                        </p>
                    </div>
                </div>
                <div class="col-xs-6 widget">
                    <div class="widget-body">
                        <p class="text-right">
                            Copyright &copy; 2020, FexusZ. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a>
                        </p>
                    </div>
                </div>
            </div> <!-- /row of widgets -->
        </div>
    </div>
</footer>
<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="../../public/js/headroom.min.js"></script>
<script src="../../public/js/jQuery.headroom.min.js"></script>
<script src="../../public/js/template.js"></script>
</body>
</html>
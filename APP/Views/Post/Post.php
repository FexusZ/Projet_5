<style type="text/css">
    hr
    {
        border-top: 1px solid #000;
    }
</style>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div class="container">
        <div class="navbar-header">
            <!-- Button for smallest screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="http://projet5/home/index/"><img src="../../public/images/logo_test.png" alt="Progressus HTML5 template"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="http://projet5/home/index/">Accueil</a></li>
                <li class="active"><a href="http://projet5/post/index/">Post</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="sidebar-left.html">Left Sidebar</a></li>
                    <li class="active"><a href="sidebar-right.html">Right Sidebar</a></li>
                </ul>
                </li>
                <li><a href="?page=contact">Contact</a></li>
                <li><a class="btn" href="signin.html">SIGN IN / SIGN UP</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div> 
<!-- /.navbar -->
<div class="container" style='padding-top: 120px;'>
	<div class="row">
		<?= $post->post_title ?>
		<?= $post->post_content ?>
		<?= $post->author ?>
            
	</div>
    <hr>
    <div class="row">
        <h3>Commentaires : </h3>
            
    </div>
</div>
<?php
    if (isset($_SESSION['login'])) 
    {
        APP\AppFactory::header('Location: http://projet5/home/index/');
    }

    if (isset($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) 
    {
        $test = new APP\Log\signin($_POST);
        $message =  $test->signin();
    }
    if(!empty($_GET['p']))
    {
        $param = explode('/', $_GET['p']);
    }
?>
<style type="text/css">
    .error
    {
        color:red;
        text-align: center;
    }

    .success
    {
        color:green;
        text-align: center;
    }
</style>
<!-- container -->
<div class="container container3">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Connexion au compte</h3>
                    <p class="text-center text-muted">
                        <a href="http://projet5/login/signup/">Créer un compte</a> 
                    </p>
                    <hr>
                    <form method="post" action='http://projet5/login/signin/'>
                        <div class="top-margin">
                            <label>Username/Email <span class="text-danger">*</span></label>
                            <input name='username' type="text" class="form-control">
                        </div>
                        <div class="top-margin">
                            <label>Password <span class="text-danger">*</span></label>
                            <input name='password' type="password" class="form-control">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8">
                                <b><a href="http://projet5/login/forgot_pass/">Mot de passe oublié?</a></b>
                            </div>
                            <div class="col-lg-4 text-right">
                                <button class="btn btn-action" type="submit">Connexion</button>
                            </div>
                            <?php
                                if (!empty($message)) 
                                {
                                    echo '</br>'.$message;
                                }

                                if (isset($token) && !empty($token)) 
                                {
                                    echo "</br>".$token;
                                }
                                if ($param[2] == 'validate') 
                                {
                                    echo "<p class='success'>Un mail vous a été envoyé pour valider votre compte.</p>";
                                }
                                if ($param[2] == 'validate_pass') 
                                {
                                    echo "<p class='success'>Un mail vous a été envoyé pour modifier votre mot de passe.</p>";
                                }
                                if ($param[2] == 'change_pass') 
                                {
                                    echo "<p class='success'>Mot de passe modifié.</p>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php
if (!empty($session->get('login'))) {
    APP\App::header('Location: /home/error/');
}

if (!empty($post->getParameter())) {
    $array['username'] = htmlspecialchars($post->get('username') ?: '');
    $array['password'] = htmlspecialchars($post->get('password') ?: '');

    $test = new APP\Log\signin($array);
    $message = $test->signin();
}
if (!empty($get->get('p'))) {
    $param = explode('/', $get->get('p'));
}
?>
<style type="text/css">
    .error {
        color: red;
        text-align: center;
    }

    .success {
        color: green;
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
                        <a href="/login/signup/">Créer un compte</a>
                    </p>
                    <hr>
                    <form method="post" action='/login/signin/'>
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
                                <b><a href="/login/forgotPass/">Mot de passe oublié?</a></b>
                            </div>
                            <div class="col-lg-4 text-right">
                                <button class="btn btn-action" type="submit">Connexion</button>
                            </div>
                            <?php
                            if (!empty($message)) echo '</br>' . $message . "\n";

                            if (isset($token) && !empty($token)) echo "</br>" . $token . "\n";

                            if ($param[2] == 'validate') echo "<p class='success'>Un mail vous a été envoyé pour valider votre compte.</p>\n";

                            if ($param[2] == 'validate_pass') echo "<p class='success'>Un mail vous a été envoyé pour modifier votre mot de passe.</p>\n";

                            if ($param[2] == 'change_pass') echo "<p class='success'>Mot de passe modifié.</p>\n";
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
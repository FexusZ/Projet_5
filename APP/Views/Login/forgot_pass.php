<?php
    if (isset($_SESSION['login'])) {
        APP\AppFactory::header('Location: /home/index/');
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
		$array['email']		=	htmlspecialchars($_POST['email']?:'');

        $test = new APP\Log\Forgout_pass($array['email']);
        $message =  $test->send();
    }
?>
<style type="text/css">   
    .col-lg-4-sign
    {
    	margin-top:20px;
    	position: relative;
	    min-height: 1px;
	    padding-left: 15px;
	    padding-right: 15px;
    }
</style>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 container3">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="thin text-center">Mot de passe oublié</h3>
			<p class="text-center text-muted">Vous avez déjà un compte ? <a href="/login/signin/">Connectez vous</a></p>
			<hr>
			<form method='post'>
				<div class="top-margin">
					<label>Email <span class="text-danger">*</span></label>
					<input name="email" type="text" class="form-control">
					<?php 
						if (isset($message['email'])) {
							echo $message['email'];
						}
					?>
				</div>
				<div class="row">
					<div class="col-lg-4-sign text-right">
						<button class="btn btn-action" type="submit">Enregistrer </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>   
<?php
    if (isset($_SESSION['login'])) {
        APP\AppFactory::header('Location: /home/index/');
    }

    if (isset($_POST) && !empty($_POST)) {
    	$array['password']		=	htmlspecialchars($_POST['password']?:'');
		$array['confirm_password']		=	htmlspecialchars($_POST['confirm_password']?:'');
		$array['token']	=	htmlspecialchars($token?:'');

        $test = new APP\Log\Pass_token($array);
        $message =  $test->send();
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
			<hr>
			<form method='post'>
				<div class="top-margin">
					<label>Nouveau mot de passe <span class="text-danger">*</span></label>
					<input name="password" type="password" class="form-control">
					<?php 
						if (isset($message['password'])) echo $message['password'];
					?>
				</div>
				<div class="top-margin">
					<label>Confirmation <span class="text-danger">*</span></label>
					<input name="confirm_password" type="password" class="form-control">
					<?php 
						if (isset($message['confirm_password'])) echo $message['confirm_password'];
					?>
				</div>
				<?php 
					if (isset($message['password2'])) echo $message['password2'];
				?>
				<div class="row">
					<div class="col-lg-4-sign text-right">
						<button class="btn btn-action" type="submit">Enregistrer </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>   
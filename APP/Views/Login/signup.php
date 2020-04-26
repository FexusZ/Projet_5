<?php
    if (isset($_SESSION['login'])) {
        APP\AppFactory::header('Location: http://projet5/home/index/');
    }
    if (isset($_POST) && !empty($_POST)) {
        $test = new APP\Log\signup($_POST);
        $message = $test->signup();
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
    	position: relative;
	    min-height: 1px;
	    padding-left: 15px;
	    padding-right: 15px;
    }
</style>
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 container3">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="thin text-center">Création d'un compte</h3>
			<p class="text-center text-muted">Vous avez déjà un compte ? <a href="http://projet5/login/signin/">Connectez vous</a></p>
			<hr>
			<form method='post'>
				<div class="top-margin">
					<label>Prenom<span class="text-danger">*</span></label>
					<input name="first_name" type="text" class="form-control">
					<?php 
						if (isset($message['firstname'])) 
						{
							echo $message['firstname'];
						}
					?>
				</div>
				<div class="top-margin">
					<label>Nom<span class="text-danger">*</span></label>
					<input name="last_name" type="text" class="form-control">
					<?php 
						if (isset($message['lastname'])) 
						{
							echo $message['lastname'];
						}
					?>
				</div>
				<div class="top-margin">
					<label>Nom de compte <span class="text-danger">*</span></label>
					<input name="username" type="text" class="form-control">
					<?php 
						if (isset($message['username'])) 
						{
							echo $message['username'];
						}
					?>
				</div>
				<div class="top-margin">
					<label>Email <span class="text-danger">*</span></label>
					<input name="email" type="text" class="form-control">
					<?php 
						if (isset($message['email'])) 
						{
							echo $message['email'];
						}
					?>
				</div>

				<div class="row top-margin">
					<div class="col-sm-6">
						<label>Mot de passe <span class="text-danger">*</span></label>
						<input name="password" type="password" class="form-control">
						<?php 
						if (isset($message['Password'])) 
						{
							echo $message['Password'];
						}
					?>
					</div>
					<div class="col-sm-6">
						<label>Confirmation <span class="text-danger">*</span></label>
						<input name="confirm_password" type="password" class="form-control">
						<?php 
						if (isset($message['Confirm_password'])) 
						{
							echo $message['Confirm_password'];
						}
					?>
					</div>
				</div>
				<?php 
					if (isset($message['password2'])) 
					{
						echo $message['password2'];
					}
				?>
				<hr>
				<div class="row">
					<div class="col-lg-4-sign text-right">
						<button class="btn btn-action" type="submit">Enregistrer </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>   
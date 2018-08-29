<?php 
include('../views/partials/_header.php');

?>
<div class="container" style="padding-top: 2em ">
	
	<h1 class="text-center title">Connexion à Boom social network</h1>
	
	<form action="" method="POST" >
		
		<?php error_span('erreur_message', $_SESSION) ?>
		<!-- Le champ identifiant -->
		<div class="form-group">
			<label for="identifier" class="label-control"><?=$lang['form']['field']['identifier']?></label>
			<input value="<?= $identifier ?? '' ?>" type="text" class="form-control <?php echo has_error( 'identifier', $error_fields) ?>" placeholder="Entre votre identifiant (email ou pseudo)" required="required" name="identifier" id='identifier'>
			<?php error_span($lang['form']['field']['identifier'], $error_fields) ?>
		</div>

		<!-- Le champ mot de passe -->
		<div class="form-group">
			<label for="password" class="label-control"><?=$lang['form']['field']['password']?></label>
			<input value="<?= $password ?? '' ?>" type="password" class="form-control <?php echo has_error( 'password', $error_fields) ?>" placeholder="Entre votre mot de passe..." required="required" name="password" id='password'>
			<?php error_span($lang['form']['field']['password'], $error_fields) ?>
		</div>
		
		<!-- Le champ validation -->
		<div class="form-group">
			<input type="submit" value="Inscription" class="btn btn-success btn-block" name="connexion">
		</div>
	</form>
</div>

<?php
session_destroy();
include('../views/partials/_footer.php');

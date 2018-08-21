<?php 
include('../views/partials/_header.php');

?>
<div class="container" style="padding-top: 2em ">
	
	<h1 class="text-center title">Inscription à Boom social network</h1>

	<form action="" method="POST" novalidate="" >
		
		<!-- Le champ nom -->
		<div class="form-group">
			<label for="last_name" class="label-control"><?=$lang['form']['field']['last_name']?></label>
			<input type="text" class="form-control <?php echo has_error( "last_name", $error_fields) ?>" placeholder="Entre votre prenom..." required="required" name="last_name" id="last_name">
			<?php error_span("last_name", $error_fields) ?>
		</div>
		<!-- Le champ prenom -->
		<div class="form-group">
			<label for="first_name" class="label-control"><?=$lang['form']['field']['first_name']?></label>
			<input type="text" class="form-control <?php echo has_error( "first_name", $error_fields) ?>" placeholder="Entre votre nom..." required="required" name="first_name" id="first_name">
			<?php error_span("first_name", $error_fields) ?>
		</div>
		<!-- Le champ pseudo -->
		<div class="form-group">
			<label for="pseudo" class="label-control"><?=$lang['form']['field']['pseudo']?></label>
			<input type="text" class="form-control <?php echo has_error( "pseudo", $error_fields) ?>" placeholder="Entre votre pseudo..." required="required" name="pseudo" id="pseudo">
			<?php error_span("pseudo", $error_fields) ?>
		</div>
		<!-- Le champ email -->
		<div class="form-group">
			<label for="email" class="label-control"><?=$lang['form']['field']['email']?></label>
			<input type="email" class="form-control <?php echo has_error( "email", $error_fields) ?>" placeholder="Entre votre adresse email..." required="required" name="email" id="email">
			<?php error_span("email", $error_fields) ?>
		</div>
		<!-- Le champ mot de passe -->
		<div class="form-group">
			<label for="password" class="label-control"><?=$lang['form']['field']['password']?></label>
			<input type="password" class="form-control <?php echo has_error( "password", $error_fields) ?>" placeholder="Entre votre mot de passe..." required="required" name="password" id="password">
			<?php error_span("password", $error_fields) ?>
		</div>
		<!-- Le champ confirmer mot de passe -->
		<div class="form-group">
			<label for="password_confirm" class="label-control"><?=$lang['form']['field']['password_confirm']?></label>
			<input type="password" class="form-control <?php echo has_error( "password_confirm", $error_fields) ?>" placeholder="Entre votre mot de passe..." required="required" name="password_confirm" id="password_confirm">
			<?php error_span("password_confirm", $error_fields) ?>
		</div>
		<!-- Le champ validation -->
		<div class="form-group">
			<input type="submit" value="Inscription" class="btn btn-success btn-block" name="inscription">
		</div>
	</form>
</div>

<?php
include('../views/partials/_footer.php');

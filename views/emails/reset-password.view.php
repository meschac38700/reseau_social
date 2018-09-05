<?php include(__DIR__.'/partials/_header.php')?>
    <div class="container">
        <?php error_span('fields', $error_fields) ?>
        <h3 class="title lead"> Réinitialiser mon mot de passe !</h3>
        <p>bonjour <?= $pseudo ?>, pour réinitialiser votre mot de passe, veuillez cliquer sur le bouton ci-dessous:</p>
        <a href="<?= $reset_password_url?>" class="btn btn-primary btn-block" >Réinitialiser mon mot de passer</a>
    </div>
<?php include( __DIR__ . '/partials/_footer.php' );
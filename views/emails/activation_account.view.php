<?php include(__DIR__.'/partials/_header.php')?>
    <div class="container">
        <h3 class="title lead" >Activation du compte !</h3>
        <p>bonjour <?= $pseudo ?>, pour activer votre compte, veuillez cliquer sur le bouton ci-dessous:</p>
        <a href="<?= $activation_url?>" class="btn btn-primary btn-block" >Activer mon compte</a>
    </div>
<?php include( __DIR__ . '/partials/_footer.php' );
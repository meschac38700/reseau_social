<?php
    $title= "Reset password";
    include(__DIR__.'/partials/_header.php');
?>

    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>
        <form method="POST">
            <div class="control-group">
                <label for="password" class="label-control">Nouveau mot de passe</label>
                <input type="password"  name="password" class="form-control" required placeholder="Entrez votre nouveau mot de passe" id="email" value="<?= $email??''?>">
            </div>
            <div class="control-group">
                <label for="password_confirm" class="label-control">Confirmer votre mot de passe</label>
                <input type="password"  name="password_confirm" class="form-control" required placeholder="Confirmez le nouveau mot de passe" id="password_confirm">
            </div>
            <br>
            <div class="control-group">
                <button type="submit" name="reset-password" class="btn btn-primary btn-block" >Réinitialiser mon mot de passe</button>
            </div>
        </form>
    </div>
<?php
    include(__DIR__.'/partials/_footer.php');
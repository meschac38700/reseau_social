<?php
$title = "Reset password";
include(__DIR__ . '/partials/_header.php');
?>

    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>
        <form method="POST">
            <div class="control-group">
                <label for="email" class="label-control">Email</label>
                <input type="email"  name="email" class="form-control" required placeholder="Enter your email" id="email" value="<?= $email ?? '' ?>">
            </div>
            <br>
            <div class="control-group">
                <button type="submit" name="reset-password" class="btn btn-primary btn-block" >Réinitialiser mon mot de passe</button>
            </div>
        </form>
    </div>
<?php
include(__DIR__ . '/partials/_footer.php');
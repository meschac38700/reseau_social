<?php 

include(__DIR__.'/partials/_header.php');
?>

<div class="container">
	<h3>Bonjour <?= $_GET['user'] ?></h3>
	<p>Veuillez vous connecter à votre addresse email suivante pour activer votre compte :</p>
	<p style="color: blue;"><?= $_GET['email']?></p>
	<p>A très bientôt</p>
</div>	

<?php
include(__DIR__.'/partials/_footer.php');

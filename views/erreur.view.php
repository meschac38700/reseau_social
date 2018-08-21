<?php 

include(__DIR__.'/partials/_header.php');
?>
<div class="container" style="padding-top: 2em ">
	<div>
		<h3 class="title text-warning">Error Interne</h3>
		<p class="text-danger"> <?php echo $_SESSION['erreur_message']?> </p>
		<p class="text-danger">Veuillez rééssayer plus tard nos developpeurs sont entrain de regler le problèmes 🙂 </p>
    </div>
</div>

<?php
include(__DIR__.'/partials/_footer.php');

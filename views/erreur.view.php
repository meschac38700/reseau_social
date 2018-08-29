<?php 

include(__DIR__.'/partials/_header.php');
?>
<div class="container" style="padding-top: 2em ">
	<div>
		<h3 class="title text-warning">Error Interne</h3>
		<p class="text-danger"> <?php echo $_SESSION['erreur_message']?> </p>
		<?php if(empty($_SESSION['deadline'])) :?>
			<p class="text-danger">Veuillez rééssayer plus tard nos developpeurs sont entrain de regler le problème 🙂 </p>
		<?php else:?>
			<p class="text-danger"><?php echo $_SESSION['deadline'] ?></p>
		<?php endif ?>
	</div>
</div>

<?php
include(__DIR__.'/partials/_footer.php');

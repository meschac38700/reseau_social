<?php 
include(__DIR__.'/partials/_header.php');
?>
<div class="content" style="padding-top: 2em ">
	<div >
		<h3 class="text-success">Bienvenue <?= $_SESSION['user']['pseudo'] ?></h3>
		<?php var_dump($_SESSION); ?>
  	</div>
</div>

<?php
include(__DIR__.'/partials/_footer.php');

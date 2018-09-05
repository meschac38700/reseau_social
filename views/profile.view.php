<?php 
include(__DIR__.'/partials/_header.php');
?>
<div class="content" style="padding-top: 2em ">
	<div >
		<h3 class="text-success">Bienvenue <?= $_SESSION['user']['pseudo'] ?></h3>
		<?php var_dump($_SESSION['user']); ?>
  	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-xs-4">

		</div>
		<div class="well col-sm-8 col-md-8 col-xs-8 jumbotron ">
			<form class="well" method="post">
				<div class="row">
					<div class="col-sm-4 col-md-4 col-xs-4">
						<div class="form-group">
							<label for="last_name" class="label-control">Last name:</label>
							<input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last name" value="<?= $_SESSION['user']['last_name'] ?>">
						</div>
						<div class="form-group">
							<label for="first_name" class="label-control">First name:</label>
							<input name="first_name" id="first_name" type="text" class="form-control" placeholder="First name" value="<?= $_SESSION['user']['first_name'] ?>">
						</div>
						<div class="form-group">
							<label for="first_name" class="label-control">First name:</label>
							<input name="first_name" id="first_name" type="text" class="form-control" placeholder="First name" value="<?= $_SESSION['user']['first_name'] ?>">
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-4">
					
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include(__DIR__.'/partials/_footer.php');

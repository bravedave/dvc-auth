<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/	?>

<nav class="navbar navbar-expand navbar-light bg-light navbar-fixed-top" role="navigation">
	<a href="<?= strings::url() ?>" class="navbar-brand">
		<?= $this->data->title ?>
	</a>


	<div class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link pt-4 pb-2" href="https://github.com/bravedave/dvc-auth">
				<i class="bi bi-github"></i>
				<span class="sr-only"> GitHub</span>
			</a>
		</li>

		<li class="nav-item">
			<?= auth::button() ?>
		</li>
	</div>

</nav>
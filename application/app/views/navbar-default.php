<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/	?>

<nav class="navbar  navbar-light bg-light navbar-fixed-top" role="navigation" >
	<a href="<?= strings::url() ?>" class="navbar-brand" >
		<?= $this->data->title ?>
	</a>

	<div class="navbar-right"><?= auth::button() ?></div>

</nav>

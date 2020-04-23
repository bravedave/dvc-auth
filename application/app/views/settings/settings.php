<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/
	?>
<form method="POST" action="<? strings::url( 'settings') ?>" >
	<input type="hidden" name="action" value="update" />
	<?php
	if ( $this->data) {	?>
	<div class="form-group row">
		<div class="col">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control"
				value="<?= $this->data->name ?>" />
		</div>

	</div>

	<div class="form-group row">
		<div class="col">
			<div class="form-check">
				<label class="form-check-label">
					<input type="checkbox" name="lockdown" class="form-check-input" value="1"
						<?php if( $this->data->lockdown) print 'checked'; ?> />

					Lockdown

				</label>

			</div>

		</div>

	</div>

	<div class="form-group row">
		<div class="col">
			<button type="submit" class="btn btn-primary">update</button>

		</div>

	</div>

	<?php
	}	?>

</form>

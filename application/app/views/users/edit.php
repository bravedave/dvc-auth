<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

	$dto = $this->data->dto;
?>
<form method="post" autocomplete="off" action="<?= strings::url('users') ?>">
	<input type="hidden" name="id" value="<?= $dto->id ?>" />
	<input type="hidden" name="action" value="save/update" />

	<div class="row form-group">
		<div class="col-3 col-form-label">UserName</div>
		<div class="col-9">
			<input type="text" name="username" class="form-control" placeholder="username"
				value="<?= $dto->username ?>" required
				<?php if ( $dto->id) print 'disabled'; ?> />

		</div>

	</div>

	<div class="row form-group">
		<div class="col-3 col-form-label">Name</div>
		<div class="col-9">
			<input type="text" name="name" class="form-control" placeholder="name" required
				autofocus value="<?= $dto->name ?>" />

		</div>

	</div>

	<div class="row form-group">
		<div class="col-3 col-form-label">Email</div>
		<div class="col-9">
			<input type="email" name="email" class="form-control" placeholder="@"
				value="<?= $dto->email ?>" required />

		</div>

	</div>

	<div class="row form-group">
		<div class="col-3">Password</div>
		<div class="col-9">
			<input type="password" name="pass" class="form-control" title="minimum 5 characters"
				autocomplete="new-password" pattern=".{0}|.{5,}"
				placeholder="password - if you want to change it .." />

		</div>

	</div>

	<div class="row form-group">
		<div class="offset-3 col-9">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="admin" value="1"
					id="<?= $_uid = strings::rand() ?>"
					<?php if ( $dto->admin) print 'checked' ?> />

				<label for="<?= $_uid ?>" class="form-check-label">Admin User</label>

			</div>

		</div>

	</div>

	<div class="row form-group">
		<div class="col-9 offset-3">
			<button class="btn btn-primary" type="submit">save/update</button>

		</div>

	</div>

</form>

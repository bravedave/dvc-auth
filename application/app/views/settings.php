<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

extract((array)$this->data);
?>

<form id="<?= $_form = strings::rand() ?>" autocomplete="off">
	<input type="hidden" name="action" value="update-settings" />

	<div class="modal fade" tabindex="-1" role="dialog" id="<?= $_modal = strings::rand() ?>" aria-labelledby="<?= $_modal ?>Label" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header <?= theme::modalHeader() ?>">
					<h5 class="modal-title" id="<?= $_modal ?>Label"><?= $this->title ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" value="<?= $settings->name ?>" />

						</div>
					</div>

					<div class="form-group row">
						<div class="col">
							<div class="form-check">
								<input type="checkbox" name="lockdown" class="form-check-input" id="<?= $_uid = strings::rand() ?>" value="1" <?= $settings->lockdown ? 'checked' : ''; ?>>
								<label class="form-check-label" for="<?= $_uid ?>">Lockdown</label>

							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<div class="my-0 mr-auto js-message">&nbsp;</div>
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		(_ => {
			const modal = $('#<?= $_modal ?>');

			modal
				.on('shown.bs.modal', () => {
					$('#<?= $_form ?>')
						.on('submit', function(e) {
							let _form = $(this);
							let _data = _form.serializeFormJSON();

							// console.table( _data);
							_.post({
								url: _.url('<?= $this->route ?>'),
								data: _data,

							}).then(d => {
								if ('ack' == d.response) {
									modal
										.trigger('success')
										.modal('hide');

								} else {
									modal.find('.js-message')
										.addClass('alert alert-danger')
										.html(d.description);
									console.log(d);
								}
							});

							return false;
						});
				})
		})(_brayworth_);
	</script>
</form>
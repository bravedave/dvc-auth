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
<table class="table" id="<?= $tblID = strings::rand() ?>">
	<thead class="small">
		<tr>
			<td>#</td>
			<td>Name</td>
			<td>UserName</td>
			<td>Email</td>
			<td class="text-center">Admin</td>

		</tr>

	</thead>

	<tbody>
	<?php
	if ( $this->data) {
		while ( $dto = $this->data->dto()) {	?>
		<tr data-id="<?php print $dto->id ?>">
			<td line-number>&nbsp;</td>
			<td><?= $dto->name ?></td>
			<td><?= $dto->username ?></td>
			<td><?= $dto->email ?></td>
			<td class="text-center"><?= $dto->admin ? strings::html_tick : '&nbsp;' ?></td>

		</tr>

	<?php
		}

	}	?>
	</tbody>

</table>
<script>
$(document).ready( () => {
	$('#<?= $tblID ?>')
	.on('update-line-numbers', function( e) {
		$('> tbody > tr:not(.d-none) >td[line-number]', this).each( ( i, e) => {
			$(e).data('line', i+1).html( i+1);
		});
	})
	.trigger('update-line-numbers');

	$('> tbody > tr', '#<?= $tblID ?>').each( ( i, el) => {
		let _el = $(el);
		let _data = _el.data();

		let editURL = _brayworth_.url('users/edit/' + _data.id);

		_el
		.addClass('pointer')
		.on( 'click', function( e) {
			e.stopPropagation();
			window.location.href = editURL;

		})
		.on('contextmenu', function( e) {
			if ( e.shiftKey)
				return;

			e.stopPropagation(); e.preventDefault();

			_brayworth_.hideContexts();

			let _context = _brayworth_.context();

			_context.append( $('<a><i class="fa fa-fw fa-pencil"></i><strong>edit</strong></a>').attr( 'href', editURL));
			_context.append( $('<a href="#"><i class="fa fa-fw fa-trash"></i>delete</a>').on('click', function(evt) {
				_context.close();
				e.stopPropagation(); e.preventDefault();

				_brayworth_.modal({
					title : 'Are you Sure?',
					text : 'Delete record',
					buttons : {
						cancel : function( e) {
							$(this).modal('close');

						},
						OK : function( e) {
							$(this).modal('close');

							_brayworth_.post({
								url : _brayworth_.url('users'),
								data : {
									action : 'delete',
									id : _el.data('id'),

								}

							}).then( function( d) {
								if ( 'ack' == d.response) {
									window.location.reload();
								}
								else {
									_brayworth_.growl( d);

								}

							});

						}

					}

				});

			}));

			_context.open( e);

		});

	});

});
</script>
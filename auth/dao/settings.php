<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
 * styleguide : https://codeguide.co/
*/

namespace dvc\auth\dao;

use dao\_dao;

class settings extends _dao {
	protected $_db_name = 'settings';

	function getFirst() {
		if ( $res = $this->Result( "SELECT * FROM settings"))
			return ( $res->dto());

		return ( FALSE);

	}

	function getName() {
		if ( $dto = $this->getFirst())
			return ( $dto->name);

		return ( \config::$WEBNAME);

	}

	function lockdown( $set = NULL) {
		$lockdown = FALSE;
		if ( $dto = $this->getFirst()) {
			$lockdown = (int)$dto->lockdown;

			if ( !is_null( $set))
				$this->Q( sprintf( "UPDATE `settings` SET `lockdown` = %d", (int)$set));

		}

		//~ \sys::logger( sprintf( 'lockdown = %s', ( $lockdown ? 'TRUE' : 'FALSE' )));

		return ( $lockdown);

	}

}
